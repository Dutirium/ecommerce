<head>
        <link rel="stylesheet" href="{{ asset('css/navBarTop.css') }}">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

:root {
    /* Deep Luxury Color Canvas */
    --bg-main: #0a0e17;              /* Deep, imperial midnight navy */
    --panel-surface: #121824;        /* Rich charcoal-navy compound card surface */
    
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

/* Master Space Reset & Workspace Base Layout Alignment */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: var(--bg-main);
    color: var(--text-light);
    margin: 0;
    padding: 0 0 160px 0; /* Clear room for floating navigation docks */
    -webkit-font-smoothing: antialiased;
}

/* --- MAIN PAGE CONTENT LAYOUT SHELL --- */
.orderDetailsPage {
    max-width: 850px;
    width: 100%;
    margin: 48px auto;
    padding: 0 32px;
    box-sizing: border-box;
}

/* Inline Navigation History Anchor */
.orderDetailsPage > a:first-of-type {
    display: inline-flex;
    align-items: center;
    color: var(--text-muted);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    text-decoration: none;
    margin-bottom: 24px;
    transition: color 0.25s ease, transform 0.25s var(--luxury-ease);
}

.orderDetailsPage > a:first-of-type:hover {
    color: var(--gold-hover);
    transform: translateX(-4px);
}

/* Primary Page Heading (Order #) */
.orderDetailsPage h1 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 2.2rem;
    font-weight: 400;
    letter-spacing: 0.03em;
    color: var(--text-light);
    margin: 0 0 32px 0;
}

/* Section Container Headings */
.orderDetailsPage h2 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 400;
    letter-spacing: 0.06em;
    color: var(--gold-accent);
    text-transform: uppercase;
    margin: 0 0 24px 0;
}

/* Premium Divider Rules decoration */
.orderDetailsPage hr {
    border: none;
    border-top: 1px solid var(--border-subtle);
    margin: 40px 0;
}

/* --- SECTION 1: CORE CORE SUMMARY DATA GRID --- */
.orderSummary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.orderSummary p {
    margin: 0;
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.5;
}

/* --- SECTION 2: PRODUCT ROWS MATRICES --- */
.orderItems {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.orderItem {
    display: grid;
    grid-template-columns: 2fr repeat(3, 1fr);
    align-items: center;
    background-color: var(--panel-surface);
    border: 1px solid rgba(255, 255, 255, 0.03);
    border-radius: var(--luxury-radius);
    padding: 20px 24px;
}

.orderItem h3 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: 0.02em;
    color: var(--text-light);
    margin: 0;
}

.orderItem p {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-muted);
    text-align: right;
}

.orderItem p:last-of-type {
    font-weight: 500;
    color: var(--text-light); /* Highlights line item totals */
}

/* --- SECTION 3: CALCULATION PRICING LEDGER --- */
.priceSummary {
    max-width: 400px;
    margin-left: auto; /* Aligns financial breakdown card gracefully to the right wall */
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 28px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
}

.priceSummary p {
    display: flex;
    justify-content: space-between;
    margin: 12px 0;
    font-size: 0.95rem;
    color: var(--text-muted);
}

.priceSummary strong {
    display: flex;
    justify-content: space-between;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gold-accent);
    border-top: 1px solid var(--border-subtle);
    padding-top: 16px;
    margin-top: 16px;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

/* --- SECTION 4: ADDRESS SHIPPING PARCELS CONTAINER --- */
.shippingAddress {
    background-color: var(--panel-surface);
    border-radius: var(--luxury-radius);
    border: 1px solid rgba(255, 255, 255, 0.02);
    padding: 32px;
}

.shippingAddress p {
    margin: 6px 0;
    font-size: 0.95rem;
    color: var(--text-muted);
    line-height: 1.5;
}

/* Emphasize the buyer target name indicator line */
.shippingAddress p:first-of-type {
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--text-light);
    margin-bottom: 12px;
}

/* --- COMPACT RESPONSIVE REALIGNMENTS --- */
@media (max-width: 768px) {
    .orderDetailsPage {
        padding: 0 16px;
        margin: 24px auto;
    }

    .orderDetailsPage h1 {
        font-size: 1.75rem;
        margin-bottom: 24px;
    }

    .orderSummary {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .orderItem {
        grid-template-columns: 1fr;
        gap: 8px;
        padding: 16px;
    }

    .orderItem p {
        text-align: left;
        font-size: 0.9rem;
    }

    .priceSummary {
        max-width: 100%;
        margin-left: 0;
    }
}
</style>

</head>

<x-navBarTop />

<main class="orderDetailsPage">

    <a href="{{ route('orders.index') }}">
        ← Back to Orders
    </a>

    <h1>
        Order #{{ $order->order_number }}
    </h1>

    <section class="orderSummary">

        <p>
            Date:
            {{ $order->created_at->format('d M Y, h:i A') }}
        </p>

        <p>
            Payment Method:
            {{ strtoupper($order->payment_method) }}
        </p>

        <p>
            Payment Status:
            {{ ucfirst($order->payment_status) }}
        </p>

        <p>
            Order Status:
            {{ ucfirst($order->order_status) }}
        </p>

    </section>

    <hr>

    <section class="orderItems">

        <h2>Items</h2>

        @foreach ($order->items as $item)

            <article class="orderItem">

                <h3>
                    {{ $item->product_name }}
                </h3>

                <p>
                    Price:
                    ₹{{ number_format($item->unit_price, 2) }}
                </p>

                <p>
                    Quantity:
                    {{ $item->quantity }}
                </p>

                <p>
                    Subtotal:
                    ₹{{ number_format($item->subtotal, 2) }}
                </p>

            </article>

        @endforeach

    </section>

    <hr>

    <section class="priceSummary">

        <h2>Price Summary</h2>

        <p>
            Subtotal:
            ₹{{ number_format($order->subtotal, 2) }}
        </p>

        <p>
            Shipping:
            ₹{{ number_format($order->shipping_amount, 2) }}
        </p>

        <strong>
            Total:
            ₹{{ number_format($order->total_amount, 2) }}
        </strong>

    </section>

    <hr>

    <section class="shippingAddress">

        <h2>Shipping Address</h2>

        <p>{{ $order->customer_name }}</p>

        <p>{{ $order->customer_phone }}</p>

        <p>{{ $order->shipping_address_line_1 }}</p>

        @if ($order->shipping_address_line_2)
            <p>{{ $order->shipping_address_line_2 }}</p>
        @endif

        <p>
            {{ $order->shipping_city }},
            {{ $order->shipping_state }}
        </p>

        <p>{{ $order->shipping_postal_code }}</p>

        <p>{{ $order->shipping_country }}</p>

    </section>

</main>

