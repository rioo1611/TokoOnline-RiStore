@extends('layouts.app')

@section('title', 'SUNFORGED COLLECTION | Official Mykonos Haute Parfumerie')

@section('content')

<!-- 1. CINEMATIC HERO HEADER -->
<section class="relative bg-neutral-950 text-white py-20 sm:py-28 overflow-hidden">
    <!-- Ambient Golden Glow -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-amber-500/15 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
        <span class="inline-block text-[11px] font-bold uppercase tracking-[0.35em] text-brand-gold bg-amber-950/40 border border-brand-gold/30 px-4 py-1.5 rounded-full">
            HAUTE PARFUMERIE FLAGSHIP LINE
        </span>
        <h1 class="font-cinzel text-4xl sm:text-6xl md:text-7xl font-black tracking-[0.12em] text-white uppercase drop-shadow-2xl">
            SUNFORGED COLLECTION
        </h1>
        <p class="text-xs sm:text-base text-neutral-300 font-light max-w-2xl mx-auto leading-relaxed">
            Lima lambang kekuatan mitologi yang ditempa dalam selubung logam mulia abadi. Menghadirkan konsentrasi wewangian murni <strong>Extrait de Parfum</strong> dengan ketahanan spektakuler hingga 16 jam.
        </p>

        <!-- Banner Image -->
        <div class="pt-8 max-w-5xl mx-auto">
            <div class="rounded-3xl overflow-hidden shadow-2xl border border-neutral-800 relative group">
                <img src="{{ asset('images/hero-sunforged.png') }}" alt="Sunforged Collection Bottles" class="w-full h-auto object-cover transform group-hover:scale-[1.02] transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-full text-center px-4">
                    <p class="text-xs sm:text-sm font-serif italic text-amber-200">
                        "Imperium • Inferno • Marbella • Nautilus • Untamed"
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. THE FIVE ARCHETYPES (CRESTS & STORIES) -->
<section class="py-20 bg-neutral-900 text-white border-t border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-brand-gold">KARAKTER & SIMBOLISME</span>
            <h2 class="font-cinzel text-3xl sm:text-4xl font-bold tracking-wider">LIMA MANA MITOLOGI</h2>
            <p class="text-xs text-neutral-400 font-light">
                Setiap botol Sunforged diukir dengan lambang pelindung yang mewakili aura dan karakter kepribadian yang berbeda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            
            <!-- Imperium -->
            <div class="bg-neutral-950 p-6 rounded-2xl border border-amber-500/30 text-center space-y-3 hover:border-amber-400 transition-all flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-500/10 border border-amber-500/40 flex items-center justify-center text-2xl">
                        🦁
                    </div>
                    <h3 class="font-serif text-lg font-bold text-amber-300 mt-3">IMPERIUM</h3>
                    <div class="text-[10px] uppercase tracking-widest text-amber-500 font-semibold">The Golden Lion</div>
                    <p class="text-[11px] text-neutral-400 mt-2 leading-relaxed">
                        Aura kepemimpinan karismatik. Segarnya sitrus Sisilia, kapulaga ningrat, dan kayu cendana Mysore.
                    </p>
                </div>
                <div class="text-[10px] text-amber-200/80 font-mono pt-3 border-t border-neutral-800">Citrus Woody Aromatic</div>
            </div>

            <!-- Inferno -->
            <div class="bg-neutral-950 p-6 rounded-2xl border border-red-500/30 text-center space-y-3 hover:border-red-400 transition-all flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 mx-auto rounded-full bg-red-500/10 border border-red-500/40 flex items-center justify-center text-2xl">
                        🐉
                    </div>
                    <h3 class="font-serif text-lg font-bold text-red-400 mt-3">INFERNO</h3>
                    <div class="text-[10px] uppercase tracking-widest text-red-500 font-semibold">The Obsidian Dragon</div>
                    <p class="text-[11px] text-neutral-400 mt-2 leading-relaxed">
                        Api gairah malam yang mendebarkan. Kepulan saffron berasap, black cherry manis gelap, dan kulit Tuscan.
                    </p>
                </div>
                <div class="text-[10px] text-red-200/80 font-mono pt-3 border-t border-neutral-800">Spicy Smoky Oriental</div>
            </div>

            <!-- Marbella -->
            <div class="bg-neutral-950 p-6 rounded-2xl border border-pink-500/30 text-center space-y-3 hover:border-pink-400 transition-all flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 mx-auto rounded-full bg-pink-500/10 border border-pink-500/40 flex items-center justify-center text-2xl">
                        🦚
                    </div>
                    <h3 class="font-serif text-lg font-bold text-pink-300 mt-3">MARBELLA</h3>
                    <div class="text-[10px] uppercase tracking-widest text-pink-500 font-semibold">The Rose Gold Phoenix</div>
                    <p class="text-[11px] text-neutral-400 mt-2 leading-relaxed">
                        Keanggunan senja Mediterania. Buah strawberry ranum, bunga peony, dan krim karamel vanila lembut.
                    </p>
                </div>
                <div class="text-[10px] text-pink-200/80 font-mono pt-3 border-t border-neutral-800">Fruity Floral Gourmand</div>
            </div>

            <!-- Nautilus -->
            <div class="bg-neutral-950 p-6 rounded-2xl border border-cyan-500/30 text-center space-y-3 hover:border-cyan-400 transition-all flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 mx-auto rounded-full bg-cyan-500/10 border border-cyan-500/40 flex items-center justify-center text-2xl">
                        🌊
                    </div>
                    <h3 class="font-serif text-lg font-bold text-cyan-300 mt-3">NAUTILUS</h3>
                    <div class="text-[10px] uppercase tracking-widest text-cyan-500 font-semibold">The Sapphire Seahorse</div>
                    <p class="text-[11px] text-neutral-400 mt-2 leading-relaxed">
                        Kedalaman samudra yang murni. Butiran garam laut segar, mint dingin, sage, dan lumut laut elegan.
                    </p>
                </div>
                <div class="text-[10px] text-cyan-200/80 font-mono pt-3 border-t border-neutral-800">Marine Salty Aquatic</div>
            </div>

            <!-- Untamed -->
            <div class="bg-neutral-950 p-6 rounded-2xl border border-amber-600/30 text-center space-y-3 hover:border-amber-500 transition-all flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-600/10 border border-amber-600/40 flex items-center justify-center text-2xl">
                        🐎
                    </div>
                    <h3 class="font-serif text-lg font-bold text-amber-200 mt-3">UNTAMED</h3>
                    <div class="text-[10px] uppercase tracking-widest text-amber-500 font-semibold">The Wild Stallion</div>
                    <p class="text-[11px] text-neutral-400 mt-2 leading-relaxed">
                        Jiwa petualang tanpa batas. Biji kopi arabika panggang pekat, tetesan aged rum, dan amber kristal.
                    </p>
                </div>
                <div class="text-[10px] text-amber-100/80 font-mono pt-3 border-t border-neutral-800">Ambery Coffee Leather</div>
            </div>

        </div>

    </div>
</section>

<!-- 3. ALL PRODUCTS CATALOG GRID -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between border-b border-neutral-200 pb-4 mb-10">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">KOLEKSI LENGKAP</span>
            <h2 class="font-serif text-3xl font-bold text-neutral-900 mt-1">Pilih Varian Sunforged Anda</h2>
        </div>
        <p class="text-xs text-neutral-500 mt-2 sm:mt-0">Tersedia dalam ukuran 50ml dan 100ml • Gratis Tester Vial di Setiap Order</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($products as $product)
            <div class="bg-white rounded-3xl p-6 border border-neutral-200/90 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                
                <div class="relative bg-neutral-900 rounded-2xl p-6 flex items-center justify-center h-64 overflow-hidden">
                    <span class="absolute top-4 left-4 bg-brand-gold text-black text-[10px] font-bold px-2.5 py-0.5 rounded uppercase tracking-wider">
                        {{ $product->badge }}
                    </span>
                    <a href="{{ route('products.show', $product->slug) }}" class="w-full h-full flex items-center justify-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-52 object-contain group-hover:scale-110 transition-transform duration-500 drop-shadow-[0_15px_25px_rgba(212,175,55,0.3)]">
                    </a>
                </div>

                <div class="mt-6 space-y-3 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="text-[11px] font-bold text-brand-goldDark tracking-widest uppercase">
                            {{ $product->concentration }} • {{ ucfirst($product->gender) }}
                        </div>
                        <h3 class="font-serif text-lg font-bold text-neutral-900 mt-1 leading-snug">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-brand-goldDark transition-colors">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="text-xs text-neutral-500 mt-1.5 leading-relaxed">
                            {{ $product->short_description }}
                        </p>
                    </div>

                    <!-- Notes Preview Box -->
                    <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-100 text-[11px] space-y-1">
                        <div class="text-neutral-500"><strong class="text-neutral-800">Top:</strong> {{ $product->top_notes }}</div>
                        <div class="text-neutral-500"><strong class="text-neutral-800">Base:</strong> {{ $product->base_notes }}</div>
                    </div>

                    <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-neutral-400">Harga Mulai</span>
                            <div class="text-base font-bold text-neutral-900">{{ $product->formatted_price }}</div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <button @click="openQuickView({{ $product->id }})" class="p-2.5 rounded-xl border border-neutral-300 text-neutral-700 hover:border-black hover:text-black transition-colors" title="Lihat Cepat">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                            <button @click="addToCart({{ $product->id }}, null, 1)" class="px-4 py-2.5 bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl transition-colors shadow-md">
                                + Keranjang
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</section>

<!-- 4. SPECIFICATIONS & CRAFTSMANSHIP -->
<section class="py-16 bg-neutral-100 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl border border-neutral-200/80 shadow-sm space-y-3">
                <span class="text-2xl">🛡️</span>
                <h3 class="font-serif text-base font-bold text-neutral-900">Heavy Metal Casing</h3>
                <p class="text-xs text-neutral-600 leading-relaxed font-light">
                    Botol dirancang dengan selubung logam padat berbobot berat untuk menjaga kestabilan formula konsentrat dari panas dan paparan cahaya matahari.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-neutral-200/80 shadow-sm space-y-3">
                <span class="text-2xl">⏳</span>
                <h3 class="font-serif text-base font-bold text-neutral-900">Extrait de Parfum (35%)</h3>
                <p class="text-xs text-neutral-600 leading-relaxed font-light">
                    Konsentrasi minyak wangi murni tertinggi di kelasnya. Menghasilkan ketahanan 14 hingga 16 jam dengan pancaran jejak aroma yang kuat dan memikat.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-neutral-200/80 shadow-sm space-y-3">
                <span class="text-2xl">👑</span>
                <h3 class="font-serif text-base font-bold text-neutral-900">Collector's Pride</h3>
                <p class="text-xs text-neutral-600 leading-relaxed font-light">
                    Setiap botol merupakan mahakarya seni yang layak dipajang di ruang rias pribadi Anda, menjadi simbol wibawa dan identitas keharuman Anda.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
