<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Discount Coupon</title>
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
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        /* --- THE MASTER ADMIN FORM BOX SHELL --- */
        form {
            max-width: 650px;
            width: 100%;
            background-color: var(--panel-surface);
            border: 2px solid var(--border-stark);
            border-radius: var(--luxury-radius);
            padding: 48px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.6);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        /* Injecting a premium header look inside the console frame */
        form::before {
            content: "Create Coupon Code";
            font-family: 'Cinzel', Georgia, serif;
            font-size: 1.75rem;
            font-weight: 400;
            letter-spacing: 0.05em;
            color: var(--text-light);
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 36px;
            border-bottom: 2px solid var(--border-stark);
            padding-bottom: 18px;
            display: block;
        }

        /* --- STARK METALLIC TYPOGRAPHY LABELS --- */
        form label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--gold-pure);
            margin-bottom: 8px;
            margin-top: 20px;
        }

        /* Isolates native inline label-wrapping formats like checkboxes */
        form label:has(input[type="checkbox"]) {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--text-light);
            user-select: none;
            text-transform: none;
            letter-spacing: 0px;
            margin-top: 24px;
            margin-bottom: 12px;
            width: fit-content;
        }

        /* --- HIGH-CONTRAST DATA CAPTURE COMPONENT TRACKS --- */
        form input[type="text"],
        form input[type="number"],
        form input[type="datetime-local"],
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

        /* Select wrapper dropdown arrows custom adjustments */
        form select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%23dfb73c' stroke-width='2' viewBox='0 0 24 24'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 14px;
            padding-right: 48px;
        }

        /* Form Interactive States */
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

        /* Custom alignment for calendar elements placeholder text */
        form input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(80%) sepia(50%) saturate(400%) hue-rotate(5deg);
            cursor: pointer;
        }

        /* Core System Checkbox Formats */
        form input[type="checkbox"] {
            accent-color: var(--gold-pure);
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin: 0;
        }

        /* --- THE BOUNCY TRANSACTION ACTION KEY --- */
        form button {
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
            margin-top: 24px;
            box-shadow: 0 10px 30px rgba(223, 183, 60, 0.15);
            transition: color 0.25s ease, border-color 0.3s ease, transform 0.4s var(--luxury-bounce), box-shadow 0.4s var(--luxury-ease);
        }

        form button:hover {
            background-color: transparent;
            color: var(--gold-hover);
            border-color: var(--gold-hover);
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 14px 35px rgba(223, 183, 60, 0.05);
        }

        form button:active {
            transform: translateY(-1px) scale(0.98);
            transition: transform 0.1s ease;
        }

        /* --- SYSTEM TOAST SUCCESS FEEDBACK METRICS --- */
        .success-message {
            max-width: 650px;
            width: 100%;
            background-color: rgba(52, 211, 153, 0.03);
            border: 2px solid var(--text-success);
            color: var(--text-success);
            border-radius: var(--luxury-radius);
            padding: 16px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 24px;
            box-sizing: border-box;
            letter-spacing: 0.02em;
            text-align: center;
            animation: fadeInNotification 0.3s var(--luxury-ease);
        }

        @keyframes fadeInNotification {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* --- COMPACT TERMINAL ADAPTERS --- */
        @media (max-width: 768px) {
            body {
                padding: 32px 16px 120px 16px;
            }
            form {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>

@if(session('success'))

    <div class="success-message">
        {{ session('success') }}
    </div>

@endif


<form action="{{ route('admin.discountCodes.store') }}" method="POST">

    @csrf

    <label>Coupon Code</label>

    <input
        type="text"
        name="code"
        value="{{ old('code') }}"
    >

    <label>Discount Type</label>

    <select name="type">
        <option value="percentage">Percentage</option>
        <option value="fixed">Fixed Amount</option>
    </select>

    <label>Value</label>

    <input
        type="number"
        step="0.01"
        name="value"
    >

    <label>Minimum Order</label>

    <input
        type="number"
        step="0.01"
        name="minimum_order"
        value="0"
    >

    <label>Usage Limit</label>

    <input
        type="number"
        name="usage_limit"
    >

    <label>Expiry</label>

    <input
        type="datetime-local"
        name="expires_at"
    >

    <label>

        <input
            type="checkbox"
            name="is_active"
            value="1"
            checked
        >

        Active

    </label>

    <button>
        Create Coupon
    </button>

</form>

@if(session('success'))

<div
    id="successMessage"
    class="success-message"
>
    {{ session('success') }}
</div>

<script>
setTimeout(() => {
    document.getElementById("successMessage")?.remove();
}, 3000);
</script>

@endif

</body>
</html>