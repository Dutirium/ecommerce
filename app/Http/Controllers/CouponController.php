<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => [
                'required',
                'string',
            ],
        ]);

        $coupon = DiscountCode::where(
            'code',
            strtoupper(trim($request->coupon_code))
        )->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.',
            ]);
        }

        if (!$coupon->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon is inactive.',
            ]);
        }

        if (
            $coupon->expires_at &&
            now()->greaterThan($coupon->expires_at)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon has expired.',
            ]);
        }

        if (
            $coupon->usage_limit &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon usage limit reached.',
            ]);
        }

        $cart = auth()->user()
            ->cart()
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.',
            ]);
        }

        $subtotal = 0;
        $gst = 0;

        foreach ($cart->items as $item) {

            $lineSubtotal =
                $item->product->price
                * $item->quantity;

            $subtotal += $lineSubtotal;

            $gst +=
                $lineSubtotal
                * ($item->product->gst_rate / 100);
        }

        if (
            $subtotal < $coupon->minimum_order
        ) {
            return response()->json([
                'success' => false,
                'message' =>
                    "Minimum order should be ₹{$coupon->minimum_order}.",
            ]);
        }

        if (
            $coupon->type === 'percentage'
        ) {

            $discount =
                $subtotal
                * ($coupon->value / 100);

        } else {

            $discount =
                $coupon->value;
        }

        $discount = min(
            $discount,
            $subtotal
        );

        $shipping = 0;

        $total =
            $subtotal
            - $discount
            + $gst
            + $shipping;

        session([
            'coupon_code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        return response()->json([

            'success' => true,

            'coupon_code' =>
                $coupon->code,

            'discount' =>
                round($discount, 2),

            'subtotal' =>
                round($subtotal, 2),

            'gst' =>
                round($gst, 2),

            'shipping' =>
                round($shipping, 2),

            'total' =>
                round($total, 2),

            'message' =>
                'Coupon applied successfully.',
        ]);
    }
}