<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Discount Coupons</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        :root {
            /* High-Contrast Luxury Color Canvas */
            --bg-main: #03060b;              /* Absolute deep ink black */
            --panel-surface: #090d16;        /* High-contrast dark charcoal card well */
            
            /* Premium Metallic Accent Highlights */
            --gold-pure: #dfb73c;            /* Concentrated architectural luxury gold */
            --gold-hover: #f3e5ab;           /* Soft silk gold highlight */
            --border-stark: rgba(223, 183, 60, 0.25); /* Polished metallic framing lines */
            
            /* Text Systems */
            --text-light: #f4f6fa;           
            --text-muted: #a2b4d0;           
            --text-alert: #e06c75;           /* Refined luxury warning burgundy */
            --text-success: #34d399;         
            
            /* Structural Curves & Physics Springs */
            --luxury-radius: 8px;            
            --luxury-bounce: cubic-bezier(0.43, 1.45, 0.48, 1);
            --luxury-ease: cubic-bezier(0.25, 1, 0.33, 1);
        }

        /* Base Workspace Context Layout Realignment */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-light);
            margin: 0;
            padding: 60px 24px 160px 24px; /* Clearance for floating bottom docks */
            display: flex;
            justify-content: center;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        /* --- DASHBOARD WRAPPER CONTAINER --- */
        .container {
            max-width: 1200px;
            width: 100%;
            background-color: var(--panel-surface);
            border: 2px solid var(--border-stark);
            border-radius: var(--luxury-radius);
            padding: 40px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.6);
            box-sizing: border-box;
        }

        /* Elegant Editorial Title Header */
        .container h1 {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 0.05em;
            color: var(--text-light);
            text-transform: uppercase;
            margin: 0 0 36px 0;
            border-bottom: 2px solid var(--border-stark);
            padding-bottom: 18px;
        }

        /* --- SYSTEM SUCCESS FLASH TOAST STATES --- */
        .container p:first-of-type {
            background-color: rgba(52, 211, 153, 0.03);
            border: 1px solid var(--text-success);
            color: var(--text-success);
            border-radius: var(--luxury-radius);
            padding: 16px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 32px;
            margin-top: 0;
            letter-spacing: 0.02em;
            text-align: center;
        }

        /* --- THE BOUTIQUE SPECULAR GRID SHEET TABLE --- */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 16px;
            border: none !important; /* Overrides legacy inline properties attributes */
        }

        th {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold-pure);
            text-align: left;
            padding: 16px 20px;
            border-bottom: 2px solid var(--border-stark);
        }

        td {
            padding: 18px 20px;
            font-size: 0.95rem;
            color: var(--text-muted);
            border-bottom: 1px solid rgba(223, 183, 60, 0.08);
            vertical-align: middle;
        }

        tr:last-of-type td {
            border-bottom: none;
        }

        /* Coupon Code primary emphasis highlight tracking */
        td:first-of-type {
            font-family: 'Cinzel', Georgia, serif;
            color: var(--text-light);
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        /* --- ACTION TRIGGERS LINK BUTTON MODIFIERS --- */
        td a {
            text-decoration: none;
            display: inline-block;
        }

        td button {
            background-color: transparent;
            font-family: inherit;
            cursor: pointer;
            box-sizing: border-box;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 8px 16px;
            border-radius: var(--luxury-radius);
            transition: all 0.3s var(--luxury-ease);
            display: inline-block;
            vertical-align: middle;
        }

        /* Edit button item variant style maps */
        td a button {
            color: var(--text-light);
            border: 1px solid var(--border-stark);
            margin-right: 6px;
        }

        td a button:hover {
            color: var(--gold-hover);
            border-color: var(--gold-pure);
            background-color: rgba(223, 183, 60, 0.03);
            transform: translateY(-2px);
        }

        /* Delete action variant trigger forms style maps */
        td form button {
            color: var(--text-muted);
            border: 1px solid transparent;
        }

        td form button:hover {
            color: var(--text-alert);
            border-color: var(--text-alert);
            background-color: rgba(224, 108, 117, 0.03);
            transform: translateY(-2px);
        }

        td button:active {
            transform: scale(0.96) !important;
        }

        /* --- MOBILE SCREEN OVERHAUL LAYOUTS --- */
        @media (max-width: 992px) {
            body {
                padding: 24px 16px 120px 16px;
            }

            .container {
                padding: 24px;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 950px; /* Forces responsive structural scroll track boundaries smoothly */
            }
        }
    </style>
</head>
<body>
    
    <div class="container">

        <h1>Discount Coupons</h1>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Minimum Order</th>
                    <th>Usage Limit</th>
                    <th>Used</th>
                    <th>Expires</th>
                    <th>Active</th>
                    <th width="160">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($discountCodes as $discount)

                <tr>

                    <td>{{ $discount->code }}</td>

                    <td>{{ ucfirst($discount->type) }}</td>

                    <td>
                        @if($discount->type === 'percentage')
                            {{ $discount->value }}%
                        @else
                            ₹{{ number_format($discount->value, 2) }}
                        @endif
                    </td>

                    <td>
                        ₹{{ number_format($discount->minimum_order, 2) }}
                    </td>

                    <td>{{ $discount->usage_limit }}</td>

                    <td>{{ $discount->used_count }}</td>

                    <td>
    {{ $discount->expires_at
        ? \Carbon\Carbon::parse($discount->expires_at)->format('d M Y')
        : 'Never'
    }}                </td>

                    <td>
                        {{ $discount->is_active ? 'Yes' : 'No' }}
                    </td>

                    <td>

                        <a href="{{ route('admin.discount.edit', $discount) }}">
                            <button type="button">
                                Edit
                            </button>
                        </a>

                        <form
                            action="{{ route('admin.discount.destroy', $discount) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this discount coupon?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" style="text-align:center;">
                        No discount coupons found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</body>
</html>clear
