<style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

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
    padding: 0 0 160px 0; /* Clear room for floating navigation docks */
    -webkit-font-smoothing: antialiased;
}

/* --- THE MAIN DASHBOARD PANEL CORE CONTAINER --- */
.admin-dashboard {
    max-width: 900px;
    width: 100%;
    margin: 64px auto;
    padding: 0 32px;
    box-sizing: border-box;
}

/* Elegant Editorial Main Panel Header */
.admin-dashboard h1 {
    font-family: 'Cinzel', Georgia, serif;
    font-size: 2.2rem;
    font-weight: 400;
    letter-spacing: 0.04em;
    color: var(--text-light);
    text-transform: uppercase;
    margin: 0 0 48px 0;
    border-bottom: 1px solid var(--border-subtle);
    padding-bottom: 24px;
    text-align: center;
}

/* --- ACTION TRIGGERS STACK MATRIX --- */
.admin-dashboard-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
    width: 100%;
}

/* Premium Navigation Card Anchors */
.admin-dashboard-actions a {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--panel-surface);
    border: 1px solid var(--border-subtle);
    border-radius: var(--luxury-radius);
    padding: 40px 24px;
    
    font-family: 'Cinzel', Georgia, serif;
    font-size: 1.15rem;
    font-weight: 400;
    color: var(--text-light);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    text-decoration: none;
    text-align: center;
    
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
    box-sizing: border-box;
    transition: color 0.25s ease, border-color 0.3s ease, transform 0.4s var(--luxury-bounce), box-shadow 0.4s var(--luxury-ease);
}

/* --- KINETIC BOUNCY FLOATING & SPECULAR HIGHLIGHT EFFECTS --- */
.admin-dashboard-actions a:hover {
    color: var(--gold-hover);
    border-color: var(--gold-accent);
    
    /* Smooth elastic upward expansion pop track */
    transform: translateY(-8px) scale(1.03);
    
    /* Immersive ambient environmental glow casing depth shadow maps */
    box-shadow: 
        0 20px 45px rgba(0, 0, 0, 0.4),
        0 6px 20px rgba(212, 175, 55, 0.08);
}

/* Interactive click feedback structural compression */
.admin-dashboard-actions a:active {
    transform: translateY(-2px) scale(0.97);
    transition: transform 0.1s ease;
}

/* --- RESPONSIVE MOBILE CONVERSIONS --- */
@media (max-width: 680px) {
    .admin-dashboard {
        padding: 0 20px;
        margin: 36px auto;
    }

    .admin-dashboard h1 {
        font-size: 1.65rem;
        margin-bottom: 36px;
    }

    .admin-dashboard-actions {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .admin-dashboard-actions a {
        padding: 32px 20px;
        font-size: 1.05rem;
    }
}
</style>
<div class="admin-dashboard">

    <h1>Admin Dashboard</h1>

    <div class="admin-dashboard-actions">

        <a href="{{ route('admin.products.index') }}">
            Manage Products
        </a>

        <a href="{{ route('admin.products.create') }}">
            Add New Product
        </a>

    </div>

</div>



