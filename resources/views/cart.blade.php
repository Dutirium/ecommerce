<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

:root {
    /* Deep Luxury Color Canvas */
    --bg-main: #0a0e17;              /* Deep, imperial midnight navy */
    --card-surface: #121824;         /* Rich charcoal-navy compound card surface */
    --image-housing: #0e131f;        /* Deep well anchor for product artwork */
    
    /* Elegant Accenting System */
    --gold-accent: #d4af37;          /* Muted, premium metallic champagne gold */
    --gold-hover: #f3e5ab;           /* Soft silk gold light flare */
    --border-subtle: rgba(212, 175, 55, 0.12); /* Delicate golden thread boundaries */
    
    /* Polished Typography Tones */
    --text-light: #f4f6fa;           /* Off-white porcelain text color */
    --text-muted: #8fa0bc;           /* Soft slate-gray secondary description */
    
    /* Structural Curves & Sophisticated Timing */
    --luxury-radius: 8px;            /* Subtle, intentional corner radii */
    --luxury-ease: cubic-bezier(0.25, 1, 0.5, 1);
}

/* Master Space Reset & Core Foundation */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: var(--bg-main);
    color: var(--text-light);
    margin: 0;
    padding: 120px 24px 160px 24px; /* Generous breathing room for content clearance */
    display: flex;
    flex-direction: column;
    align-items: center;
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

/* --- PREMIUM TOP-LEFT BACK NAV INTERFACE --- */
.backNavHeader {
    position: absolute;
    top: 40px;
    left: 40px;
    z-index: 1000;
}

#backBtn {
    background-color: transparent;
    color: var(--text-muted);
    border: 1px solid var(--border-subtle);
    padding: 10px 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    border-radius: var(--luxury-radius);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s var(--luxury-ease);
    -webkit-tap-highlight-color: transparent;
}

#backBtn::before {
    content: "←";
    font-size: 0.9rem;
    transition: transform 0.25s var(--luxury-ease);
}

#backBtn:hover {
    color: var(--gold-hover);
    border-color: var(--gold-accent);
    background-color: rgba(212, 175, 55, 0.02);
}

#backBtn:hover::before {
    transform: translateX(-4px);
}

/* --- MAIN CART CONTAINER GRID HOUSING --- */
.cartItems {
    max-width: 1000px;
    width: 100%;
    background: var(--card-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    box-sizing: border-box;
}

/* Cart Multi-Column Row Layout System */
.cartItem {
    display: grid;
    grid-template-columns: auto 2fr 0.6fr 0.8fr 0.6fr 1.2fr auto;
    align-items: center;
    gap: 24px;
    padding: 24px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}

.cartItem:last-of-type {
    border-bottom: 1px solid var(--border-subtle); /* Final golden border break before calculation rows */
}

/* Elegant Image Housing Module */
.cartItemImage {
    width: 80px;
    height: 80px;
    background-color: var(--image-housing);
    border: 1px solid rgba(255, 255, 255, 0.02);
    border-radius: calc(var(--luxury-radius) - 2px);
    overflow: hidden;
}

.cartItemImage img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s var(--luxury-ease);
}

.cartItem:hover .cartItemImage img {
    transform: scale(1.04);
}

/* Product Meta Information Block */
.cartItemMeta h2 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.1rem;
    font-weight: 400;
    letter-spacing: 0.02em;
    color: var(--text-light);
    margin: 0 0 6px 0;
}

.cartItemMeta p {
    margin: 0;
    font-size: 0.9rem;
    color: var(--text-muted);
}

/* Quantitative Control Interface Buttons */
.cartItem button {
    cursor: pointer;
    font-family: inherit;
    border-radius: var(--luxury-radius);
    transition: all 0.25s var(--luxury-ease);
    -webkit-tap-highlight-color: transparent;
    box-sizing: border-box;
}

.decreaseCartBtn,
.increaseCartBtn {
    background-color: var(--image-housing);
    border: 1px solid var(--border-subtle);
    color: var(--text-light);
    width: 34px;
    height: 34px;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.decreaseCartBtn:hover,
.increaseCartBtn:hover {
    border-color: var(--gold-accent);
    color: var(--gold-hover);
    background-color: rgba(212, 175, 55, 0.04);
}

.cartQuantity {
    font-size: 0.95rem;
    font-weight: 500;
    text-align: center;
    display: inline-block;
    min-width: 24px;
    color: var(--text-light);
}

/* Secondary Actions (Remove Line Item) */
.removeCartBtn {
    background-color: transparent;
    color: var(--text-muted);
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.removeCartBtn:hover {
    color: #e06c75; /* Premium soft burgundy target state */
}

/* Dynamic Line Calculated Value Indicator */
.cartItem > p {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-muted);
    text-align: right;
    padding-right: 12px;
}

.itemSubtotal {
    font-weight: 500;
    color: var(--text-light);
}

/* --- CALCULATION TOTAL ROW & CHECKOUT ACTION CONSOLES --- */
.cartTotal {
    text-align: right;
    font-size: 1.2rem;
    font-weight: 500;
    color: var(--text-light);
    margin-top: 24px;
    padding: 12px 0 0 0;
}

#cartTotalValue {
    font-weight: 600;
    color: var(--text-light);
}

/* Anchor normalization styling for checkout route button box wraps */
.cartItems a {
    text-decoration: none;
    display: block;
    margin-top: 24px;
}

/* Primary Grand Checkout Action Command Module */
.cartItems a .cartTotal {
    background-color: var(--gold-accent);
    color: #050505;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    text-align: center;
    padding: 16px 24px;
    border-radius: var(--luxury-radius);
    margin-top: 0;
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.15);
    transition: all 0.3s var(--luxury-ease);
}

.cartItems a:hover .cartTotal {
    background-color: transparent;
    color: var(--gold-hover);
    box-shadow: 0 14px 35px rgba(212, 175, 55, 0.05);
    outline: 1px solid var(--gold-hover);
}

/* --- EMPTY BOUTIQUE STATE CANVAS --- */
.emptyCartMessage {
    text-align: center;
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.1rem;
    letter-spacing: 0.04em;
    color: var(--text-muted);
    background: var(--card-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 60px 40px;
    max-width: 460px;
    width: 100%;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

[hidden] {
    display: none !important;
}

/* Responsive Structural Overhaul adapters */
@media (max-width: 768px) {
    body {
        padding: 100px 16px 140px 16px;
    }

    .backNavHeader {
        top: 32px;
        left: 16px;
    }

    .cartItems {
        padding: 24px;
    }

    .cartItem {
        grid-template-columns: auto 1fr;
        gap: 16px;
        padding: 20px 0;
    }
    
    .cartItemMeta {
        grid-column: span 1;
    }
    
    /* Layout transformations forcing item statistics down onto lower subrows grid stacks */
    .decreaseCartBtn, 
    .cartQuantity, 
    .increaseCartBtn,
    .cartItem > p {
        grid-column: auto;
        justify-self: start;
        text-align: left;
    }

    .cartItem > p {
        grid-column: span 2;
        padding-top: 4px;
    }
    
    .removeCartBtn {
        grid-column: span 2;
        text-align: center;
        width: 100%;
        border: 1px solid rgba(224, 108, 117, 0.2);
        padding: 10px;
        border-radius: var(--luxury-radius);
    }
}
</style>

<body>

<!-- Back Action Module Base Framework -->
<header class="backNavHeader">
    <button type="button" id="backBtn">Back</button>
</header>

<div
    class="cartItems"
    data-page="cart"
    @if ($cartItems->isEmpty()) hidden @endif
>

    @foreach ($cartItems as $item)

    <div
        class="cartItem"
        data-cart-item-id="{{ $item->id }}"
    >
        <div class="cartItemImage">
            @if($item->image_url)
                <img
                src="{{ $item->image_url }}"
                alt="{{ $item->name }}"> 
            @else
                <img src="{{ $item->name }}" alt="Placeholder">
            @endif
        </div>

        <div class="cartItemMeta">
            <h2>{{ $item->product->name }}</h2>
            <p>Price: ₹{{ number_format($item->product->price, 2) }}</p>
        </div>

        <button
            type="button"
            class="decreaseCartBtn"
            data-cart-item-id="{{ $item->id }}"
        >
            −
        </button>

        <span class="cartQuantity">
            {{ $item->quantity }}
        </span>

        <button
            type="button"
            class="increaseCartBtn"
            data-cart-item-id="{{ $item->id }}"
        >
            +
        </button>

        <p>
            Subtotal:
            ₹<span class="itemSubtotal">
                {{ number_format($item->product->price * $item->quantity, 2) }}
            </span>
        </p>

        <button
            type="button"
            class="removeCartBtn"
            data-cart-item-id="{{ $item->id }}"
        >
            Remove
        </button>
    </div>

    @endforeach

    <div class="cartTotal">
        Total:
        ₹<span id="cartTotalValue">
            {{ number_format($cartTotal, 2) }}
        </span>
    </div>

    <a href="{{ route('checkout.index') }}">
    <div class="cartTotal">
        Proceed to Checkout
    </div>
    </a>
</div>

<p
    class="emptyCartMessage"
    @if ($cartItems->isNotEmpty()) hidden @endif
>
    Your cart is empty.
</p>

</body>

<script>
    const backBtn = document.querySelector("#backBtn");
    if(backBtn){
        backBtn.addEventListener('click', function(){
            history.back();
        });
    }
</script>
<script src="{{ asset('js/asyncFunction.js') }}"></script>
</html>