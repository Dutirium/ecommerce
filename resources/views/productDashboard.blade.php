<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productDashboard.css') }}">

</head>

<body>

    <x-navBarTop />

    <x-sideBar />
    
    @if (session('success'))
        <div id="toast" class="toast-notification">
            {{ session('success') }}
        </div>
    @endif
    
    <x-productDashboard :product="$product" 
    :relatedProducts="$relatedProducts"
    :wishlistProductIds="$wishlistProductIds"
    />
    
    <x-navBarBottom />

</body>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/productDashboard.js') }}"></script>
<script src="{{ asset('js/asyncFunction.js') }}"></script>
</html>