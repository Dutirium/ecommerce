<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        .checkout-loading-overlay {
    position: fixed;
    inset: 0;

    display: none;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);

    z-index: 9999;
}

.checkout-loading-overlay.active {
    display: flex;
}

.checkout-loader {
    width: 50px;
    height: 50px;

    border: 4px solid rgba(255, 255, 255, 0.2);
    border-top-color: white;
    border-radius: 50%;

    animation: checkout-spin 0.8s linear infinite;
}

.checkout-loading-overlay p {
    margin-top: 20px;
    color: white;
    font-size: 1rem;
}

@keyframes checkout-spin {
    to {
        transform: rotate(360deg);
    }
}
    </style>
    <title>Checkout</title>
</head>

<body>

    <main data-page="checkout">

        {{-- loading screen --}}
        <div id="checkoutLoadingOverlay" class="checkout-loading-overlay">
        <div class="checkout-loader"></div>

        <p id="checkoutLoadingText">
            Placing your order...
        </p>
    </div>
        <h1>Checkout</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Shipping Information --}}
        <section>

            <h2>Shipping Information</h2>

            <form
                method="POST"
                action="{{ route('checkout.cod') }}"
                id="checkoutForm"
            >

                @csrf

                <div>
                    <label for="customer_name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        value="{{ old('customer_name', auth()->user()->name) }}"
                        required
                    >
                </div>


                <div>
                    <label for="customer_email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="customer_email"
                        name="customer_email"
                        value="{{ old('customer_email', auth()->user()->email) }}"
                        required
                    >
                </div>


                <div>
                    <label for="customer_phone">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        id="customer_phone"
                        name="customer_phone"
                        value="{{ old('customer_phone') }}"
                        required
                    >
                </div>


                <div>
                    <label for="shipping_address_line_1">
                        Address Line 1
                    </label>

                    <input
                        type="text"
                        id="shipping_address_line_1"
                        name="shipping_address_line_1"
                        value="{{ old('shipping_address_line_1') }}"
                        required
                    >
                </div>


                <div>
                    <label for="shipping_address_line_2">
                        Address Line 2
                    </label>

                    <input
                        type="text"
                        id="shipping_address_line_2"
                        name="shipping_address_line_2"
                        value="{{ old('shipping_address_line_2') }}"
                    >
                </div>


                <div>
                    <label for="shipping_city">
                        City
                    </label>

                    <input
                        type="text"
                        id="shipping_city"
                        name="shipping_city"
                        value="{{ old('shipping_city') }}"
                        required
                    >
                </div>


                <div>
                    <label for="shipping_state">
                        State
                    </label>

                    <input
                        type="text"
                        id="shipping_state"
                        name="shipping_state"
                        value="{{ old('shipping_state') }}"
                        required
                    >
                </div>


                <div>
                    <label for="shipping_postal_code">
                        Postal Code
                    </label>

                    <input
                        type="text"
                        id="shipping_postal_code"
                        name="shipping_postal_code"
                        value="{{ old('shipping_postal_code') }}"
                        required
                    >
                </div>


                <div>
                    <label for="shipping_country">
                        Country
                    </label>

                    <input
                        type="text"
                        id="shipping_country"
                        name="shipping_country"
                        value="{{ old('shipping_country', 'India') }}"
                        required
                    >
                </div>


                {{-- Payment Method --}}

                <section>
                    <h2>Payment Method</h2>

                    <label>
                        <input
                            type="radio"
                            name="payment_method"
                            value="cod"
                            {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                        >

                        Cash on Delivery
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="payment_method"
                            value="razorpay"
                            {{ old('payment_method') === 'razorpay' ? 'checked' : '' }}
                        >

                        Online Payment
                    </label>
                </section>


                {{-- Order Summary --}}

                <section>

                    <h2>Order Summary</h2>

                    @foreach ($cartItems as $item)

                        <div>
                            <p>
                                {{ $item->product->name }}
                            </p>

                            <p>
                                Quantity: {{ $item->quantity }}
                            </p>

                            <p>
                                ₹{{ number_format(
                                    $item->product->price * $item->quantity,
                                    2
                                ) }}
                            </p>
                        </div>

                    @endforeach


                    <p>
                        Subtotal:
                        ₹{{ number_format($subtotal, 2) }}
                    </p>

                    <p>
                        Shipping:
                        ₹{{ number_format($shippingAmount, 2) }}
                    </p>

                    <strong>
                        Total:
                        ₹{{ number_format($totalAmount, 2) }}
                    </strong>

                </section>


                <button type="submit"
                id="checkoutButton">
                    Place Order
                </button>


            </form>

        </section>

    </main>

</body>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('js/checkout.js') }}"></script>
<script>

    const loadingOverlay = document.querySelector(
    "#checkoutLoadingOverlay"
);

const loadingText = document.querySelector(
    "#checkoutLoadingText"
);



</script>
</html>