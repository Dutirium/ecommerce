<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\AdminNewOrderNotification;
use App\Mail\CustomerOrderConfirmation;
use App\Models\Cart;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Models\PendingCheckout;

class CheckoutController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {
    }


    /*
    |--------------------------------------------------------------------------
    | Checkout Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items;

$subtotal = 0;
$gstAmount = 0;

foreach ($cartItems as $item) {

    $lineSubtotal =
        $item->product->price * $item->quantity;

    $lineGST =
        $lineSubtotal * ($item->product->gst_rate / 100);

    $subtotal += $lineSubtotal;
    $gstAmount += $lineGST;
}

$shippingAmount = 0;

$discountAmount = session(
    'discount_amount',
    0
);

$totalAmount =
    $subtotal
    - $discountAmount
    + $gstAmount
    + $shippingAmount;

return view('checkout', compact(
    'cartItems',
    'subtotal',
    'discountAmount',
    'gstAmount',
    'shippingAmount',
    'totalAmount'
));
    }


    /*
    |--------------------------------------------------------------------------
    | COD Checkout
    |--------------------------------------------------------------------------
    */

    public function storeCod(CheckoutRequest $request)
    {
        if ($request->payment_method !== 'cod') {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Selected payment method is not available through this checkout route.'
                );
        }

        $order = $this->orderService->createOrder(
            user: $request->user(),

            checkoutData: $request->validated(),

            paymentMethod: 'cod',

            paymentStatus: 'pending',
        );

        $order->load('items');

        $this->sendOrderEmails($order);

        return redirect()
            ->route(
                'checkout.success',
                $order
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Checkout Success Page
    |--------------------------------------------------------------------------
    */

    public function success(Order $order)
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load('items');

        return view(
            'checkoutSuccess',
            compact('order')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Razorpay Order
    |--------------------------------------------------------------------------
    */

    public function createRazorpayOrder(
        CheckoutRequest $request
    ) {
        if ($request->payment_method !== 'razorpay') {
            return response()->json([
                'message' => 'Invalid payment method.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Cart
        |--------------------------------------------------------------------------
        */

        $cart = Cart::with('items.product')
            ->where(
                'user_id',
                $request->user()->id
            )
            ->first();


        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'message' => 'Your cart is empty.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Trusted Total
        |--------------------------------------------------------------------------
        */

$subtotal = 0;
$gstAmount = 0;

foreach ($cart->items as $item) {

    $product = $item->product;

    if (!$product || !$product->is_active) {
        return response()->json([
            'message' => 'One or more products are no longer available.',
        ], 422);
    }

    if ($item->quantity > $product->stock) {
        return response()->json([
            'message' => "Insufficient stock for {$product->name}.",
        ], 422);
    }

    $lineSubtotal =
        $product->price * $item->quantity;

    $lineGST =
        $lineSubtotal * ($product->gst_rate / 100);

    $subtotal += $lineSubtotal;
    $gstAmount += $lineGST;
}

$shippingAmount = 0;

$discountAmount = session(
    'discount_amount',
    0
);

$totalAmount =
    $subtotal
    - $discountAmount
    + $gstAmount
    + $shippingAmount;

        /*
        |--------------------------------------------------------------------------
        | Create Razorpay API Client
        |--------------------------------------------------------------------------
        */

        $api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );


        /*
        |--------------------------------------------------------------------------
        | Create Razorpay Order
        |--------------------------------------------------------------------------
        */

        $razorpayOrder = $api->order->create([

            'receipt' =>
                'cart_'
                . $request->user()->id
                . '_'
                . now()->timestamp,

            'amount' =>
                (int) round($totalAmount * 100),

            'currency' =>
                'INR',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Store Trusted Checkout State
        |--------------------------------------------------------------------------
        */

        PendingCheckout::create([
            'user_id' =>
            $request->user()->id,

            'razorpay_order_id' =>
            $razorpayOrder['id'],

            'expected_amount' =>
            $totalAmount,

            'checkout_data' =>
            $request->validated(),

            'status' =>
            'pending',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Return Razorpay Order Data
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'razorpay_order_id' =>
                $razorpayOrder['id'],

            'amount' =>
                $razorpayOrder['amount'],

            'currency' =>
                $razorpayOrder['currency'],

            'key' =>
                config('services.razorpay.key_id'),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Razorpay Payment and Finalize Order
    |--------------------------------------------------------------------------
    */

public function verifyRazorpayPayment(Request $request)
{
    $validated = $request->validate([
        'razorpay_payment_id' => [
            'required',
            'string',
        ],

        'razorpay_order_id' => [
            'required',
            'string',
        ],

        'razorpay_signature' => [
            'required',
            'string',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Find Trusted Pending Checkout
    |--------------------------------------------------------------------------
    */

    $pendingCheckout = PendingCheckout::where(
        'razorpay_order_id',
        $validated['razorpay_order_id']
    )
        ->where(
            'user_id',
            $request->user()->id
        )
        ->first();


    if (!$pendingCheckout) {
        return response()->json([
            'message' =>
                'Pending checkout could not be found.',
        ], 404);
    }


    /*
    |--------------------------------------------------------------------------
    | Idempotency: Already Completed Pending Checkout
    |--------------------------------------------------------------------------
    */

    if ($pendingCheckout->status === 'completed') {

        $existingOrder = Order::where(
            'razorpay_order_id',
            $pendingCheckout->razorpay_order_id
        )->first();


        if (!$existingOrder) {
            return response()->json([
                'message' =>
                    'Checkout was completed but the order could not be found.',
            ], 409);
        }


        return response()->json([
            'success' => true,

            'redirect_url' => route(
                'checkout.success',
                $existingOrder
            ),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Payment ID Idempotency Check
    |--------------------------------------------------------------------------
    */

    $existingOrder = Order::where(
        'razorpay_payment_id',
        $validated['razorpay_payment_id']
    )->first();


    if ($existingOrder) {

        abort_unless(
            $existingOrder->user_id
                === $request->user()->id,
            403
        );


        return response()->json([
            'success' => true,

            'redirect_url' => route(
                'checkout.success',
                $existingOrder
            ),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Create Razorpay Client
    |--------------------------------------------------------------------------
    */

    $api = new Api(
        config('services.razorpay.key_id'),
        config('services.razorpay.key_secret')
    );


    /*
    |--------------------------------------------------------------------------
    | Verify Payment Signature
    |--------------------------------------------------------------------------
    */

    try {

        $api->utility->verifyPaymentSignature([

            'razorpay_order_id' =>
                $pendingCheckout->razorpay_order_id,

            'razorpay_payment_id' =>
                $validated['razorpay_payment_id'],

            'razorpay_signature' =>
                $validated['razorpay_signature'],
        ]);

    } catch (SignatureVerificationError $e) {

        return response()->json([
            'success' => false,

            'message' =>
                'Payment verification failed.',
        ], 400);
    }


    /*
    |--------------------------------------------------------------------------
    | Fetch Payment from Razorpay
    |--------------------------------------------------------------------------
    */

    $payment = $api->payment->fetch(
        $validated['razorpay_payment_id']
    );


    /*
    |--------------------------------------------------------------------------
    | Verify Payment Order
    |--------------------------------------------------------------------------
    */

    if (
        $payment['order_id']
        !== $pendingCheckout->razorpay_order_id
    ) {
        return response()->json([
            'message' =>
                'Payment does not belong to this checkout.',
        ], 400);
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Payment Amount
    |--------------------------------------------------------------------------
    */

    $expectedAmountInPaise = (int) round(
        ((float) $pendingCheckout->expected_amount) * 100
    );


    if (
        (int) $payment['amount']
        !== $expectedAmountInPaise
    ) {
        return response()->json([
            'message' =>
                'Payment amount mismatch.',
        ], 400);
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Captured Status
    |--------------------------------------------------------------------------
    */

    if ($payment['status'] !== 'captured') {
        return response()->json([
            'message' =>
                'Payment has not been captured yet.',
        ], 422);
    }


    /*
    |--------------------------------------------------------------------------
    | Finalize Laravel Order
    |--------------------------------------------------------------------------
    */

    $order = $this->orderService->createOrder(

        user:
            $request->user(),

        checkoutData:
            $pendingCheckout->checkout_data,

        paymentMethod:
            'razorpay',

        paymentStatus:
            'paid',

        razorpayOrderId:
            $pendingCheckout->razorpay_order_id,

        razorpayPaymentId:
            $validated['razorpay_payment_id'],
    );


    /*
    |--------------------------------------------------------------------------
    | Mark Pending Checkout Completed
    |--------------------------------------------------------------------------
    */

    $pendingCheckout->update([

        'razorpay_payment_id' =>
            $validated['razorpay_payment_id'],

        'status' =>
            'completed',

        'completed_at' =>
            now(),
    ]);


    /*
    |--------------------------------------------------------------------------
    | Load Items and Send Emails
    |--------------------------------------------------------------------------
    */

    $order->load('items');

    $this->sendOrderEmails($order);

session()->forget([
    'coupon_code',
    'discount_amount',
]);
    /*
    |--------------------------------------------------------------------------
    | Return Success URL
    |--------------------------------------------------------------------------
    */

    return response()->json([
        'success' => true,

        'redirect_url' => route(
            'checkout.success',
            $order
        ),
    ]);
}


    /*
    |--------------------------------------------------------------------------
    | Send Customer and Admin Emails
    |--------------------------------------------------------------------------
    */

    private function sendOrderEmails(
        Order $order
    ): void {
        Mail::to($order->customer_email)
            ->send(
                new CustomerOrderConfirmation($order)
            );


        Mail::to(config('mail.admin_address'))
            ->send(
                new AdminNewOrderNotification($order)
            );
    }
}