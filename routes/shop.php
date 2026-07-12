<?php
use App\Http\Controllers\Admin\AdminDiscountCodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;

Route::get('/list', [ProductController::class, 'index']);

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');


Route::middleware('auth')->group(function () {

    //discount
    Route::post(
    '/coupon/apply',
        [CouponController::class, 'apply']
    )->name('coupon.apply');


    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'show'])
        ->name('wishlist.show');

    Route::post('/wishlist', [WishlistController::class, 'store'])
        ->name('wishlist.store');


    // Cart page
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');


    // Add product to cart
    Route::post('/cart', [CartController::class, 'store'])
        ->name('cart.store');


    // Increase quantity
    Route::patch(
        '/cart/{cartItem}/increase',
        [CartController::class, 'increase']
    )->name('cart.increase');


    // Decrease quantity
    Route::patch(
        '/cart/{cartItem}/decrease',
        [CartController::class, 'decrease']
    )->name('cart.decrease');


    // Remove cart item
    Route::delete(
        '/cart/{cartItem}',
        [CartController::class, 'destroy']
    )->name('cart.destroy');


    // Checkout products
    Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

    Route::post('/checkout/cod', [CheckoutController::class, 'storeCod'])
    ->name('checkout.cod');

    Route::get('/checkout/success/{order}', [
    CheckoutController::class,
    'success'
    ])->name('checkout.success');

    //razorpay routes
    Route::post(
    '/checkout/razorpay/order',
    [CheckoutController::class, 'createRazorpayOrder']
    )->name('checkout.razorpay.order');

    Route::post(
    '/checkout/razorpay/verify',
    [CheckoutController::class, 'verifyRazorpayPayment']
    )->name('checkout.razorpay.verify');

    //Admin routes
   Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');


        Route::get(
            '/products',
            [AdminProductController::class, 'index']
        )->name('products.index');


        Route::get(
            '/products/create',
            [AdminProductController::class, 'create']
        )->name('products.create');


        Route::post(
            '/products',
            [AdminProductController::class, 'store']
        )->name('products.store');


        Route::get(
            '/products/{product}/edit',
            [AdminProductController::class, 'edit']
        )->name('products.edit');


        Route::put(
            '/products/{product}',
            [AdminProductController::class, 'update']
        )->name('products.update');


        Route::patch(
            '/products/{product}/toggle-status',
            [AdminProductController::class, 'toggleStatus']
        )->name('products.toggleStatus');

        Route::resource(
            'discountCodes',
            AdminDiscountCodeController::class
        );

        Route::delete(
    '/discount/{discountCode}',
    [AdminDiscountCodeController::class, 'destroy']
)->name('discount.destroy');

Route::get(
    '/discount/{discountCode}/edit',
    [AdminDiscountCodeController::class, 'edit']
)->name('discount.edit');

Route::put(
    '/discount/{discountCode}',
    [AdminDiscountCodeController::class, 'update']
)->name('discount.update');

    });
   
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');
});