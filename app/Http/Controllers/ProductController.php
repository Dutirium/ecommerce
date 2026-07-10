<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();

        $wishlistProductIds = auth()->check()
        ? auth()->user()
                ->wishlists()
                ->pluck('product_id')
                ->flip()
                ->toArray()
                : [];

        return view('list',compact(['products','wishlistProductIds']));
    }

public function show(Product $product)
{
    $wishlistProductIds = auth()->check();

    $product->load('images');
    
    $relatedProducts = Product::where('id', '!=', $product->id)
        ->where('is_active', true)
        ->take(4)
        ->get();

    return view(
        'productDashboard',
        compact('product', 'relatedProducts','wishlistProductIds')
    );
}
}
