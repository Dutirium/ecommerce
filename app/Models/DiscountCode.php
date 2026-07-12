<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
protected $fillable = [

    'code',

    'type',

    'value',

    'minimum_order',

    'usage_limit',

    'used_count',

    'expires_at',

    'is_active',
];

}
