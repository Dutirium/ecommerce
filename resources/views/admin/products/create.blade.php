<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        :root {
            /* Deep Luxury Color Canvas */
            --bg-main: #0a0e17;              /* Deep, imperial midnight navy */
            --panel-surface: #121824;        /* Rich charcoal-navy compound card surface */
            --input-bg: #182030;             /* Subtle embedded input depth */
            
            /* Elegant Accenting System */
            --gold-accent: #d4af37;          /* Muted, premium metallic champagne gold */
            --gold-hover: #f3e5ab;           /* Soft silk gold light flare */
            --border-subtle: rgba(212, 175, 55, 0.12); /* Delicate golden thread boundaries */
            
            /* Polished Typography Tones */
            --text-light: #f4f6fa;           /* Off-white porcelain text color */
            --text-muted: #8fa0bc;           /* Soft slate-gray secondary description */
            --text-alert: #e06c75;           /* Refined, muted burgundy warning */
            
            /* Structural Curves & Sophisticated Springs */
            --luxury-radius: 8px;            
            --luxury-bounce: cubic-bezier(0.43, 1.45, 0.48, 1);
            --luxury-ease: cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* Master Space Reset & Workspace Base Layout Alignment */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-light);
            margin: 0;
            padding: 40px 24px 160px 24px; /* Clearance for bottom floating navigation docks */
            display: flex;
            justify-content: center;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        /* --- THE MAIN FORM PANEL CONTAINER --- */
        .admin-product-form {
            max-width: 750px;
            width: 100%;
            background-color: var(--panel-surface);
            border: 1px solid var(--border-subtle);
            border-radius: var(--luxury-radius);
            padding: 48px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            box-sizing: border-box;
        }

        /* Elegant Editorial Title Header */
        .admin-product-form h1 {
            font-family: 'Cinzel', Georgia, serif;
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 0.04em;
            color: var(--text-light);
            text-transform: uppercase;
            margin: 0 0 40px 0;
            border-bottom: 1px solid var(--border-subtle);
            padding-bottom: 18px;
            text-align: center;
        }

        /* --- VALIDATION WARNING CONSOLES --- */
        .validation-errors {
            background-color: rgba(224, 108, 117, 0.03);
            border: 1px solid var(--text-alert);
            border-radius: var(--luxury-radius);
            padding: 20px;
            margin-bottom: 32px;
        }

        .validation-errors ul {
            margin: 0;
            padding-left: 20px;
            color: var(--text-alert);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* --- FORM DATA TRACKS & STRUCTURES --- */
        .admin-product-form form {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .admin-product-form form > div {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .admin-product-form label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
        }

        /* Premium Form Input Components */
        .admin-product-form input[type="text"],
        .admin-product-form input[type="number"],
        .admin-product-form textarea {
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
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15);
            transition: all 0.3s var(--luxury-ease);
        }

        .admin-product-form textarea {
            resize: vertical;
            line-height: 1.5;
        }

        .admin-product-form input:hover,
        .admin-product-form textarea:hover {
            background-color: rgba(24, 32, 48, 0.8);
        }

        /* Focus State Luxury Champagne Border Tracking */
        .admin-product-form input:focus,
        .admin-product-form textarea:focus {
            background-color: var(--bg-main);
            border-color: var(--gold-accent);
            box-shadow: 0 0 0 1px var(--gold-accent), inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* File Upload Selector */
        .admin-product-form input[type="file"] {
            color: var(--text-muted);
            font-size: 0.85rem;
            padding: 12px 0;
        }

        .admin-product-form input[type="file"]::file-selector-button {
            background-color: var(--input-bg);
            color: var(--text-light);
            border: 1px solid var(--border-subtle);
            padding: 8px 16px;
            border-radius: var(--luxury-radius);
            cursor: pointer;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-right: 12px;
            transition: all 0.25s ease;
        }

        .admin-product-form input[type="file"]::file-selector-button:hover {
            border-color: var(--gold-accent);
            color: var(--gold-hover);
        }

        /* --- SQUIRCLE TOGGLE CHECKBOX ROW --- */
        .admin-product-form form div:has(input[type="checkbox"]) label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            font-size: 0.85rem;
            color: var(--text-light);
            user-select: none;
            text-transform: none;
            letter-spacing: 0px;
        }

        .admin-product-form input[type="checkbox"] {
            accent-color: var(--gold-accent);
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin: 0;
        }

        /* --- ACTION TRIGGER ROW MECHANICS --- */
        .admin-product-form form > div:last-of-type {
            flex-direction: row;
            gap: 16px;
            margin-top: 16px;
        }

        /* Form Submission CTA Button Key */
        .admin-product-form button[type="submit"] {
            flex: 1;
            padding: 18px 24px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            border-radius: var(--luxury-radius);
            cursor: pointer;
            font-family: inherit;
            box-sizing: border-box;
            background-color: var(--gold-accent);
            color: #050505;
            border: 1px solid var(--gold-accent);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.15);
            transition: color 0.25s ease, border-color 0.3s ease, transform 0.4s var(--luxury-bounce), box-shadow 0.4s var(--luxury-ease);
        }

        .admin-product-form button[type="submit"]:hover {
            background-color: transparent;
            color: var(--gold-hover);
            border-color: var(--gold-hover);
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 14px 30px rgba(212, 175, 55, 0.05);
        }

        /* Elegant Muted Cancel Routing Key */
        .admin-product-form form > div:last-of-type a {
            padding: 18px 24px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: var(--luxury-radius);
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            box-sizing: border-box;
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-subtle);
            transition: all 0.3s var(--luxury-ease);
        }

        .admin-product-form form > div:last-of-type a:hover {
            color: var(--text-light);
            border-color: rgba(255, 255, 255, 0.15);
            background-color: rgba(255, 255, 255, 0.01);
            transform: translateY(-2px);
        }

        .admin-product-form button[type="submit"]:active,
        .admin-product-form form > div:last-of-type a:active {
            transform: translateY(-1px) scale(0.98);
            transition: transform 0.1s ease;
        }

        /* --- PRESERVED RESPONSIVE CONTROLS --- */
        @media (max-width: 768px) {
            body {
                padding: 24px 16px 120px 16px;
            }
            .admin-product-form {
                padding: 32px 20px;
            }
            .admin-product-form h1 {
                font-size: 1.6rem;
                margin-bottom: 28px;
            }
            .admin-product-form form > div:last-of-type {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

<div class="admin-product-form">

    <h1>Add New Product</h1>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="validation-errors">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('admin.products.store') }}"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- Product Name --}}
        <div>

            <label for="name">
                Product Name
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >

        </div>


        {{-- Description --}}
        <div>

            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                rows="6"
                required
            >{{ old('description') }}</textarea>

        </div>


        {{-- Price --}}
        <div>

            <label for="price">
                Price
            </label>

            <input
                id="price"
                type="number"
                name="price"
                step="0.01"
                min="0"
                value="{{ old('price') }}"
                required
            >

        </div>


        {{-- Stock --}}
        <div>

            <label for="stock">
                Stock
            </label>

            <input
                id="stock"
                type="number"
                name="stock"
                min="0"
                value="{{ old('stock', 0) }}"
                required
            >

        </div>


        {{-- Product Image --}}
        <div>

            <label for="image">
                Product Image
            </label>

            <input
                id="image"
                type="file"
                name="images[]"
                accept="image/*"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
                required
            >

        </div>


        {{-- Active Status --}}
        <div>

            <label>

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', true)
                        ? 'checked'
                        : ''
                    }}
                >

                Active

            </label>

        </div>


        {{-- Actions --}}
        <div>

            <button type="submit">
                Create Product
            </button>


            <a href="{{ route('admin.products.index') }}">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>