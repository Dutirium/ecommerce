<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function createOrder(
        User $user,
        array $checkoutData,
        string $paymentMethod,
        string $paymentStatus,
        ?string $razorpayOrderId = null,
        ?string $razorpayPaymentId = null,
    ): Order {
        return DB::transaction(function () use (
            $user,
            $checkoutData,
            $paymentMethod,
            $paymentStatus,
            $razorpayOrderId,
            $razorpayPaymentId
        ) {

            /*
            |--------------------------------------------------------------------------
            | Lock User Cart
            |--------------------------------------------------------------------------
            */

            $cart = $user
                ->cart()
                ->lockForUpdate()
                ->first();

            if (!$cart) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart is empty.',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Lock Cart Items
            |--------------------------------------------------------------------------
            */

            $cartItems = $cart
                ->items()
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart is empty.',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Collect Product IDs
            |--------------------------------------------------------------------------
            */

            $productIds = $cartItems
                ->pluck('product_id')
                ->sort()
                ->values();


            /*
            |--------------------------------------------------------------------------
            | Lock Products
            |--------------------------------------------------------------------------
            */

            $products = Product::whereIn('id', $productIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');


            /*
            |--------------------------------------------------------------------------
            | Validate Products and Calculate Trusted Subtotal
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;

            foreach ($cartItems as $cartItem) {

                $product = $products->get(
                    $cartItem->product_id
                );

                if (!$product || !$product->is_active) {
                    throw ValidationException::withMessages([
                        'cart' =>
                            'One of the products in your cart is no longer available.',
                    ]);
                }

                if ($cartItem->quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' =>
                            "{$product->name} does not have enough stock.",
                    ]);
                }

                $subtotal +=
                    $product->price
                    * $cartItem->quantity;
            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Totals
            |--------------------------------------------------------------------------
            */

            $shippingAmount = 0;

            $totalAmount =
                $subtotal + $shippingAmount;


            /*
            |--------------------------------------------------------------------------
            | Generate Order Number
            |--------------------------------------------------------------------------
            */

            $orderNumber =
                'ORD-'
                . now()->format('Ymd')
                . '-'
                . Str::upper((string) Str::ulid());


            /*
            |--------------------------------------------------------------------------
            | Create Order
            |--------------------------------------------------------------------------
            */

            $order = $user
                ->orders()
                ->create([

                    'order_number' =>
                        $orderNumber,

                    'subtotal' =>
                        $subtotal,

                    'shipping_amount' =>
                        $shippingAmount,

                    'total_amount' =>
                        $totalAmount,

                    'payment_method' =>
                        $paymentMethod,

                    'payment_status' =>
                        $paymentStatus,

                    'order_status' =>
                        'pending',

                    'razorpay_order_id' =>
                        $razorpayOrderId,

                    'razorpay_payment_id' =>
                        $razorpayPaymentId,

                    'customer_name' =>
                        $checkoutData['customer_name'],

                    'customer_email' =>
                        $checkoutData['customer_email'],

                    'customer_phone' =>
                        $checkoutData['customer_phone'],

                    'shipping_address_line_1' =>
                        $checkoutData['shipping_address_line_1'],

                    'shipping_address_line_2' =>
                        $checkoutData['shipping_address_line_2'] ?? null,

                    'shipping_city' =>
                        $checkoutData['shipping_city'],

                    'shipping_state' =>
                        $checkoutData['shipping_state'],

                    'shipping_postal_code' =>
                        $checkoutData['shipping_postal_code'],

                    'shipping_country' =>
                        $checkoutData['shipping_country'],
                ]);


            /*
            |--------------------------------------------------------------------------
            | Create Snapshots and Reduce Stock
            |--------------------------------------------------------------------------
            */

            foreach ($cartItems as $cartItem) {

                $product = $products->get(
                    $cartItem->product_id
                );

                $itemSubtotal =
                    $product->price
                    * $cartItem->quantity;


                $order->items()->create([

                    'product_id' =>
                        $product->id,

                    'product_name' =>
                        $product->name,
                    'size' => 
                        $cartItem->size,
                    'unit_price' =>
                        $product->price,

                    'quantity' =>
                        $cartItem->quantity,

                    'subtotal' =>
                        $itemSubtotal,
                ]);


                $product->decrement(
                    'stock',
                    $cartItem->quantity
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Clear Cart
            |--------------------------------------------------------------------------
            */

            $cart->items()->delete();


            return $order;

        }, 3);
    }
}