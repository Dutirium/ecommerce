
@props([
    'product',
    'showWishlistBtn' => false,
    'wishlistProductIds'=> [],
])

<div class="productCard">
<a 
href="{{ route('products.show', $product) }}"
class="productLink"
>
    <div class="productImage">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}">    
    </div>
</a>
<br>
    <div class="productDetails">

        <h3 class="productName">
            {{ $product->name }}
        </h3>

        <p class="productDescription">
            {{ Str::limit($product->description, 80) }}
        </p>

        <div class="productPrice">
            ₹{{ number_format($product->price, 2) }}
        </div>

        <div class="productStock">
            @if($product->stock >0 )
                <span class="inStock"> In Stock ({{ $product->stock }})</span>
            @else
                <span class="outStock">Out of Stock</span>
            @endif
        </div>
    </div>



{{-- <button class="cartButton" onclick="navigateToRoute('{{ route('cart.index', $product->id) }}')">
    Add to Cart
</button> --}}


<form action="{{ route('cart.store') }}" 
method="POST"
class="addToCartForm">
    @csrf

    <input
        type="hidden"
        name="productId"
        value="{{ $product->id }}"
    >

    <input
        type="hidden"
        name="quantity"
        value="1"
    >

    <button type="submit">
        Add to Cart
    </button>
</form>

<button type="button" 
class="wishlistBtn"
data-product-id="{{ $product->id }}">
       
    @if(isset($wishlistProductIds[$product->id]))
        Remove from wishlist
    @else
        Add to wishlist
    @endif
        
</button>

</div>


