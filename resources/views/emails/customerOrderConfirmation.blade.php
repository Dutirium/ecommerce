<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body>

    <h1>Order Confirmed</h1>

    <p>
        Hello {{ $order->customer_name }},
    </p>

    <p>
        Your order has been placed successfully.
    </p>

    <p>
        <strong>Order Number:</strong>
        {{ $order->order_number }}
    </p>

    <h2>Order Items</h2>

    <table cellpadding="8" cellspacing="0" border="1">

        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($order->items as $item)

                <tr>
                    
                    <td>{{ $item->product_name }}</td>

                    <td>{{ $item->quantity }}</td>
                    
                    <td>
                        @if ($item->size)
                            Size: {{ $item->size }}
                        @endif
                    </td>
                    
                    <td>
                        Rs. {{ number_format($item->unit_price, 2) }}
                    </td>

                    <td>
                        Rs. {{ number_format($item->subtotal, 2) }}
                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>

    <p>
        <strong>Total:</strong>
        Rs. {{ number_format($order->total_amount, 2) }}
    </p>

<p>
    Payment Method:
    {{ $order->payment_method === 'razorpay'
        ? 'Online Payment (Razorpay)'
        : 'Cash on Delivery'
    }}
</p>

    <p>
        <strong>Payment Status:</strong>
        {{ ucfirst($order->payment_status) }}
    </p>

    <p>
        Your receipt is attached to this email.
    </p>

</body>

</html>