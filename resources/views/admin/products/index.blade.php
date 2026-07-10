<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
            --text-alert: #e06c75;           /* Refined, muted burgundy warning */
            --text-success: #34d399;         /* Smooth emerald accent */
            
            /* Structural Curves & Sophisticated Springs */
            --luxury-radius: 8px;            
            --luxury-bounce: cubic-bezier(0.43, 1.45, 0.48, 1);
            --luxury-ease: cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* Master Space Reset & Base Workspace Realignment */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-light);
            margin: 0;
            padding: 40px 24px 160px 24px; /* Clearance for bottom navigation components */
            display: flex;
            justify-content: center;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        /* --- DASHBOARD WRAPPER PANEL --- */
        .admin-products {
            max-width: 1200px;
            width: 100%;
            background-color: var(--panel-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--luxury-radius);
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            box-sizing: border-box;
        }

        /* --- THE HEADER CONSOLE BLOCK --- */
        .admin-products-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 24px;
            margin-bottom: 32px;
        }

        .admin-products-header h1 {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 0.04em;
            color: var(--text-light);
            text-transform: uppercase;
            margin: 0;
        }

        /* Add Product Router Key */
        .admin-products-header a {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--gold-accent);
            color: #050505;
            border: 1px solid var(--gold-accent);
            border-radius: var(--luxury-radius);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.15);
            transition: color 0.25s ease, border-color 0.3s ease, transform 0.4s var(--luxury-bounce), box-shadow 0.4s var(--luxury-ease);
        }

        .admin-products-header a:hover {
            background-color: transparent;
            color: var(--gold-hover);
            border-color: var(--gold-hover);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 14px 30px rgba(212, 175, 55, 0.05);
        }

        /* --- IMMERSIVE STATUS FLASH FLASH CARDS --- */
        .success-message {
            background-color: rgba(52, 211, 153, 0.03);
            border: 1px solid var(--text-success);
            color: var(--text-success);
            border-radius: var(--luxury-radius);
            padding: 16px 24px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 32px;
            letter-spacing: 0.02em;
        }

        /* --- DATA WORKSPACE SHEETS TABLE --- */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 32px;
        }

        th {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold-accent);
            text-align: left;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-subtle);
        }

        td {
            padding: 18px 20px;
            font-size: 0.95rem;
            color: var(--text-muted);
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: middle;
        }

        tr:last-of-type td {
            border-bottom: none;
        }

        td img {
            border-radius: 4px;
            object-fit: cover;
            aspect-ratio: 1/1;
            background-color: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.04);
            display: block;
        }

        td:nth-of-type(3) {
            color: var(--text-light);
            font-weight: 500;
        }

        /* Inline badge metrics system layout labels */
        td span {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        /* Out of Stock system layout flags exception formatting rules */
        td span:not([class]) {
            background-color: rgba(224, 108, 117, 0.06);
            color: var(--text-alert);
            border: 1px solid rgba(224, 108, 117, 0.2);
            margin-top: 4px;
            display: block;
            width: fit-content;
        }

        .status-active {
            background-color: rgba(52, 211, 153, 0.05);
            color: var(--text-success);
            border: 1px solid rgba(52, 211, 153, 0.2);
        }

        .status-inactive {
            background-color: rgba(143, 160, 188, 0.05);
            color: var(--text-muted);
            border: 1px solid rgba(143, 160, 188, 0.2);
        }

        /* --- CONTROL CONSOLE LINKS & BUTTON KEYS --- */
        td > a {
            display: inline-block;
            padding: 8px 16px;
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--border-subtle);
            border-radius: var(--luxury-radius);
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-decoration: none;
            margin-right: 8px;
            transition: all 0.3s var(--luxury-ease);
        }

        td > a:hover {
            color: var(--gold-hover);
            border-color: var(--gold-accent);
            background-color: rgba(212, 175, 55, 0.02);
            transform: translateY(-2px);
        }

        td button[type="submit"] {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid transparent;
            padding: 8px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            font-family: inherit;
            border-radius: var(--luxury-radius);
            transition: all 0.3s var(--luxury-ease);
        }

        tr:hover button[type="submit"] {
            color: var(--text-light);
        }

        td button[type="submit"]:hover {
            border-color: var(--text-alert);
            color: var(--text-alert) !important;
            background-color: rgba(224, 108, 117, 0.02);
            transform: translateY(-2px);
        }

        td button[type="submit"]:active,
        td > a:active {
            transform: scale(0.96);
        }

        /* --- HIGH-END NATIVE LARAVEL PAGINATION CONTROLS OVERHAUL --- */
        .pagination {
            display: flex;
            justify-content: space-between; /* Separates the page counts tracker from navigation tracks */
            align-items: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid rgba(212, 175, 55, 0.05);
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 100%;
        }

        /* Formats native text blocks ("Showing 1 to 10...") */
        .pagination p,
        .pagination .text-sm {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* Navigation block structural capsule well */
        .pagination nav {
            display: inline-flex;
            align-items: center;
            border-radius: var(--luxury-radius);
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.15);
            border: 1px solid var(--border-subtle);
        }

        /* Normalize pagination element tracks variables */
        .pagination nav a,
        .pagination nav span,
        .pagination nav div {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            background-color: transparent;
            border: none;
            border-right: 1px solid rgba(212, 175, 55, 0.08);
            transition: all 0.25s var(--luxury-ease);
        }

        .pagination nav a:last-of-type,
        .pagination nav span:last-of-type {
            border-right: none;
        }

        /* Selected page active status layout marker indicator */
        .pagination nav span[aria-current="page"],
        .pagination nav .bg-indigo-50,
        .pagination nav [class*="active"] {
            color: var(--gold-accent) !important;
            background-color: rgba(212, 175, 55, 0.04) !important;
            font-weight: 600;
        }

        .pagination nav a:hover {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.02);
        }

        /* --- THE ARROW SYSTEM OVERRIDE MATRIX (< and >) --- 
           Locks oversized Laravel Tailwind template arrows into high-definition scale ratios
        */
        .pagination nav svg,
        .pagination nav a svg,
        .pagination nav span svg {
            width: 14px !important;
            height: 14px !important;
            display: inline-block;
            vertical-align: middle;
            fill: currentColor;
            stroke: currentColor;
            stroke-width: 1.5;
            transition: transform 0.2s var(--luxury-ease);
        }

        /* Interactive kinetic snapping translations applied to arrow objects */
        .pagination nav a:first-of-type:hover svg {
            transform: translateX(-2px); /* Pops Left Arrow (<) */
        }

        .pagination nav a:last-of-type:hover svg {
            transform: translateX(2px); /* Pops Right Arrow (>) */
        }

        /* Disabled page pagination edge loops */
        .pagination nav span[aria-disabled="true"] {
            color: rgba(143, 160, 188, 0.25) !important;
            cursor: not-allowed;
            background-color: transparent !important;
        }

        /* Mobile Layout Form Conversions */
        @media (max-width: 992px) {
            body {
                padding: 24px 16px 120px 16px;
            }

            .admin-products {
                padding: 24px;
                overflow-x: auto;
            }

            table {
                min-width: 850px; /* Establishes clean side scroll parameters on tight screens */
            }
        }

        @media (max-width: 680px) {
            .pagination {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
            
            .pagination p {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="admin-products">

    {{-- Page Header --}}
    <div class="admin-products-header">

        <h1>
            Products
        </h1>

        <a href="{{ route('admin.products.create') }}">
            Add Product
        </a>

    </div>


    {{-- Success Message --}}
    @if (session('success'))

        <div class="success-message">
            {{ session('success') }}
        </div>

    @endif


    {{-- Products Table --}}
    <table>

        <thead>

            <tr>
                <th>ID</th>

                <th>Image</th>

                <th>Name</th>

                <th>Price</th>

                <th>Stock</th>

                <th>Status</th>

                <th>Actions</th>
            </tr>

        </thead>


        <tbody>

            @forelse ($products as $product)

                <tr>

                    {{-- Product ID --}}
                    <td>
                        {{ $product->id }}
                    </td>


                    {{-- Product Image --}}
                    <td>

                        @if ($product->image)

                            <img
                                src="{{ asset($product->image) }}"
                                alt="{{ $product->name }}"
                                width="60"
                            >

                        @else

                            No Image

                        @endif

                    </td>


                    {{-- Product Name --}}
                    <td>
                        {{ $product->name }}
                    </td>


                    {{-- Product Price --}}
                    <td>
                        ₹{{ number_format($product->price, 2) }}
                    </td>


                    {{-- Product Stock --}}
                    <td>

                        {{ $product->stock }}

                        @if ($product->stock === 0)

                            <span>
                                Out of Stock
                            </span>

                        @endif

                    </td>


                    {{-- Product Status --}}
                    <td>

                        @if ($product->is_active)

                            <span class="status-active">
                                Active
                            </span>

                        @else

                            <span class="status-inactive">
                                Inactive
                            </span>

                        @endif

                    </td>


                    {{-- Product Actions --}}
                    <td>

                        {{-- Edit --}}
                        <a
                            href="{{ route(
                                'admin.products.edit',
                                $product
                            ) }}"
                        >
                            Edit
                        </a>


                        {{-- Activate / Deactivate --}}
                        <form
                            method="POST"
                            action="{{ route(
                                'admin.products.toggleStatus',
                                $product
                            ) }}"
                            style="display: inline;"
                        >

                            @csrf

                            @method('PATCH')


                            <button type="submit">

                                {{ $product->is_active
                                    ? 'Deactivate'
                                    : 'Activate'
                                }}

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">

                        No products found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- Pagination --}}
    <div class="pagination">

        {{ $products->links() }}

    </div>

</div>

</body>
</html>