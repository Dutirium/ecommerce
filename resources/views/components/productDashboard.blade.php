
{{-- @props(['product', 'relatedProducts']) --}}
    @props([
        'wishlistProductIds'=>[],
        'product',
        'relatedProducts',
    ])
    <main class="productPage">


<div class="productGallery">

    {{-- Main Product Image --}}
    <div class="mainImageContainer">
        <img
            id="mainProductImage"
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
        >
    </div>

    {{-- Product Image Thumbnails --}}
    @if ($product->images->isNotEmpty())

        <div class="thumbnailContainer">

            @foreach ($product->images as $image)

                <button
                    type="button"
                    class="thumbnailBtn {{ $image->is_primary ? 'active' : '' }}"
                    data-image-url="{{ $image->image_url }}"
                >
                    <img
                        src="{{ $image->image_url }}"
                        alt="{{ $product->name }}"
                    >
                </button>

            @endforeach

        </div>

    @endif

</div>


        <section class="productInfo">

            <h1>{{ $product->name }}</h1>

            <p class="price">
                ₹{{ number_format($product->price, 2) }}
            </p>

            <p class="stock">
                @if($product->stock > 0)
                    <span class="inStock">In Stock ({{ $product->stock }})</span>
                @else
                    <span class="outStock">Out of Stock</span>
                @endif
            </p>

            <p class="description">
                {{ $product->description }}
            </p>

            <hr>

            <div class="optionGroup">

                <h3>Select Color</h3>

<label for="size">Size</label>

<select name="size" id="size" required>
    <option value="">Select Size</option>
    <option value="S">S</option>
    <option value="M">M</option>
    <option value="L">L</option>
    <option value="XL">XL</option>
</select>

            </div>

            <div class="actionButtons">

                
<form action="{{ route('cart.store') }}" method="POST">
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
               

                

                <button
                class="wishlistBtn"
                type="button"
                data-product-id ="{{ $product->id }}">
                    @if(isset($wishlistProductIds[$product->id]))
                        Remove from wishlist
                    @else  
                        Add to wishlist
                    @endif
                </button>



            </div>

        </section>

    </main>

    <section class="productDetails">

        <h2>Description</h2>

        <p>
            {{ $product->description }}
        </p>

    </section>


    <section class="relatedProducts">

        <h2>Related Products</h2>

        <div class="relatedGrid">
            
            @foreach($relatedProducts as $relatedProduct)
                <x-product :product="$relatedProduct" />
            @endforeach 

        </div>

    </section>

<script>
  
</script>