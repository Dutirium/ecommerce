<link rel="stylesheet" href="{{ asset('css/navBarBottom.css') }}">

<nav class="bottomNav">

    <a href="{{ route('wishlist.show') }}">
    <button class="navBtn">
        ❤
        <span>Wishlist</span>
    </button>
    </a>
    
    <button class="navBtn">
        🏠
        <span>Home</span>
    </button>

    <a href="{{ route('cart.index') }}">
    <button class="navBtn">
        🛒
        <span>Cart</span>
    </button>
    </a>

    <a href="{{ route('orders.index') }}" class="profileBtn">
    <button class="navBtn">
        📦
        <span>Orders</span>
    </button>
    </a>
</nav>