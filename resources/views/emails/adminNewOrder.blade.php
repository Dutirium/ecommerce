<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Order</title>
</head>

<body>

    <h1>New Order Received</h1>

    <p>
        <strong>Order Number:</strong>
        {{ $order->order_number }}
    </p>

    <p>
        <strong>Payment Method:</strong>
        Cash on Delivery
    </p>

    <p>
        <strong>Payment Status:</strong>
        {{ ucfirst($order->payment_status) }}
    </p>


    <h2>Customer Information</h2>

    <p>
        Name: {{ $order->customer_name }}
    </p>

    <p>
        Email: {{ $order->customer_email }}
    </p>

    <p>
        Phone: {{ $order->customer_phone }}
    </p>


    <h2>Shipping Address</h2>

    <p>
        {{ $order->shipping_address_line_1 }}

        @if ($order->shipping_address_line_2)
            <br>
            {{ $order->shipping_address_line_2 }}
        @endif

        <br>

        {{ $order->shipping_city }},
        {{ $order->shipping_state }}

        <br>

        {{ $order->shipping_postal_code }}

        <br>

        {{ $order->shipping_country }}
    </p>


    <h2>Products</h2>

    <table cellpadding="8" cellspacing="0" border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($order->items as $item)

                <tr>

                    <td>
                        {{ $item->product_id ?? 'Deleted Product' }}
                    </td>

                    <td>
                        {{ $item->product_name }}
                    </td>

                    <td>
                        Rs. {{ number_format($item->unit_price, 2) }}
                    </td>

                    <td>
                        {{ $item->quantity }}
                    </td>

                    <td>
                        Rs. {{ number_format($item->subtotal, 2) }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    <h2>
        Total:
        Rs. {{ number_format($order->total_amount, 2) }}
    </h2>

</body>

</html>