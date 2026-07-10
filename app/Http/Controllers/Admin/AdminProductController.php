<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()
            ->paginate(15);

        return view(
            'admin.products.index',
            compact('products')
        );
    }

    public function toggleStatus(Product $product)
    {
        dd([
    'has_file' => $request->hasFile('image'),
    'file' => $request->file('image'),
    'valid' => $request->file('image')?->isValid(),
]);
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        return back()->with(
            'success',
            $product->is_active
                ? 'Product activated successfully.'
                : 'Product deactivated successfully.'
        );
    }

    public function create()
    {
        return view('admin.products.create');
    }


   public function store(StoreProductRequest $request)
{
    $validated = $request->validated();

    DB::transaction(function () use ($request, $validated) {

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $request->boolean('is_active'),
        ]);

        foreach ($request->file('images') as $index => $image) {

            $path = $image->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => $index === 0,
                'sort_order' => $index,
            ]);

            if ($index === 0) {
                $product->update([
                    'image' => $path,
                ]);
            }
        }
    });

    return redirect()
        ->route('admin.products.index')
        ->with(
            'success',
            'Product created successfully.'
        );
}

    public function edit(Product $product)
{
    return view(
        'admin.products.edit',
        compact('product')
    );
}


public function update(
    UpdateProductRequest $request,
    Product $product
) {
    $validated = $request->validated();

    /*
    |--------------------------------------------------------------------------
    | Update Product Information
    |--------------------------------------------------------------------------
    */

    $product->update([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'stock' => $validated['stock'],
        'is_active' => $request->boolean('is_active'),
    ]);


    /*
    |--------------------------------------------------------------------------
    | Add New Product Images
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('images')) {

        $nextSortOrder =
            ($product->images()->max('sort_order') ?? -1) + 1;

        foreach ($request->file('images') as $image) {

            $path = $image->store(
                'products',
                'public'
            );

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => false,
                'sort_order' => $nextSortOrder,
            ]);

            $nextSortOrder++;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Redirect Back to Admin Product List
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('admin.products.index')
        ->with(
            'success',
            'Product updated successfully.'
        );
}
}