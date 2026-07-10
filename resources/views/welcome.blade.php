<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel Store') }}</title>

        @fonts

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */ 
                @layer properties{@supports (((-webkit-hyphens:none)) and (not (margin-trim:inline))) or ((-moz-orient:inline) and (not (color:rgb(from red r g b)))){*,:before,:after,::backdrop{--tw-translate-x:0;--tw-translate-y:0;--tw-translate-z:0;--tw-rotate-x:initial;--tw-rotate-y:initial;--tw-rotate-z:initial;--tw-skew-x:initial;--tw-skew-y:initial;--tw-space-x-reverse:0;--tw-border-style:solid;--tw-leading:initial;--tw-font-weight:initial;--tw-tracking:initial;--tw-shadow:0 0 #0000;--tw-shadow-color:initial;--tw-shadow-alpha:100%;--tw-inset-shadow:0 0 #0000;--tw-inset-shadow-color:initial;--tw-inset-shadow-alpha:100%;--tw-ring-color:initial;--tw-ring-shadow:0 0 #0000;--tw-inset-ring-color:initial;--tw-inset-ring-shadow:0 0 #0000;--tw-ring-inset:initial;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-offset-shadow:0 0 #0000;--tw-blur:initial;--tw-brightness:initial;--tw-contrast:initial;--tw-grayscale:initial;--tw-hue-rotate:initial;--tw-invert:initial;--tw-opacity:initial;--tw-saturate:initial;--tw-sepia:initial;--tw-drop-shadow:initial;--tw-drop-shadow-color:initial;--tw-drop-shadow-alpha:100%;--tw-drop-shadow-size:initial;--tw-duration:initial;--tw-ease:initial;--tw-content:""}}}@layer theme{:root,:host{--font-sans:"Instrument Sans", ui-sans-serif, system-ui, sans-serif;--color-gray-50:oklch(98.5% .002 247.839);--color-gray-100:oklch(96.7% .003 264.542);--color-gray-200:oklch(92.8% .006 264.531);--color-gray-300:oklch(87.2% .01 258.338);--color-gray-700:oklch(37.3% .034 259.733);--color-gray-900:oklch(21% .034 264.665);--color-black:#000;--color-white:#fff;--spacing:.25rem;--radius-md:.375rem;--radius-sm:.25rem}}
            </style>
        @endif
        
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
            
            .luxury-serif { font-family: 'Cinzel', Georgia, serif; }
            .luxury-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
            
            :root {
                --gold-pure: #dfb73c;
                --gold-glow: rgba(223, 183, 60, 0.35);
                --ink-black: #03060b;
                --surface-card: #090d16;
                --border-stark: rgba(223, 183, 60, 0.25);
                --luxury-bounce: cubic-bezier(0.25, 1, 0.33, 1);
            }
        </style>
    </head>
    <body class="bg-[#03060b] text-[#f4f6fa] luxury-sans antialiased min-h-screen flex flex-col selection:bg-[#dfb73c] selection:text-black">
        
        <!-- High-Contrast Framed Top Navigation Header Section -->
        <header class="w-full border-b-2 border-[#dfb73c] bg-[#090d16] sticky top-0 z-50 transition-all shadow-[0_10px_30px_rgba(0,0,0,0.8)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-24 flex items-center justify-center relative">
                
                <!-- Expanded Tracking Bold Statement Identity Logo -->
                <a href="{{ url('/') }}" class="text-3xl font-bold tracking-[0.35em] uppercase text-white luxury-serif transition duration-300 hover:text-[#dfb73c] select-none hover:drop-shadow-[0_0_15px_rgba(223,183,60,0.4)]">
                    <span>ShopSwift</span>
                </a>

                <!-- Preservation Node Track Parameters -->
                <div class="hidden">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-20 transition-opacity opacity-100 duration-750">
            
            <!-- High-Contrast Profile Banner Showcase -->
            <section class="mb-28 p-10 lg:p-20 bg-[#090d16] rounded-xl relative overflow-hidden shadow-[0_30px_70px_rgba(0,0,0,0.6)] border-2 border-[rgba(223,183,60,0.2)] flex flex-col lg:flex-row items-center justify-between gap-16">
                
                <div class="max-w-xl space-y-8 z-10 text-center lg:text-left">
                    <span class="text-xs font-bold tracking-[0.3em] uppercase text-[#dfb73c] block bg-[rgba(223,183,60,0.08)] border border-[rgba(223,183,60,0.3)] w-fit px-4 py-1.5 rounded-full mx-auto lg:mx-0">
                        Bespoke Design House
                    </span>
                    <h2 class="text-4xl lg:text-6xl font-normal text-white luxury-serif leading-tight tracking-wide">
                        Curated Living <br><span class="text-[#dfb73c] font-medium">For The Minimalist</span>
                    </h2>
                    <p class="text-base text-[#a2b4d0] leading-relaxed font-light">
                        Founded on the principles of timeless geometry and high-end tactile quality, ShopSwift delivers premium utilities, everyday architectural carry gear, and fine technical diagnostics carefully constructed for exclusive lifestyles.
                    </p>
                </div>
                
                <!-- Blank Canvas Spatial Contrast Box Layout Profiles for Portrait Artwork Elements -->
                <div class="grid grid-cols-2 gap-6 w-full lg:w-[45%] aspect-[4/3] pointer-events-none">
                    <div class="bg-[#03060b] border-2 border-[rgba(223,183,60,0.15)] rounded-lg flex items-center justify-center shadow-inner transition duration-500 hover:border-[#dfb73c]">
                        <!-- Custom Image Spot 1 -->
                    </div>
                    <div class="bg-[#03060b] border-2 border-[rgba(223,183,60,0.15)] rounded-lg flex items-center justify-center shadow-inner mt-12 transition duration-500 hover:border-[#dfb73c]">
                        <!-- Custom Image Spot 2 -->
                    </div>
                </div>
            </section>

            <!-- Rigid Dynamic Layout Section Break Frame -->
            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-16 pb-8 border-b-2 border-[rgba(223,183,60,0.25)] gap-6">
                <div>
                    <h3 class="text-3xl font-normal text-white luxury-serif tracking-widest uppercase">Campaign Lookbook</h3>
                    <p class="text-sm text-[#a2b4d0] mt-2 font-light">Visual expressions and editorial style narratives</p>
                </div>
                
                <!-- Crisp Pure Metallic Gold Router Link Call-to-Action -->
                <a href="{{ url('/list') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-[#dfb73c] text-black font-bold text-xs uppercase tracking-[0.2em] rounded-md transition-all duration-300 transform hover:-translate-y-1 hover:bg-white hover:shadow-[0_10px_30px_rgba(223,183,60,0.3)] active:translate-y-0">
                    <span>Explore Products</span>
                    <svg class="w-4 h-4 stroke-black" fill="none" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Asymmetrical High-Contrast Fine Model Portrait Portfolio Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                
                @foreach([
                    ['title' => 'Editorial Session I', 'tag' => 'Autumn Collection'],
                    ['title' => 'Editorial Session II', 'tag' => 'Minimalism Noir'],
                    ['title' => 'Editorial Session III', 'tag' => 'Symmetry & Line'],
                    ['title' => 'Editorial Session IV', 'tag' => 'High Silhouette']
                ] as $product)
                <div class="group flex flex-col bg-[#090d16] rounded-xl overflow-hidden border-2 border-[rgba(223,183,60,0.12)] hover:border-[#dfb73c] shadow-[0_15px_40px_rgba(0,0,0,0.4)] hover:shadow-[0_25px_60px_rgba(223,183,60,0.15)] transition-all duration-500 transform hover:-translate-y-2">
                    
                    <!-- High-Contrast Deep Ink Well Container Built Expressly to Housing Model Artwork Portraits -->
                    <div class="bg-[#03060b] aspect-[3/4] relative flex items-center justify-center p-6 border-b border-[rgba(223,183,60,0.12)] overflow-hidden">
                        <span class="absolute top-5 left-5 bg-black text-[#dfb73c] border-2 border-[#dfb73c] text-[10px] font-bold px-3 py-1 rounded-sm uppercase tracking-widest z-10 shadow-lg">
                            {{ $product['tag'] }}
                        </span>
                        
                        <!-- Leave Image Space Empty for User Model Portfolio Imagery -->
                    </div>

                    <!-- Clean High Contrast Typographic Caption Block Frame Component -->
                    <div class="p-6 flex flex-col gap-2 bg-[#090d16] z-10 transition duration-300 group-hover:bg-[#0d1422]">
                        <h4 class="font-medium text-base text-white luxury-serif tracking-wide group-hover:text-[#dfb73c] transition duration-300">
                            {{ $product['title'] }}
                        </h4>
                        <span class="text-[#a2b4d0] text-xs font-light tracking-wider">
                            Campaign Profile Gallery
                        </span>
                    </div>
                </div>
                @endforeach

            </div>
        </main>

        <!-- Strong Border Terminal Statement Layout Footer Section Component -->
        <footer class="w-full border-t-2 border-[rgba(223,183,60,0.25)] py-10 text-center text-xs text-[#a2b4d0] mt-32 bg-[#090d16]">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="font-light tracking-wide">&copy; 2026 ShopSwift Marketplace. All rights reserved.</p>
                <p class="flex items-center gap-2 font-light tracking-wide">
                    <span>Engineered with Laravel v{{ app()->version() }}</span>
                    <span class="text-[#dfb73c]">|</span>
                    <a href="https://github.com/laravel/framework" target="_blank" class="underline hover:text-white transition">Framework</a>
                </p>
            </div>
        </footer>
    </body>
</html>