<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        Receipt {{ $order->order_number }}
    </title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .header h2 {
            margin-top: 0;
            font-weight: normal;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

        .totals {
            width: 45%;
            margin-left: auto;
            margin-top: 20px;
        }

        .totals td {
            border: none;
            padding: 5px;
        }

        .total-row {
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>


<body>

    {{-- Receipt Header --}}

    <div class="header">

        <h1>RJ Store</h1>

        <h2>Order Receipt</h2>

        <p>
            <strong>Order Number:</strong>
            {{ $order->order_number }}
        </p>

        <p>
            <strong>Order Date:</strong>
            {{ $order->created_at->format('d M Y, h:i A') }}
        </p>

    </div>


    {{-- Customer Information --}}

    <div class="section">

        <div class="section-title">
            Customer Information
        </div>

        <p>
            <strong>Name:</strong>
            {{ $order->customer_name }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ $order->customer_email }}
        </p>

        <p>
            <strong>Phone:</strong>
            {{ $order->customer_phone }}
        </p>

    </div>


    {{-- Shipping Address --}}

    <div class="section">

        <div class="section-title">
            Shipping Address
        </div>

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

    </div>


    {{-- Purchased Products --}}

    <div class="section">

        <div class="section-title">
            Purchased Items
        </div>


        <table>

            <thead>

                <tr>
                    <th>Product</th>
                    <th>Product ID</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

            </thead>


            <tbody>

                @foreach ($order->items as $item)

                    <tr>

                        <td>
                            {{ $item->product_name }}
                        </td>

                        <td>
                            {{ $item->product_id ?? 'N/A' }}
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


        {{-- Order Totals --}}

        <table class="totals">

            <tr>

                <td>
                    Subtotal:
                </td>

                <td>
                    Rs. {{ number_format($order->subtotal, 2) }}
                </td>

            </tr>


            <tr>

                <td>
                    Shipping:
                </td>

                <td>
                    Rs. {{ number_format($order->shipping_amount, 2) }}
                </td>

            </tr>


            <tr class="total-row">

                <td>
                    Total:
                </td>

                <td>
                    Rs. {{ number_format($order->total_amount, 2) }}
                </td>

            </tr>

        </table>

    </div>


    {{-- Payment Information --}}

    <div class="section">

        <div class="section-title">
            Payment Information
        </div>


        @if ($order->payment_method === 'cod')

            <p>
                <strong>Payment Method:</strong>
                Cash on Delivery
            </p>

        @else

            <p>
                <strong>Payment Method:</strong>
                Online Payment
            </p>

        @endif


        <p>
            <strong>Payment Status:</strong>
            {{ ucfirst($order->payment_status) }}
        </p>


        @if ($order->razorpay_payment_id)

            <p>
                <strong>Transaction ID:</strong>
                {{ $order->razorpay_payment_id }}
            </p>

        @endif


        <p>
            <strong>Order Status:</strong>
            {{ ucfirst($order->order_status) }}
        </p>

    </div>


    {{-- Footer --}}

    <div class="footer">

        <p>
            Thank you for shopping with RJ Store.
        </p>

        <p>
            Receipt generated for order
            {{ $order->order_number }}.
        </p>

    </div>

</body>

</html>