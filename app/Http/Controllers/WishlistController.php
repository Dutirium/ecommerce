<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()
        ->wishlists()
        ->pluck('product_id')
        ->flip()
        ->toArray();

        return view('wishlist', compact('wishlistProductIds'));
    }

    public function store(Request $request)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
        ->where('product_id',$request->productId)
        ->first();

        if($wishlist)
        {
            $wishlist->delete();
            
            if($request->ajax()){
                return response()->json([
                    'status' => 'removed'
                ]);
            }
            
        }
        try
        {
            Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->productId,
        ]);

            if($request->ajax()){
                return response()->json([
                    'status'=>'added',
                ]);
            }

        }
        
        catch(\Illuminate\Database\UniqueConstraintViolationException $e)
        {
            return back()->with('success', 'Added to wishlist');
        }

    }

    public function show()
    {
        $wishlists = auth()->user()
        ->wishlists()
        ->with('product')
        ->get();

        $wishlistProductIds = auth()->user()
        ->wishlists()
        ->pluck('product_id')
        ->flip()
        ->toArray();

        return view('wishlist', compact(['wishlists','wishlistProductIds']));
    }
}
