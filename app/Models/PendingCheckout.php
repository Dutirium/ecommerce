<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendingCheckout extends Model
{
    protected $fillable = [
        'user_id',
        'razorpay_order_id',
        'razorpay_payment_id',
        'expected_amount',
        'checkout_data',
        'status',
        'completed_at',
    ];


    protected function casts(): array
    {
        return [
            'checkout_data' => 'array',
            'expected_amount' => 'decimal:2',
            'completed_at' => 'datetime',
        ];
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}