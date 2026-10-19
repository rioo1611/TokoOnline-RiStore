<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MYKONOS | Official Haute Parfumerie & Extrait de Parfum')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            gold: '#D4AF37',
                            goldDark: '#AA820A',
                            goldLight: '#F5E7B2',
                            dark: '#111111',
                            charcoal: '#1A1A1A',
                            sand: '#F7F5F0',
                            cardBg: '#FAFAF8',
                            accentRed: '#C92A2A',
                            rose: '#E8A598',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                        cinzel: ['"Cinzel"', 'serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 30s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .luxury-gradient {
            background: linear-gradient(135deg, #1A1A1A 0%, #2A2521 50%, #111111 100%);
        }
        .gold-border-glow:hover {
            box-shadow: 0 10px 30px -10px rgba(212, 175, 55, 0.3);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FAF9F6] text-neutral-800 font-sans antialiased selection:bg-neutral-900 selection:text-white"
      x-data="globalStore()"
      x-init="initCart()">

    <!-- 1. TOP MARQUEE ANNOUNCEMENT BAR (From Screenshot 1) -->
    <div class="bg-black text-white text-[11px] font-semibold tracking-[0.25em] py-2 overflow-hidden border-b border-neutral-800">
        <div class="marquee-track flex space-x-12 uppercase">
            <span>✨ FREE VIALS FOR EVERY PURCHASE</span>
            <span>•</span>
            <span>GRATIS ONGKIR SE-INDONESIA MIN. BELANJA RP 500.000</span>
            <span>•</span>
            <span>EXTRAIT DE PARFUM TAHAN 14+ JAM</span>
            <span>•</span>
            <span>100% ORIGINAL OFFICIAL STORE MYKONOS</span>
            <span>•</span>
            <span>GARANSI PENGIRIMAN AMAN 100%</span>
            <span>•</span>
            <!-- Duplicate for seamless loop -->
            <span>✨ FREE VIALS FOR EVERY PURCHASE</span>
            <span>•</span>
            <span>GRATIS ONGKIR SE-INDONESIA MIN. BELANJA RP 500.000</span>
            <span>•</span>
            <span>EXTRAIT DE PARFUM TAHAN 14+ JAM</span>
            <span>•</span>
            <span>100% ORIGINAL OFFICIAL STORE MYKONOS</span>
            <span>•</span>
            <span>GARANSI PENGIRIMAN AMAN 100%</span>
        </div>
    </div>

    <!-- 2. MAIN NAVIGATION BAR -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-neutral-200/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Left: Mobile Menu Toggle -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-neutral-700 hover:text-black focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Brand Logo (MYKONOS) -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="group flex items-center space-x-2">
                        <span class="font-cinzel text-2xl sm:text-3xl font-black tracking-[0.28em] text-neutral-900 group-hover:text-brand-goldDark transition-colors">
                            MYKONOS
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation Links (From Screenshot 1: HOME, PRODUCTS, CONTACT, CATALOGUE) -->
                <nav class="hidden lg:flex items-center space-x-10">
                    <a href="{{ route('home') }}" 
                       class="text-xs uppercase tracking-[0.2em] font-semibold text-neutral-800 hover:text-brand-goldDark transition-colors {{ request()->routeIs('home') ? 'border-b-2 border-black pb-1' : '' }}">
                        RUMAH
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="text-xs uppercase tracking-[0.2em] font-semibold text-neutral-800 hover:text-brand-goldDark transition-colors {{ request()->routeIs('products.*') ? 'border-b-2 border-black pb-1' : '' }}">
                        PRODUK
                    </a>
                    <a href="{{ route('products.index', ['category' => 'sunforged-collection']) }}" 
                       class="text-xs uppercase tracking-[0.2em] font-semibold text-neutral-800 hover:text-brand-goldDark transition-colors">
                        SUNFORGED
                    </a>
                    <a href="{{ route('about') }}" 
                       class="text-xs uppercase tracking-[0.2em] font-semibold text-neutral-800 hover:text-brand-goldDark transition-colors {{ request()->routeIs('about') ? 'border-b-2 border-black pb-1' : '' }}">
                        TENTANG KAMI
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="text-xs uppercase tracking-[0.2em] font-semibold text-neutral-800 hover:text-brand-goldDark transition-colors {{ request()->routeIs('contact') ? 'border-b-2 border-black pb-1' : '' }}">
                        KONTAK
                    </a>
                </nav>

                <!-- Right Action Icons: Search, User / Admin, Shopping Cart -->
                <div class="flex items-center space-x-5 sm:space-x-6">
                    <!-- Search Icon -->
                    <button @click="searchModalOpen = true" class="text-neutral-800 hover:text-black transition-colors p-1" title="Cari Parfum">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Admin / Dashboard Icon -->
                    <a href="{{ route('admin.dashboard') }}" class="text-neutral-800 hover:text-black transition-colors p-1 flex items-center space-x-1" title="Admin & Kelola Toko">
                        <span class="w-6 h-6 rounded-full bg-neutral-900 text-white text-[11px] font-bold flex items-center justify-center font-sans">
                            S
                        </span>
                    </a>

                    <!-- Cart Icon with Dynamic Badge Count -->
                    <button @click="cartDrawerOpen = true" class="relative text-neutral-900 hover:text-brand-goldDark transition-colors p-1" title="Keranjang Belanja">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span x-show="cartCount > 0" 
                              x-text="cartCount" 
                              x-cloak
                              class="absolute -top-1 -right-2 bg-neutral-900 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             @click.away="mobileMenuOpen = false" 
             class="lg:hidden border-t border-neutral-200 bg-white px-6 py-6 space-y-4 shadow-xl">
            <a href="{{ route('home') }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">RUMAH</a>
            <a href="{{ route('products.index') }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">PRODUK & KATALOG</a>
            <a href="{{ route('products.index', ['category' => 'sunforged-collection']) }}" class="block text-sm uppercase tracking-widest font-semibold text-brand-goldDark py-2 border-b border-neutral-100">SUNFORGED COLLECTION</a>
            <a href="{{ route('products.index', ['gender' => 'women']) }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">UNTUK WANITA</a>
            <a href="{{ route('products.index', ['gender' => 'men']) }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">UNTUK PRIA</a>
            <a href="{{ route('about') }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">TENTANG KAMI</a>
            <a href="{{ route('contact') }}" class="block text-sm uppercase tracking-widest font-semibold text-neutral-800 py-2 border-b border-neutral-100">KONTAK</a>
            <a href="{{ route('admin.dashboard') }}" class="block text-sm uppercase tracking-widest font-semibold text-blue-600 py-2">DASHBOARD ADMIN</a>
        </div>
    </header>

    <!-- Global Toast Alert (if Session message exists) -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             class="fixed bottom-6 right-6 z-50 bg-neutral-900 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center space-x-3 border border-neutral-700">
            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             class="fixed bottom-6 right-6 z-50 bg-red-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center space-x-3">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- 3. FOOTER -->
    <footer class="bg-black text-neutral-400 pt-16 pb-12 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-neutral-800">
                
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <h3 class="font-cinzel text-2xl font-bold tracking-[0.25em] text-white">MYKONOS</h3>
                    <p class="text-xs text-neutral-400 leading-relaxed font-light">
                        Official Haute Parfumerie & Extrait de Parfum Indonesia. Menghadirkan seni arsitektur wewangian berkelas dunia dengan konsentrasi minyak wangi tertinggi dan daya tahan luar biasa.
                    </p>
                    <div class="flex items-center space-x-4 pt-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded bg-neutral-900 border border-neutral-800 text-[11px] text-brand-gold">
                            ⭐ 4.9 / 5.0 Official Rating
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded bg-neutral-900 border border-neutral-800 text-[11px] text-neutral-300">
                            🌿 IFRA Certified
                        </span>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h4 class="text-xs uppercase tracking-[0.2em] font-semibold text-white mb-4">Navigasi Utama</h4>
                    <ul class="space-y-2.5 text-xs">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Semua Produk</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'sunforged-collection']) }}" class="hover:text-brand-gold transition-colors">Sunforged Collection</a></li>
                        <li><a href="{{ route('products.index', ['gender' => 'women']) }}" class="hover:text-white transition-colors">Parfum Wanita</a></li>
                        <li><a href="{{ route('products.index', ['gender' => 'men']) }}" class="hover:text-white transition-colors">Parfum Pria</a></li>
                    </ul>
                </div>

                <!-- Col 3: Customer Care -->
                <div>
                    <h4 class="text-xs uppercase tracking-[0.2em] font-semibold text-white mb-4">Bantuan & Layanan</h4>
                    <ul class="space-y-2.5 text-xs">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Mykonos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Hubungi Kami (WhatsApp CS)</a></li>
                        <li><span class="text-neutral-500">Kebijakan Garansi 100% Pecah</span></li>
                        <li><span class="text-neutral-500">Panduan Notes & Ketahanan Parfum</span></li>
                        <li><a href="{{ route('admin.dashboard') }}" class="text-amber-400 hover:underline">Kelola Toko (Admin Panel)</a></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter & Guarantee -->
                <div class="space-y-4">
                    <h4 class="text-xs uppercase tracking-[0.2em] font-semibold text-white">Dapatkan Info Rilis & Promo</h4>
                    <p class="text-xs text-neutral-400">Jadilah yang pertama tahu saat varian favorit restock atau koleksi terbatas diluncurkan.</p>
                    <form @submit.prevent="alert('Terima kasih telah bergabung dengan Komunitas Eksklusif Mykonos!')" class="flex">
                        <input type="email" placeholder="Email Anda..." required class="bg-neutral-900 border border-neutral-800 text-xs px-3.5 py-2.5 rounded-l-md w-full focus:outline-none focus:border-brand-gold text-white placeholder-neutral-500">
                        <button type="submit" class="bg-white text-black text-xs font-semibold px-4 rounded-r-md hover:bg-neutral-200 transition-colors">
                            DAFTAR
                        </button>
                    </form>
                    <p class="text-[10px] text-neutral-500">Setiap pembelian otomatis mendapatkan Free Vial Tester acak.</p>
                </div>
            </div>

            <!-- Bottom: Payment & Logistics -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-neutral-500 space-y-4 md:space-y-0">
                <p>© {{ date('Y') }} MYKONOS Official Store. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center space-x-3 text-[11px] text-neutral-400">
                    <span class="bg-neutral-900 border border-neutral-800 px-2 py-1 rounded">QRIS</span>
                    <span class="bg-neutral-900 border border-neutral-800 px-2 py-1 rounded">BCA</span>
                    <span class="bg-neutral-900 border border-neutral-800 px-2 py-1 rounded">MANDIRI</span>
                    <span class="bg-neutral-900 border border-neutral-800 px-2 py-1 rounded">SICEPAT</span>
                    <span class="bg-neutral-900 border border-neutral-800 px-2 py-1 rounded">JNE</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- 4. SLIDE-OUT CART DRAWER -->
    <div x-show="cartDrawerOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-hidden" 
         aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
             @click="cartDrawerOpen = false"
             x-show="cartDrawerOpen"
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
            <div class="w-screen max-w-md bg-white shadow-2xl flex flex-col"
                 x-show="cartDrawerOpen"
                 x-transition:enter="transform transition ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                
                <!-- Header -->
                <div class="p-6 border-b border-neutral-200 flex items-center justify-between bg-neutral-50">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-neutral-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h2 class="text-sm font-bold uppercase tracking-widest text-neutral-900">
                            Keranjang Belanja (<span x-text="cartCount"></span>)
                        </h2>
                    </div>
                    <button @click="cartDrawerOpen = false" class="text-neutral-500 hover:text-black p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Free Shipping Progress -->
                <div class="px-6 py-3 bg-amber-50/70 border-b border-amber-100 text-xs text-amber-900 flex items-center space-x-2">
                    <span>✨</span>
                    <span>Gratis 1 Botol Tester Vial Acak Setiap Checkout!</span>
                </div>

                <!-- Items List -->
                <div class="flex-1 overflow-y-auto p-6 space-y-4">
                    <template x-if="Object.keys(cartItems).length === 0">
                        <div class="text-center py-16">
                            <svg class="w-12 h-12 mx-auto text-neutral-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <p class="text-sm text-neutral-500 font-medium">Keranjang Anda masih kosong</p>
                            <p class="text-xs text-neutral-400 mt-1">Temukan wewangian signature Anda sekarang!</p>
                            <a href="{{ route('products.index') }}" @click="cartDrawerOpen = false" class="inline-block mt-4 text-xs font-bold uppercase tracking-wider bg-black text-white px-5 py-2.5 rounded hover:bg-neutral-800">
                                Mulai Belanja
                            </a>
                        </div>
                    </template>

                    <template x-for="(item, key) in cartItems" :key="key">
                        <div class="flex items-center space-x-4 pb-4 border-b border-neutral-100">
                            <img :src="'/' + item.image" :alt="item.name" class="w-16 h-16 object-contain bg-neutral-100 rounded p-1 border border-neutral-200">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold text-neutral-900 truncate" x-text="item.name"></h4>
                                <p class="text-[11px] text-neutral-500">Varian: <span class="font-semibold text-neutral-700" x-text="item.variant_size"></span></p>
                                <p class="text-xs font-semibold text-neutral-900 mt-1" x-text="formatRupiah(item.price)"></p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <div class="flex items-center border border-neutral-300 rounded text-xs">
                                        <button @click="updateCartQuantity(key, item.quantity - 1)" class="px-2 py-0.5 hover:bg-neutral-100">-</button>
                                        <span class="px-2 py-0.5 font-semibold text-neutral-800" x-text="item.quantity"></span>
                                        <button @click="updateCartQuantity(key, item.quantity + 1)" class="px-2 py-0.5 hover:bg-neutral-100">+</button>
                                    </div>
                                    <button @click="removeFromCart(key)" class="text-[11px] text-red-500 hover:text-red-700">Hapus</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-neutral-900" x-text="formatRupiah(item.price * item.quantity)"></span>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Footer Summary -->
                <div class="p-6 border-t border-neutral-200 bg-neutral-50 space-y-3" x-show="Object.keys(cartItems).length > 0">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-neutral-600">Subtotal:</span>
                        <span class="font-bold text-base text-neutral-900" x-text="cartSubtotal"></span>
                    </div>
                    <p class="text-[11px] text-neutral-500 leading-tight">Ongkos kirim & diskon voucher akan dihitung pada halaman pembayaran.</p>
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <a href="{{ route('cart.index') }}" class="w-full text-center py-2.5 px-4 text-xs font-semibold tracking-wider uppercase border border-neutral-800 text-neutral-800 hover:bg-neutral-100 rounded transition-colors">
                            Lihat Keranjang
                        </a>
                        <a href="{{ route('checkout.index') }}" class="w-full text-center py-2.5 px-4 text-xs font-semibold tracking-wider uppercase bg-black text-white hover:bg-neutral-800 rounded transition-colors">
                            Checkout
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 5. SEARCH MODAL -->
    <div x-show="searchModalOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-start justify-center pt-24 px-4 bg-black/70 backdrop-blur-sm"
         @keydown.escape.window="searchModalOpen = false">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden" @click.away="searchModalOpen = false">
            <div class="p-4 border-b border-neutral-200 flex items-center space-x-3">
                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <form action="{{ route('products.index') }}" method="GET" class="flex-1">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari aroma (misal: Glitch, Imperium, Mawar, Vanila, Lavender)..." 
                           class="w-full text-sm text-neutral-900 placeholder-neutral-400 focus:outline-none"
                           autofocus>
                </form>
                <button @click="searchModalOpen = false" class="text-neutral-400 hover:text-black">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 bg-neutral-50 text-xs text-neutral-500">
                <p class="font-semibold text-neutral-700 mb-2 uppercase tracking-wider text-[11px]">Paling Banyak Dicari:</p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('products.index', ['search' => 'Glitch']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Glitch Extrait</a>
                    <a href="{{ route('products.index', ['search' => 'Imperium']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Imperium Lion</a>
                    <a href="{{ route('products.index', ['search' => 'Inferno']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Inferno Dragon</a>
                    <a href="{{ route('products.index', ['search' => 'Marbella']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Marbella Phoenix</a>
                    <a href="{{ route('products.index', ['search' => 'Baby Love']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Baby Love EDP</a>
                    <a href="{{ route('products.index', ['search' => 'Royal Ispahan']) }}" class="px-3 py-1 bg-white border border-neutral-200 rounded-full hover:border-black text-neutral-700">Royal Ispahan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. QUICK VIEW MODAL -->
    <div x-show="quickViewOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm"
         @keydown.escape.window="quickViewOpen = false">
        <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden relative" @click.away="quickViewOpen = false">
            <button @click="quickViewOpen = false" class="absolute top-4 right-4 z-10 text-neutral-400 hover:text-black p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Image -->
                <div class="bg-neutral-100 p-8 flex items-center justify-center relative">
                    <span x-show="quickViewData.badge" x-text="quickViewData.badge" class="absolute top-4 left-4 bg-red-600 text-white text-[11px] font-bold px-2 py-0.5 rounded"></span>
                    <img :src="quickViewData.image" :alt="quickViewData.name" class="max-h-72 object-contain drop-shadow-xl">
                </div>

                <!-- Info -->
                <div class="p-8 space-y-4 flex flex-col justify-between">
                    <div>
                        <div class="text-[11px] font-bold tracking-widest text-neutral-500 uppercase" x-text="quickViewData.concentration + ' • ' + quickViewData.gender"></div>
                        <h3 class="text-xl font-bold font-serif text-neutral-900 mt-1" x-text="quickViewData.name"></h3>
                        <div class="flex items-center space-x-3 mt-2">
                            <span class="text-lg font-bold text-neutral-900" x-text="quickViewData.price"></span>
                            <span x-show="quickViewData.original_price" class="text-xs text-neutral-400 line-through" x-text="quickViewData.original_price"></span>
                        </div>

                        <p class="text-xs text-neutral-600 mt-3 leading-relaxed" x-text="quickViewData.short_description"></p>

                        <!-- Notes -->
                        <div class="mt-4 p-3 bg-neutral-50 rounded-lg border border-neutral-100 text-xs space-y-1">
                            <div class="text-neutral-500"><strong class="text-neutral-800">Top Notes:</strong> <span x-text="quickViewData.top_notes"></span></div>
                            <div class="text-neutral-500"><strong class="text-neutral-800">Base Notes:</strong> <span x-text="quickViewData.base_notes"></span></div>
                            <div class="text-neutral-500"><strong class="text-neutral-800">Ketahanan:</strong> <span x-text="quickViewData.longevity"></span></div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-neutral-100 space-y-3">
                        <template x-if="quickViewData.is_sold_out">
                            <button disabled class="w-full bg-neutral-300 text-neutral-500 text-xs font-bold uppercase tracking-wider py-3 rounded cursor-not-allowed">
                                Stok Habis / Sold Out
                            </button>
                        </template>
                        <template x-if="!quickViewData.is_sold_out">
                            <button @click="addToCart(quickViewData.id, null, 1); quickViewOpen = false;" 
                                    class="w-full bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-wider py-3 rounded transition-colors shadow-lg">
                                Tambah ke Keranjang
                            </button>
                        </template>
                        <a :href="quickViewData.url" class="block text-center text-xs text-neutral-600 hover:text-black font-semibold">
                            Lihat Halaman Detail Lengkap →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Store & Global Helpers -->
    <script>
        function globalStore() {
            return {
                mobileMenuOpen: false,
                cartDrawerOpen: false,
                searchModalOpen: false,
                quickViewOpen: false,
                quickViewData: {},
                cartCount: {{ array_sum(array_column(session('cart', []), 'quantity')) }},
                cartSubtotal: '{{ 'Rp ' . number_format(array_sum(array_map(function($i){ return $i['price'] * $i['quantity']; }, session('cart', []))), 0, ',', '.') }}',
                cartItems: @json(session('cart', (object)[])),

                initCart() {
                    this.fetchCartSummary();
                },

                formatRupiah(amount) {
                    return 'Rp ' + Number(amount).toLocaleString('id-ID');
                },

                fetchCartSummary() {
                    fetch('{{ route("cart.summary") }}')
                        .then(res => res.json())
                        .then(data => {
                            this.cartCount = data.count;
                            this.cartSubtotal = data.formatted_subtotal;
                            this.cartItems = {};
                            data.items.forEach(item => {
                                this.cartItems[item.key] = item;
                            });
                        });
                },

                addToCart(productId, variantId = null, quantity = 1) {
                    fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            variant_id: variantId,
                            quantity: quantity
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.fetchCartSummary();
                            this.cartDrawerOpen = true;
                        }
                    });
                },

                updateCartQuantity(key, quantity) {
                    if (quantity < 1) {
                        this.removeFromCart(key);
                        return;
                    }
                    fetch('{{ route("cart.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            key: key,
                            quantity: quantity
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.fetchCartSummary();
                        }
                    });
                },

                removeFromCart(key) {
                    fetch('{{ route("cart.remove") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ key: key })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.fetchCartSummary();
                        }
                    });
                },

                openQuickView(productId) {
                    fetch(`/api/products/${productId}/quick-view`)
                        .then(res => res.json())
                        .then(data => {
                            this.quickViewData = data;
                            this.quickViewOpen = true;
                        });
                }
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
