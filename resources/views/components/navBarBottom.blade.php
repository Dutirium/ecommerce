<link rel="stylesheet" href="{{ asset('css/navBarBottom.css') }}">

<nav class="bottomNav">

    <a href="{{ route('wishlist.show') }}">
    <button class="navBtn">
        ❤
        <span>Wishlist</span>
    </button>
    </a>
    
    <button class="navBtn" id="scrollToTopBtn" title="Go to top">
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

<script>
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

// Show the button when the user scrolls down 300px from the top
window.onscroll = function() {
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    scrollToTopBtn.classList.add("show");
  } else {
    scrollToTopBtn.classList.remove("show");
  }
};

// When the user clicks the button, smoothly scroll to the top
scrollToTopBtn.addEventListener("click", function() {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});
</script>