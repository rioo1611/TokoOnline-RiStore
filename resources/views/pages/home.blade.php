@extends('layouts.app')

@section('title', 'MYKONOS | Official Haute Parfumerie & Extrait de Parfum')

@section('content')

<!-- 1. HERO SLIDER (From Screenshot 1: SUNFORGED COLLECTION) -->
<section class="relative bg-neutral-950 py-4 sm:py-8 overflow-hidden" x-data="{ currentSlide: 0 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Slider Frame -->
        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-neutral-800">
            
            <!-- Slide 1: Sunforged Collection Banner -->
            <div x-show="currentSlide === 0" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="relative min-h-[420px] sm:min-h-[500px] flex items-center justify-center bg-cover bg-center"
                 style="background-image: url('{{ asset('images/hero-sunforged.png') }}'); background-size: cover; background-position: center;">
                
                <!-- Dark Gradient Overlay for text readability if needed -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>

                <div class="relative z-10 text-center px-4 max-w-3xl mt-auto pb-10 sm:pb-12">
                    <span class="inline-block text-[11px] font-bold uppercase tracking-[0.3em] text-brand-gold bg-black/60 backdrop-blur-md px-4 py-1.5 rounded-full border border-brand-gold/30 mb-3">
                        HAUTE PARFUMERIE EXCLUSIVE
                    </span>
                    <h1 class="font-cinzel text-3xl sm:text-5xl md:text-6xl font-black tracking-[0.15em] text-white uppercase drop-shadow-lg">
                        SUNFORGED COLLECTION
                    </h1>
                    <p class="text-xs sm:text-sm text-neutral-200 mt-2 font-light tracking-wide max-w-xl mx-auto drop-shadow">
                        Lima mahakarya wewangian berlapis botol logam mulia: Imperium • Inferno • Marbella • Nautilus • Untamed
                    </p>
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('sunforged') }}" 
                           class="bg-brand-gold hover:bg-brand-goldDark text-black text-xs font-bold uppercase tracking-[0.2em] px-8 py-3.5 rounded shadow-xl transition-all transform hover:-translate-y-0.5">
                            Jelajahi Koleksi
                        </a>
                        <a href="{{ route('products.show', 'mykonos-x-setiawanade-glitch') }}" 
                           class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white text-xs font-bold uppercase tracking-[0.2em] px-8 py-3.5 rounded border border-white/30 transition-all">
                            Lihat Glitch Extrait
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Glitch Futuristic Drop -->
            <div x-show="currentSlide === 1" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="relative min-h-[420px] sm:min-h-[500px] flex items-center bg-gradient-to-r from-neutral-900 via-neutral-950 to-neutral-900 px-6 sm:px-16">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center w-full max-w-5xl mx-auto z-10 py-10">
                    <div class="text-left space-y-4">
                        <span class="inline-block text-[11px] font-bold uppercase tracking-[0.25em] text-cyan-400 bg-cyan-950/60 px-3 py-1 rounded border border-cyan-800">
                            SPECIAL COLLABORATION • DISKON 52%
                        </span>
                        <h2 class="font-cinzel text-3xl sm:text-5xl font-black text-white tracking-wider">
                            GLITCH EXTRAIT
                        </h2>
                        <p class="text-xs sm:text-sm text-neutral-300 leading-relaxed font-light">
                            Mykonos x SetiawanAde. Aroma metallic bergamot, heliotrope, dan ambery tonka bean yang adiktif dengan ketahanan hingga 14+ jam.
                        </p>
                        <div class="flex items-baseline space-x-3 pt-2">
                            <span class="text-2xl font-bold text-white">Mulai Rp 239.000</span>
                            <span class="text-sm text-neutral-500 line-through">Rp 499.000</span>
                        </div>
                        <div class="pt-4 flex space-x-4">
                            <a href="{{ route('products.show', 'mykonos-x-setiawanade-glitch') }}" 
                               class="bg-cyan-400 hover:bg-cyan-300 text-black text-xs font-bold uppercase tracking-widest px-7 py-3 rounded transition-all">
                                Beli Sekarang
                            </a>
                            <button @click="addToCart(1, null, 1)" 
                                    class="border border-neutral-600 text-white hover:bg-neutral-800 text-xs font-bold uppercase tracking-widest px-6 py-3 rounded transition-all">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/product-glitch.png') }}" alt="Glitch Extrait de Parfum" class="max-h-80 object-contain drop-shadow-[0_20px_40px_rgba(34,211,238,0.25)]">
                    </div>
                </div>
            </div>

            <!-- Slide 3: Wewangian Wanita (Untuknya) -->
            <div x-show="currentSlide === 2" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="relative min-h-[420px] sm:min-h-[500px] flex items-center bg-gradient-to-r from-rose-950 via-pink-950 to-neutral-950 px-6 sm:px-16">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center w-full max-w-5xl mx-auto z-10 py-10">
                    <div class="text-left space-y-4">
                        <span class="inline-block text-[11px] font-bold uppercase tracking-[0.25em] text-pink-300 bg-pink-950/60 px-3 py-1 rounded border border-pink-800">
                            FEMININE SIGNATURE COLLECTION
                        </span>
                        <h2 class="font-serif text-3xl sm:text-5xl font-bold text-white tracking-wide">
                            Untuknya: Keanggunan Yang Tak Terlupakan
                        </h2>
                        <p class="text-xs sm:text-sm text-neutral-300 leading-relaxed font-light">
                            Sentuhan keharuman mawar Ispahan, leci ranum, dan bedak bayi lembut nan menenangkan.
                        </p>
                        <div class="pt-4 flex space-x-4">
                            <a href="{{ route('products.index', ['gender' => 'women']) }}" 
                               class="bg-pink-300 hover:bg-pink-200 text-black text-xs font-bold uppercase tracking-widest px-7 py-3 rounded transition-all">
                                Jelajahi Parfum Wanita
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/banner-untuknya.png') }}" alt="Koleksi Untuknya" class="max-h-80 rounded-xl object-cover shadow-2xl border border-pink-900/50">
                    </div>
                </div>
            </div>

            <!-- Slider Dots Indicator (From Screenshot 1) -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex space-x-2">
                <button @click="currentSlide = 0" 
                        class="w-3 h-3 rounded-full transition-all"
                        :class="currentSlide === 0 ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/70'">
                </button>
                <button @click="currentSlide = 1" 
                        class="w-3 h-3 rounded-full transition-all"
                        :class="currentSlide === 1 ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/70'">
                </button>
                <button @click="currentSlide = 2" 
                        class="w-3 h-3 rounded-full transition-all"
                        :class="currentSlide === 2 ? 'bg-white w-8' : 'bg-white/40 hover:bg-white/70'">
                </button>
            </div>

            <!-- Next & Prev Controls -->
            <button @click="currentSlide = currentSlide === 0 ? 2 : currentSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-black/40 text-white hover:bg-black/70 backdrop-blur-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="currentSlide = currentSlide === 2 ? 0 : currentSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-2 rounded-full bg-black/40 text-white hover:bg-black/70 backdrop-blur-sm transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- 2. VALUE PROPOSITIONS BAR -->
<section class="py-6 border-b border-neutral-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <div class="flex items-center justify-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="text-left">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">100% Original</h4>
                    <p class="text-[11px] text-neutral-500">Official Mykonos Store</p>
                </div>
            </div>

            <div class="flex items-center justify-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-left">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Extrait de Parfum</h4>
                    <p class="text-[11px] text-neutral-500">Tahan 12 - 16+ Jam</p>
                </div>
            </div>

            <div class="flex items-center justify-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="text-left">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Free Tester Vials</h4>
                    <p class="text-[11px] text-neutral-500">Di Setiap Pembelian</p>
                </div>
            </div>

            <div class="flex items-center justify-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="text-left">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-900">Garansi 100% Pecah</h4>
                    <p class="text-[11px] text-neutral-500">Ganti Baru Gratis</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. SECTION "PENJUALAN! PALING POPULER" (From Screenshot 2) -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'sale' }">
    
    <!-- Section Header & Tabs (Matching Screenshot 2) -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-4 mb-8">
        <div>
            <div class="flex items-center space-x-6">
                <!-- Penjualan! Tab -->
                <button @click="activeTab = 'sale'" 
                        class="text-2xl sm:text-3xl font-bold font-serif transition-colors text-left"
                        :class="activeTab === 'sale' ? 'text-black' : 'text-neutral-400 hover:text-neutral-600'">
                    Penjualan!
                </button>
                
                <!-- Paling Populer Tab -->
                <button @click="activeTab = 'popular'" 
                        class="text-2xl sm:text-3xl font-bold font-serif transition-colors text-left"
                        :class="activeTab === 'popular' ? 'text-black' : 'text-neutral-400 hover:text-neutral-600'">
                    Paling Populer
                </button>
            </div>
        </div>

        <!-- "Lihat Semua Produk" link (From Screenshot 2) -->
        <a href="{{ route('products.index') }}" 
           class="mt-3 sm:mt-0 text-xs uppercase tracking-widest font-bold text-neutral-900 hover:text-brand-goldDark border-b-2 border-black hover:border-brand-goldDark pb-1 self-start sm:self-auto transition-colors">
            Lihat Semua Produk
        </a>
    </div>

    <!-- Product Grid for "Penjualan!" (Sale Items) -->
    <div x-show="activeTab === 'sale'" class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($saleProducts as $product)
            @include('pages.products._card', ['product' => $product])
        @endforeach
    </div>

    <!-- Product Grid for "Paling Populer" (Popular Items) -->
    <div x-show="activeTab === 'popular'" x-cloak class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($popularProducts as $product)
            @include('pages.products._card', ['product' => $product])
        @endforeach
    </div>

</section>

<!-- 4. SECTION "UNTUKNYA - JELAJAHI WEWANGIAN WANITA" (From Screenshot 3) -->
<section class="py-16 bg-gradient-to-b from-rose-50/50 to-[#FAF9F6] border-y border-rose-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- Left Banner Card: "Untuknya" with pink background, macaron, cloud (From Screenshot 3) -->
            <div class="lg:col-span-5 relative rounded-3xl overflow-hidden shadow-xl min-h-[440px] flex flex-col justify-end p-8 text-white group"
                 style="background-image: url('{{ asset('images/banner-untuknya.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-t from-pink-950/80 via-transparent to-transparent"></div>
                <div class="relative z-10 space-y-3">
                    <span class="text-[11px] font-bold tracking-[0.25em] uppercase text-pink-200">Koleksi Wewangian</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold tracking-wide">
                        Untuknya
                    </h2>
                    <p class="text-xs text-pink-100 font-light max-w-sm">
                        Kelembutan bunga mawar, aroma manis vanila Bourbon, dan bedak bayi yang memberi ketenangan abadi.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('products.index', ['gender' => 'women']) }}" 
                           class="inline-block bg-white/95 hover:bg-white text-neutral-900 text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-full backdrop-blur-sm transition-all shadow-lg">
                            Jelajahi Wewangian Wanita →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Products List (Royal Ispahan, Baby Love, etc.) (From Screenshot 3) -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-neutral-500">
                        Varian Terlaris Untuk Wanita
                    </h3>
                    <div class="flex items-center space-x-2">
                        <span class="w-8 h-8 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-400">
                            &lt;
                        </span>
                        <span class="w-8 h-8 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-400">
                            &gt;
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach($womenProducts->take(3) as $product)
                        @include('pages.products._card', ['product' => $product])
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 5. SECTION "SUNFORGED COLLECTION SHOWCASE" (Flagship Line) -->
<section class="py-20 bg-neutral-950 text-white relative overflow-hidden">
    <!-- Subtle glow effect -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-32 bg-amber-500/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-brand-gold">
                THE PINNACLE OF LUXURY
            </span>
            <h2 class="font-cinzel text-3xl sm:text-4xl md:text-5xl font-black tracking-wider uppercase">
                SUNFORGED COLLECTION
            </h2>
            <p class="text-xs sm:text-sm text-neutral-400 font-light leading-relaxed">
                Didesain dengan botol berpelindung logam artistik berukir lambang mitologi. Menghadirkan konsentrasi Extrait de Parfum dengan ketahanan hingga 16 jam.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($sunforgedProducts as $item)
                <div class="group bg-neutral-900/80 rounded-2xl p-5 border border-neutral-800 hover:border-brand-gold/60 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1">
                    <div class="relative bg-black/40 rounded-xl p-4 flex items-center justify-center h-48 overflow-hidden">
                        @if($item->badge)
                            <span class="absolute top-2 left-2 bg-brand-gold text-black text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">
                                {{ $item->badge }}
                            </span>
                        @endif
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="max-h-40 object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-[0_10px_20px_rgba(212,175,55,0.2)]">
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="text-[10px] text-brand-gold tracking-widest font-semibold uppercase">{{ $item->concentration }}</div>
                        <h4 class="text-xs font-bold text-white line-clamp-1 group-hover:text-brand-gold transition-colors">{{ $item->name }}</h4>
                        <p class="text-[11px] text-neutral-400 line-clamp-1">{{ $item->scent_family }}</p>
                        <div class="flex items-baseline space-x-2 pt-1">
                            <span class="text-xs font-bold text-white">{{ $item->formatted_price }}</span>
                            @if($item->original_price)
                                <span class="text-[10px] text-neutral-500 line-through">{{ $item->formatted_original_price }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-neutral-800 flex items-center justify-between">
                        <a href="{{ route('products.show', $item->slug) }}" class="text-[11px] font-semibold text-brand-gold hover:underline">
                            Detail →
                        </a>
                        <button @click="addToCart({{ $item->id }}, null, 1)" class="p-2 rounded-lg bg-neutral-800 hover:bg-brand-gold hover:text-black text-white transition-colors" title="Beli">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 6. VERIFIED CUSTOMER TESTIMONIALS -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-14 space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-neutral-400">Ulasan Nyata Pelanggan</span>
            <h2 class="font-serif text-3xl font-bold text-neutral-900">Apa Kata Mereka Tentang Mykonos?</h2>
            <div class="flex items-center justify-center space-x-1 text-amber-400 text-sm pt-1">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                <span class="text-neutral-700 text-xs font-semibold ml-2">4.9 / 5.0 dari 15.000+ Ulasan Pembeli</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestReviews as $review)
                <div class="p-6 rounded-2xl bg-neutral-50 border border-neutral-200/80 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex text-amber-400 text-xs">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <span>★</span>
                                @endfor
                            </div>
                            <span class="text-[10px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded font-semibold flex items-center space-x-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span>Terverifikasi</span>
                            </span>
                        </div>
                        <p class="text-xs text-neutral-700 leading-relaxed italic">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <div class="pt-3 border-t border-neutral-200/60 flex items-center justify-between text-xs">
                        <div>
                            <div class="font-bold text-neutral-900">{{ $review->customer_name }}</div>
                            <div class="text-[11px] text-neutral-500">{{ $review->product->name ?? 'Mykonos Perfume' }} ({{ $review->variant_size ?? 'Full Size' }})</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

