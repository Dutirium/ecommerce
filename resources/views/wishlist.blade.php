<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" 
    content="{{ csrf_token() }}">

    <meta charset="UTF-8">

    <meta name="viewport" 
    content="width=device-width, 
    initial-scale=1.0">
    
    <title>My Wishlist</title>
    
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
<style>
/* Container Spacing & Layout Structure */
.container {
    max-width: 1400px;
    margin: 40px auto;
    padding: 0 32px;
}

/* Luxury Editorial Title Formatting */
.container h1 {
    font-size: 2rem;
    font-weight: 500;
    letter-spacing: -0.03em;
    text-transform: uppercase;
    color: var(--text-pure);
    margin-bottom: 32px;
    border-bottom: 1px solid var(--border-premium);
    padding-bottom: 16px;
}

/* Empty State Handling */
#emptyWishlistMessage {
    font-size: 1rem;
    color: var(--text-muted);
    letter-spacing: -0.01em;
    padding: 40px 0;
}

/* Structural wrapping node for the injection grid */
.wishlistItem {
    background: transparent;
    display: flex;
    flex-direction: column;
    position: relative;
}

/* Overhauling the Item Actions wrapper underneath the card contents if applicable */
.productActions {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    width: 100%;
}

/* 
   HIGH-CONTRAST REMOVE COMMAND BUTTON 
   Replaces cheap crimson outlines with strict monochrome/clinical layout elements
*/
.removeBtn {
    background-color: transparent;
    color: var(--text-muted);
    border: 1px solid var(--border-premium);
    padding: 14px 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    border-radius: 0px; /* Monochromatic zero-radius corners match layout architecture */
    cursor: pointer;
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    -webkit-tap-highlight-color: transparent;
    box-sizing: border-box;
}

/* Pure structural high-visibility switch on hover */
.removeBtn:hover {
    background-color: #991b1b; /* Sophisticated deep muted crimson warning */
    color: var(--text-pure);
    border-color: #991b1b;
}

/* Tactile Click Damping */
.removeBtn:active {
    transform: scale(0.99);
}

/* Native Hidden Attribute Guard */
[hidden] {
    display: none !important;
}

/* Mobile Responsive Adapters */
@media (max-width: 640px) {
    .container {
        margin: 24px auto;
        padding: 0 16px;
    }
    
    .container h1 {
        font-size: 1.5rem;
        margin-bottom: 20px;
        padding-bottom: 12px;
    }

    .removeBtn {
        padding: 12px;
        font-size: 0.75rem;
    }
}
</style>

</head>

<body style="padding-bottom:120px">

<x-navBarTop />

<div class="container">

    <h1>My Wishlist</h1>

       
    <p
    id ="emptyWishlistMessage"
    @if(!$wishlists->isEmpty()) hidden @endif>
    
    Your wishlist is empty.
    </p>

    <div class="productGrid" data-page="wishlist">

        @foreach($wishlists as $wishlist)

            <div 
                class="wishlistItem"
                data-product-id="{{ $wishlist->product->id }}">

                    <x-product 
                    :product="$wishlist->product"  
                    :wishlistProductIds='$wishlistProductIds'/>

            </div>

        @endforeach

    </div>

       

</div>

<navBarBottom />

</body>
<script src="{{ asset('js/asyncFunction.js') }}"></script>
</html>