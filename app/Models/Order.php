<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',

        'subtotal',
        'shipping_amount',
        'total_amount',

        'payment_method',
        'payment_status',
        'order_status',

        'razorpay_order_id',
        'razorpay_payment_id',

        'customer_name',
        'customer_email',
        'customer_phone',

        'shipping_address_line_1',
        'shipping_address_line_2',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'discount_amount',
        'coupon_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}