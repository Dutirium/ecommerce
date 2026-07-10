

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
    padding: 0 0 160px 0; /* Comprehensive clearance for bottom floating navigation template */
    -webkit-font-smoothing: antialiased;
}

/* --- ORDERS MAIN PAGE LAYOUT PANEL --- */
.ordersPage {
    max-width: 900px;
    width: 100%;
    margin: 48px auto;
    padding: 0 32px;
    box-sizing: border-box;
}

/* Elegant Editorial Page Primary Title */
.ordersPage h1 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 2.2rem;
    font-weight: 400;
    letter-spacing: 0.04em;
    color: var(--text-light);
    text-transform: uppercase;
    margin: 0 0 40px 0;
    border-bottom: 1px solid var(--border-subtle);
    padding-bottom: 20px;
}

/* --- THE BOUTIQUE INVOICE CARD ARCHITECTURE --- */
.orderCard {
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 32px;
    margin-bottom: 28px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 12px 24px;
    align-items: center;
    position: relative;
    transition: transform 0.3s var(--luxury-ease), border-color 0.3s ease, box-shadow 0.3s var(--luxury-ease);
}

/* Subtle, expansive depth shadow elevation switch on card item hover */
.orderCard:hover {
    transform: translateY(-4px);
    border-color: rgba(212, 175, 55, 0.25);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
}

/* Luxury Serif Card Subheadings (Order Number) */
.orderCard h2 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 400;
    letter-spacing: 0.02em;
    color: var(--text-light);
    margin: 0;
    grid-column: 1;
}

/* Metadata Text Line Item Elements styling */
.orderCard p {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-muted);
}

/* Explicitly locate total and metadata fields inside layout matrix paths */
.orderCard p:contains("Total"),
.orderCard p:nth-of-type(2) {
    font-weight: 600;
    color: var(--gold-accent);
    font-size: 1.05rem;
}

/* Align sub-data values down onto dynamic columns blocks */
.orderCard p:nth-of-type(1) { grid-column: 1; } /* Date */
.orderCard p:nth-of-type(2) { grid-column: 1; } /* Total */
.orderCard p:nth-of-type(3) { grid-column: 1; } /* Payment Status */
.orderCard p:nth-of-type(4) { grid-column: 1; } /* Order Status */

/* --- DETAILED VIEW ROUTER ACTION TRIGGER LINK --- */
.orderCard a {
    grid-column: 2;
    grid-row: 1 / span 5; /* Spans across entire card height to balance alignment vertically */
    justify-self: end;
    
    display: inline-block;
    padding: 12px 24px;
    background-color: transparent;
    color: var(--gold-accent);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.3s var(--luxury-ease);
    box-shadow: none;
}

.orderCard a:hover {
    color: var(--gold-hover);
    border-color: var(--gold-accent);
    background-color: rgba(212, 175, 55, 0.02);
}

.orderCard a:active {
    transform: scale(0.97);
}

/* --- EMPTY TIMELISS ACCOUNT HISTORY STATE VIEW --- */
.ordersPage > p:first-of-type {
    font-size: 1rem;
    color: var(--text-muted);
    letter-spacing: 0.01em;
    padding: 40px 0;
    text-align: center;
}

/* --- LARAVEL BLADE NATIVE PAGINATION ARCHITECTURE OVERRIDES --- */
.ordersPage nav,
.ordersPage .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-top: 48px;
}

.ordersPage .pagination a,
.ordersPage .pagination span {
    padding: 10px 16px;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-muted);
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    text-decoration: none;
    transition: all 0.2s ease;
}

.ordersPage .pagination .active span {
    color: var(--gold-accent);
    border-color: var(--gold-accent);
    background-color: rgba(212, 175, 55, 0.03);
}

.ordersPage .pagination a:hover {
    color: var(--text-light);
    border-color: rgba(255, 255, 255, 0.15);
}

/* --- RESPONSIVE STRUCTURAL OVERHAUL BREAKPOINTS --- */
@media (max-width: 768px) {
    .ordersPage {
        padding: 0 16px;
        margin: 24px auto;
    }

    .ordersPage h1 {
        font-size: 1.65rem;
        margin-bottom: 28px;
    }

    .orderCard {
        grid-template-columns: 1fr;
        gap: 14px;
        padding: 24px;
    }

    .orderCard a {
        grid-column: 1;
        grid-row: auto;
        justify-self: stretch;
        text-align: center;
        margin-top: 8px;
    }
}
</style>
</head>
<x-navBarTop />

<main class="ordersPage">

    <h1>My Orders</h1>

    @forelse ($orders as $order)

        <article class="orderCard">

            <h2>
                Order #{{ $order->order_number }}
            </h2>

            <p>
                Date:
                {{ $order->created_at->format('d M Y') }}
            </p>

            <p>
                Total:
                ₹{{ number_format($order->total_amount, 2) }}
            </p>

            <p>
                Payment:
                {{ ucfirst($order->payment_status) }}
            </p>

            <p>
                Status:
                {{ ucfirst($order->order_status) }}
            </p>

            <a href="{{ route('orders.show', $order) }}">
                View Order
            </a>

        </article>

    @empty

        <p>You have not placed any orders yet.</p>

    @endforelse

    {{ $orders->links() }}

</main>

