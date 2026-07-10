<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
/* --- HIGH-CONTRAST LUXURY CORE SYSTEM --- */
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

/* Master Reset & Content Isolation Container Alignment */
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: var(--bg-main);
    color: var(--text-light);
    margin: 0;
    padding: 0 0 160px 0; /* Integrated workspace clearance for bottom floating navigation */
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
}

/* Centralized Alignment Layout Well */
.pageWrapper {
    display: flex;
    justify-content: center;
    padding: 60px 24px;
    box-sizing: border-box;
}

/* Master Invoice Confirmation Card */
.successContainer {
    max-width: 650px;
    width: 100%;
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 48px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
    box-sizing: border-box;
}

/* Elegant Serif Core Document Title (Order Placed Successfully) */
.successContainer h1 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.8rem;
    font-weight: 400;
    letter-spacing: 0.04em;
    color: var(--text-light);
    text-transform: uppercase;
    text-align: center;
    margin: 0 0 36px 0;
}

/* Secondary Section Titles (Items Header) */
.successContainer h2 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 400;
    letter-spacing: 0.06em;
    color: var(--gold-accent);
    margin: 40px 0 20px 0;
    border-bottom: 1px solid var(--border-subtle);
    padding-bottom: 10px;
    text-transform: uppercase;
}

/* Metadata Text Line Formatting (Order Number, Method, Total) */
.metaRow {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text-light);
    border-bottom: 1px dashed rgba(255, 255, 255, 0.04);
    padding: 14px 0;
    margin: 0;
}

.metaRow span:first-of-type {
    color: var(--text-muted);
}

/* Emphasize the checkout value grand sum total line explicitly */
.metaRow.totalHighlight {
    color: var(--gold-accent);
    font-size: 1.25rem;
    font-weight: 600;
    border-bottom: 1px solid var(--border-subtle);
    padding: 18px 0;
    margin-top: 12px;
}

.metaRow.totalHighlight span:first-of-type {
    color: var(--gold-accent);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* --- ORDERED ITEMS ITERATION MATRIX LOOP --- */
.itemRow {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 4px;
    padding: 16px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}

.itemRow:last-of-type {
    border-bottom: none; /* Strip lower line from final array index loop */
}

.itemRow p {
    margin: 0;
}

/* Product title context string rules */
.itemRow .itemName {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--text-light);
    grid-column: 1;
}

/* Quantity descriptor metrics line formatting */
.itemRow .itemQty {
    font-size: 0.85rem;
    color: var(--text-muted);
    grid-column: 1;
    margin-top: 4px;
}

/* Subtotal transaction output strings aligned right */
.itemRow .itemSubtotal {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-light);
    text-align: right;
    grid-row: span 2;
    grid-column: 2;
    align-self: center;
}

/* Standard Return Link Execution CTA Block */
.returnStoreBtn {
    display: block;
    text-align: center;
    text-decoration: none;
    background-color: transparent;
    color: var(--gold-accent);
    border: 1px solid var(--border-subtle);
    padding: 16px 24px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    border-radius: var(--luxury-radius);
    margin-top: 40px;
    transition: all 0.3s var(--luxury-ease);
}

.returnStoreBtn:hover {
    color: var(--gold-hover);
    border-color: var(--gold-accent);
    background-color: rgba(212, 175, 55, 0.02);
}

.returnStoreBtn:active {
    transform: scale(0.99);
}

/* Compact Mobile Terminal Adjustments */
@media (max-width: 640px) {
    .pageWrapper {
        padding: 32px 16px;
    }

    .successContainer {
        padding: 32px 20px;
    }

    .successContainer h1 {
        font-size: 1.45rem;
        margin-bottom: 28px;
    }
}
</style>

<body>

    <!-- Unified Luxury Header System Call Component -->
    <x-navBarTop />

    <div class="pageWrapper">
        
        <main class="successContainer">

            <h1>Order Placed Successfully</h1>

            <!-- Structured Metadata List blocks -->
            <div class="metaRow">
                <span>Order Number</span>
                <span>{{ $order->order_number }}</span>
            </div>

            <div class="metaRow">
                <span>Payment Method</span>
                <span>{{ strtoupper($order->payment_method) }}</span>
            </div>

            <div class="metaRow totalHighlight">
                <span>Total Amount</span>
                <span>{{ number_format($order->total_amount, 2) }}</span>
            </div>

            <h2>Items Ordered</h2>

            <!-- Collection Matrix Loop Processing -->
            @foreach ($order->items as $item)
                <div class="itemRow">
                    <p class="itemName">{{ $item->product_name }}</p>
                    <p class="itemQty">Quantity: {{ $item->quantity }}</p>
                    <p class="itemSubtotal">{{ number_format($item->subtotal, 2) }}</p>
                </div>
            @endforeach

            <!-- Navigation Return Router Link Anchor -->
            <a href="/" class="returnStoreBtn">Continue Shopping</a>

        </main>

    </div>

</body>
</html>