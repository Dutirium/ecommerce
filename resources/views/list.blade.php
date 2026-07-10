
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rj Store</title>
</head>

<body style="padding-bottom: 120px">
    <x-navBarTop />
    <x-sideBar />
    
    <div class="productGrid">
        @foreach($products as $product) 
          <x-product 
          :product="$product" 
          :wishlistProductIds="$wishlistProductIds" 
          />
         @endforeach
    </div>

    <x-navBarBottom />
</body>
<script src="{{ asset('js/asyncFunction.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
</html>