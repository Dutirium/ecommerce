
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Discount Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        :root {
            /* High-Contrast Luxury Color Canvas */
            --bg-main: #03060b;              /* Absolute deep ink black */
            --panel-surface: #090d16;        /* High-contrast dark charcoal card well */
            --input-bg: #121824;             /* Embedded input track gray */
            
            /* Premium Metallic Accent Highlights */
            --gold-pure: #dfb73c;            /* Concentrated architectural luxury gold */
            --gold-hover: #f3e5ab;           /* Soft silk gold highlight */
            --border-stark: rgba(223, 183, 60, 0.25); /* Polished metallic framing lines */
            
            /* Text Systems */
            --text-light: #f4f6fa;           
            --text-muted: #a2b4d0;           
            --text-alert: #e06c75;           /* Refined luxury warning burgundy */
            
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
            padding: 60px 24px 160px 24px; /* Clearance for floating bottom navigation components */
            display: flex;
            justify-content: center;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        /* --- THE MASTER ADMIN FORM BOX SHELL --- */
        .container {
            max-width: 700px;
            width: 100%;
            background-color: var(--panel-surface);
            border: 2px solid var(--border-stark);
            border-radius: var(--luxury-radius);
            padding: 48px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.6);
            box-sizing: border-box;
        }

        /* Elegant Editorial Title Header */
        .container h1 {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 1.85rem;
            font-weight: 400;
            letter-spacing: 0.05em;
            color: var(--text-light);
            text-transform: uppercase;
            text-align: center;
            margin: 0 0 36px 0;
            border-bottom: 2px solid var(--border-stark);
            padding-bottom: 18px;
        }

        /* --- VALIDATION WARNING CONSOLES --- */
        .container div:has(ul) {
            background-color: rgba(224, 108, 117, 0.03);
            border: 1px solid var(--text-alert);
            border-radius: var(--luxury-radius);
            padding: 20px;
            margin-bottom: 32px;
        }

        .container ul {
            margin: 0;
            padding-left: 20px;
            color: var(--text-alert);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* --- FORM LAYOUT FIELDS MATRIX TRACK --- */
        form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        form > div {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Stark Metallic Typography Labels */
        form label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--gold-pure);
        }

        /* High-Contrast Input Capture Components */
        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form select {
            width: 100%;
            padding: 14px 18px;
            background-color: var(--input-bg);
            border: 1px solid transparent;
            border-radius: var(--luxury-radius);
            color: var(--text-light);
            font-size: 0.95rem;
            font-family: inherit;
            box-sizing: border-box;
            outline: none;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
            transition: all 0.3s var(--luxury-ease);
        }

        /* Custom Dropdown Arrow Configuration rules for luxury selectivity view templates */
        form select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23dfb73c' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 14px;
            padding-right: 48px;
        }

        /* Interactive Focus Filters */
        form input:hover,
        form select:hover {
            background-color: rgba(18, 24, 36, 0.8);
        }

        form input:focus,
        form select:focus {
            background-color: var(--bg-main);
            border-color: var(--gold-pure);
            box-shadow: 0 0 0 1px var(--gold-pure), inset 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        /* Custom alignment for calendar picker objects elements */
        form input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(80%) sepia(50%) saturate(400%) hue-rotate(5deg);
            cursor: pointer;
        }

        /* Clean formatting logic overrides for standard linebreaks */
        form br {
            display: none;
        }

        /* --- TACTICAL TERMINAL ACTION CONSOLE WRAPPERS --- */
        /* Grouping the bottom two action children into a horizontal alignment well */
        form > button[type="submit"] + a {
            margin-top: 8px;
        }

        /* Bouncy Primary Confirmation Key Trigger button */
        form button[type="submit"] {
            width: 100%;
            padding: 18px 24px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            border-radius: var(--luxury-radius);
            cursor: pointer;
            font-family: inherit;
            box-sizing: border-box;
            background-color: var(--gold-pure);
            color: #000;
            border: 2px solid var(--gold-pure);
            box-shadow: 0 10px 30px rgba(223, 183, 60, 0.15);
            transition: color 0.25s ease, border-color 0.3s ease, transform 0.4s var(--luxury-bounce), box-shadow 0.4s var(--luxury-ease);
        }

        form button[type="submit"]:hover {
            background-color: transparent;
            color: var(--gold-hover);
            border-color: var(--gold-hover);
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 14px 35px rgba(223, 183, 60, 0.05);
        }

        /* Elegant Muted Cancel Routing Link button */
        form a {
            display: block;
            width: 100%;
            padding: 18px 24px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: var(--luxury-radius);
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            box-sizing: border-box;
            background-color: transparent;
            color: var(--text-muted);
            border: 2px solid var(--border-stark);
            transition: all 0.3s var(--luxury-ease);
        }

        form a:hover {
            color: var(--text-light);
            border-color: rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.01);
            transform: translateY(-2px);
        }

        form button[type="submit"]:active,
        form a:active {
            transform: translateY(-1px) scale(0.98);
            transition: transform 0.1s ease;
        }

        /* --- COMPACT PORTRAIT SCREEN CONVERSIONS --- */
        @media (max-width: 768px) {
            body {
                padding: 32px 16px 120px 16px;
            }
            .container {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Edit Discount Code</h1>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.discount.update', $discountCode) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div>
                <label for="code">Discount Code</label>

                <input
                    type="text"
                    id="code"
                    name="code"
                    value="{{ old('code', $discountCode->code) }}"
                    required
                >
            </div>

            <div>
                <label for="type">Discount Type</label>

                <select
                    name="type"
                    id="type"
                    required
                >
                    <option
                        value="percentage"
                        @selected(old('type', $discountCode->type) == 'percentage')
                    >
                        Percentage
                    </option>

                    <option
                        value="fixed"
                        @selected(old('type', $discountCode->type) == 'fixed')
                    >
                        Fixed Amount
                    </option>
                </select>
            </div>

            <div>
                <label for="value">Value</label>

                <input
                    type="number"
                    name="value"
                    id="value"
                    step="0.01"
                    value="{{ old('value', $discountCode->value) }}"
                    required
                >
            </div>

            <div>
                <label for="minimum_order">Minimum Order</label>

                <input
                    type="number"
                    name="minimum_order"
                    id="minimum_order"
                    step="0.01"
                    value="{{ old('minimum_order', $discountCode->minimum_order) }}"
                >
            </div>

            <div>
                <label for="usage_limit">Usage Limit</label>

                <input
                    type="number"
                    name="usage_limit"
                    id="usage_limit"
                    value="{{ old('usage_limit', $discountCode->usage_limit) }}"
                >
            </div>

            <div>
                <label for="used_count">Used Count</label>

                <input
                    type="number"
                    name="used_count"
                    id="used_count"
                    value="{{ old('used_count', $discountCode->used_count) }}"
                >
            </div>

            <div>
                <label for="starts_at">Starts At</label>

                <input
                    type="date"
                    name="starts_at"
                    id="starts_at"
                    value="{{ old('starts_at', optional($discountCode->starts_at)->format('Y-m-d')) }}"
                >
            </div>

            <div>
                <label for="expires_at">Expires At</label>

                <input
                    type="date"
                    name="expires_at"
                    id="expires_at"
                    value="{{ old('expires_at', optional($discountCode->expires_at)->format('Y-m-d')) }}"
                >
            </div>

            <div>
                <label for="is_active">Status</label>

                <select
                    name="is_active"
                    id="is_active"
                    required
                >
                    <option
                        value="1"
                        @selected(old('is_active', $discountCode->is_active))
                    >
                        Active
                    </option>

                    <option
                        value="0"
                        @selected(!old('is_active', $discountCode->is_active))
                    >
                        Inactive
                    </option>
                </select>
            </div>

            <br>

            <button type="submit">
                Update Discount Code
            </button>

            <a href="{{ route('admin.discountCodes.index') }}">
                Cancel
            </a>

        </form>

    </div>

</body>
</html>

```