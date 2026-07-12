<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'image',
    'is_active',
    'gst_rate',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/placeholder.jpg');
        }

    return Storage::disk('public')->url($this->image);
    }

    public function images(): HasMany
{
    return $this->hasMany(ProductImage::class)
        ->orderBy('sort_order');
}

public function primaryImage(): HasOne
{
    return $this->hasOne(ProductImage::class)
        ->where('is_primary', true);
}
}
