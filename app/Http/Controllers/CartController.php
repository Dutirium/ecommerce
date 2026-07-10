<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'productId' => [
            'required',
            'integer',
            'exists:products,id',
        ],

        'quantity' => [
            'required',
            'integer',
            'min:1',
        ],

        'size' => [
            'nullable',
            'string',
            'max:20',
        ],
    ]);

    $product = Product::findOrFail(
        $validated['productId']
    );

    $requestedQuantity = $validated['quantity'];

    $size = $validated['size'] ?? null;

    $cart = Cart::firstOrCreate([
        'user_id' => auth()->id(),
    ]);

    $cartItem = $cart->items()
        ->where('product_id', $product->id)
        ->where('size', $size)
        ->first();

    if ($cartItem) {

        $newQuantity =
            $cartItem->quantity + $requestedQuantity;

        if ($newQuantity > $product->stock) {
            return back()->with(
                'error',
                'Requested quantity exceeds available stock.'
            );
        }

        $cartItem->update([
            'quantity' => $newQuantity,
        ]);

    } else {

        if ($requestedQuantity > $product->stock) {
            return back()->with(
                'error',
                'Requested quantity exceeds available stock.'
            );
        }

        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => $requestedQuantity,
            'size' => $size,
        ]);
    }

if ($request->expectsJson()) {
    return response()->json([
        'status' => 'success',
        'message' => 'Product added to cart.',
    ]);
}

return back()->with(
    'success',
    'Product added to cart.'
);
}


    public function index()
    {
        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();


        $cartItems = $cart
            ? $cart->items
            : collect();


        $cartTotal = $cartItems->sum(
            function ($item) {

                return
                    $item->product->price
                    * $item->quantity;
            }
        );


        return view(
            'cart',
            compact(
                'cartItems',
                'cartTotal'
            )
        );
    }


    public function increase(CartItem $cartItem)
    {
        /*
        |--------------------------------------------------------------------------
        | Ownership Check
        |--------------------------------------------------------------------------
        */

        if (
            $cartItem->cart->user_id
            !== auth()->id()
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Stock Check
        |--------------------------------------------------------------------------
        */

        if (
            $cartItem->quantity
            >= $cartItem->product->stock
        ) {

            return response()->json([
                'status' => 'error',

                'message' =>
                    'Cannot exceed available stock.',
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Increase Quantity
        |--------------------------------------------------------------------------
        */

        $cartItem->increment('quantity');

        $cartItem->refresh();


        return response()->json(
            $this->cartResponse($cartItem)
        );
    }


    public function decrease(CartItem $cartItem)
    {
        /*
        |--------------------------------------------------------------------------
        | Ownership Check
        |--------------------------------------------------------------------------
        */

        if (
            $cartItem->cart->user_id
            !== auth()->id()
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Remove Item When Quantity Reaches Zero
        |--------------------------------------------------------------------------
        */

        if ($cartItem->quantity <= 1) {

            $cart = $cartItem->cart;

            $cartItem->delete();


            $cart->load('items.product');


            $cartTotal = $cart->items->sum(
                function ($item) {

                    return
                        $item->product->price
                        * $item->quantity;
                }
            );


            return response()->json([
                'status' => 'removed',
                'cartTotal' => $cartTotal,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Decrease Quantity
        |--------------------------------------------------------------------------
        */

        $cartItem->decrement('quantity');

        $cartItem->refresh();


        return response()->json(
            $this->cartResponse($cartItem)
        );
    }


    public function destroy(CartItem $cartItem)
    {
        /*
        |--------------------------------------------------------------------------
        | Ownership Check
        |--------------------------------------------------------------------------
        */

        if (
            $cartItem->cart->user_id
            !== auth()->id()
        ) {
            abort(403);
        }


        $cart = $cartItem->cart;


        /*
        |--------------------------------------------------------------------------
        | Delete Cart Item
        |--------------------------------------------------------------------------
        */

        $cartItem->delete();


        /*
        |--------------------------------------------------------------------------
        | Recalculate Cart Total
        |--------------------------------------------------------------------------
        */

        $cart->load('items.product');


        $cartTotal = $cart->items->sum(
            function ($item) {

                return
                    $item->product->price
                    * $item->quantity;
            }
        );


        return response()->json([
            'status' => 'removed',
            'cartTotal' => $cartTotal,
        ]);
    }


    private function cartResponse(
        CartItem $cartItem
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Load Product
        |--------------------------------------------------------------------------
        */

        $cartItem->load('product');


        /*
        |--------------------------------------------------------------------------
        | Load Complete Cart
        |--------------------------------------------------------------------------
        */

        $cart = $cartItem
            ->cart()
            ->with('items.product')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Calculate Cart Total
        |--------------------------------------------------------------------------
        */

        $cartTotal = $cart->items->sum(
            function ($item) {

                return
                    $item->product->price
                    * $item->quantity;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | AJAX Response
        |--------------------------------------------------------------------------
        */

        return [
            'status' => 'updated',

            'quantity' =>
                $cartItem->quantity,

            'subtotal' =>
                $cartItem->product->price
                * $cartItem->quantity,

            'cartTotal' =>
                $cartTotal,
        ];
    }
}