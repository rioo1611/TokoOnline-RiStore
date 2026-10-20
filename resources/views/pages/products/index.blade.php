@extends('layouts.app')

@section('title', 'Katalog & Filter Parfum | MYKONOS Official Parfums')

@section('content')

<!-- Catalog Breadcrumb / Top Bar -->
<div class="bg-white border-b border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 text-xs text-neutral-500 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-black">Beranda</a>
            <span>/</span>
            <span class="text-neutral-900 font-semibold">Semua Koleksi Parfum</span>
        </div>
        <div class="text-[11px] text-neutral-400">
            Official Haute Parfumerie Mykonos
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
     x-data="{
         // Budget Range Slider State
         minPriceLimit: {{ $minPriceInDb }},
         maxPriceLimit: {{ $maxPriceInDb }},
         minVal: {{ (int) $currentMinPrice }},
         maxVal: {{ (int) $currentMaxPrice }},
         
         // Accordion toggles
         availOpen: true,
         priceOpen: true,
         categoryOpen: true,

         // Quick budget preset helper
         setBudget(min, max) {
             this.minVal = min;
             this.maxVal = max;
             this.$refs.filterForm.submit();
         },

         formatNumber(val) {
             return Number(val).toLocaleString('id-ID');
         }
     }">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- ==================================================== -->
        <!-- LEFT SIDEBAR: FILTERS (Tersedianya & Harga Budget)  -->
        <!-- ==================================================== -->
        <aside class="lg:col-span-3 bg-white rounded-2xl border border-neutral-200/90 p-5 shadow-sm space-y-6 sticky top-28">
            
            <form action="{{ route('products.index') }}" method="GET" x-ref="filterForm" id="filterForm">
                <!-- Preserve existing category/gender/search/sort query params if present -->
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('gender')) <input type="hidden" name="gender" value="{{ request('gender') }}"> @endif
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                <!-- 1. ACCORDION: TERSEDIANYA (From User Screenshots) -->
                <div class="border-b border-neutral-200 pb-5">
                    <button type="button" @click="availOpen = !availOpen" class="w-full flex justify-between items-center text-left focus:outline-none">
                        <span class="font-serif text-base font-bold text-neutral-900">Tersedianya</span>
                        <span class="text-lg font-mono text-neutral-500" x-text="availOpen ? '—' : '+'"></span>
                    </button>

                    <div x-show="availOpen" x-collapse class="mt-4 space-y-2.5 text-xs">
                        <!-- Stok Habis Checkbox -->
                        <label class="flex items-center space-x-2.5 cursor-pointer text-neutral-700 hover:text-black">
                            <input type="checkbox" 
                                   name="availability[]" 
                                   value="stok_habis" 
                                   @change="$refs.filterForm.submit()"
                                   {{ in_array('stok_habis', $selectedAvailability) ? 'checked' : '' }}
                                   class="rounded border-neutral-300 text-black focus:ring-black w-4 h-4">
                            <span class="flex-1">Stok Habis ({{ $outOfStockCount }})</span>
                        </label>

                        <!-- Tersedia Checkbox -->
                        <label class="flex items-center space-x-2.5 cursor-pointer text-neutral-700 hover:text-black">
                            <input type="checkbox" 
                                   name="availability[]" 
                                   value="tersedia" 
                                   @change="$refs.filterForm.submit()"
                                   {{ in_array('tersedia', $selectedAvailability) ? 'checked' : '' }}
                                   class="rounded border-neutral-300 text-black focus:ring-black w-4 h-4">
                            <span class="flex-1">Tersedia ({{ $inStockCount }})</span>
                        </label>
                    </div>
                </div>

                <!-- 2. ACCORDION: HARGA / BUDGET SLIDER (From User Screenshots) -->
                <div class="border-b border-neutral-200 py-5">
                    <button type="button" @click="priceOpen = !priceOpen" class="w-full flex justify-between items-center text-left focus:outline-none">
                        <span class="font-serif text-base font-bold text-neutral-900">Harga</span>
                        <span class="text-lg font-mono text-neutral-500" x-text="priceOpen ? '—' : '+'"></span>
                    </button>

                    <div x-show="priceOpen" x-collapse class="mt-5 space-y-4">
                        
                        <!-- Dual Thumb Range Slider -->
                        <div class="relative pt-2 pb-1">
                            <!-- Background Track -->
                            <div class="w-full bg-neutral-200 h-1 rounded-full absolute top-1/2 -translate-y-1/2 pointer-events-none"></div>

                            <!-- Highlighted Selected Track -->
                            <div class="bg-black h-1 rounded-full absolute top-1/2 -translate-y-1/2 pointer-events-none"
                                 :style="`left: ${(minVal / maxPriceLimit) * 100}%; right: ${100 - (maxVal / maxPriceLimit) * 100}%;`"></div>

                            <!-- Min Input Slider -->
                            <input type="range" 
                                   :min="minPriceLimit" 
                                   :max="maxPriceLimit" 
                                   step="10000"
                                   x-model.number="minVal"
                                   @input="if(minVal > maxVal) minVal = maxVal"
                                   class="absolute pointer-events-none appearance-none bg-transparent w-full h-1 top-1/2 -translate-y-1/2 cursor-pointer z-20 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-black [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md">

                            <!-- Max Input Slider -->
                            <input type="range" 
                                   :min="minPriceLimit" 
                                   :max="maxPriceLimit" 
                                   step="10000"
                                   x-model.number="maxVal"
                                   @input="if(maxVal < minVal) maxVal = minVal"
                                   class="absolute pointer-events-none appearance-none bg-transparent w-full h-1 top-1/2 -translate-y-1/2 cursor-pointer z-20 [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:w-4 [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-black [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-white [&::-webkit-slider-thumb]:shadow-md">
                        </div>

                        <!-- Price Inputs (Matching Screenshot: "Rp [ 0 ] Ke Rp [ 426475 ]") -->
                        <div class="grid grid-cols-2 gap-2 items-center text-xs pt-3">
                            <div class="bg-[#F8F8F8] border border-neutral-300 rounded-xl px-2.5 py-1.5 flex items-center space-x-1.5">
                                <span class="text-[11px] text-neutral-500 font-semibold">Rp</span>
                                <input type="number" 
                                       name="min_price" 
                                       x-model.number="minVal" 
                                       class="w-full bg-transparent text-neutral-900 font-bold focus:outline-none text-xs">
                            </div>

                            <div class="bg-[#F8F8F8] border border-neutral-300 rounded-xl px-2.5 py-1.5 flex items-center space-x-1.5">
                                <span class="text-[11px] text-neutral-500 font-semibold">Ke Rp</span>
                                <input type="number" 
                                       name="max_price" 
                                       x-model.number="maxVal" 
                                       class="w-full bg-transparent text-neutral-900 font-bold focus:outline-none text-xs">
                            </div>
                        </div>

                        <!-- Submit Budget Filter Button -->
                        <button type="submit" class="w-full py-2 bg-neutral-900 hover:bg-black text-white text-[11px] font-bold uppercase tracking-wider rounded-lg transition-colors shadow-sm">
                            Terapkan Budget
                        </button>

                        <!-- Quick Budget Presets -->
                        <div class="pt-2">
                            <span class="text-[10px] uppercase font-bold text-neutral-400 tracking-wider block mb-1.5">Pilihan Cepat Budget:</span>
                            <div class="grid grid-cols-2 gap-1.5 text-[11px]">
                                <button type="button" @click="setBudget(0, 250000)" class="py-1 px-2 rounded border border-neutral-200 bg-neutral-50 hover:bg-neutral-100 text-neutral-700 text-left truncate">
                                    &lt; Rp 250rb
                                </button>
                                <button type="button" @click="setBudget(250000, 450000)" class="py-1 px-2 rounded border border-neutral-200 bg-neutral-50 hover:bg-neutral-100 text-neutral-700 text-left truncate">
                                    250rb - 450rb
                                </button>
                                <button type="button" @click="setBudget(450000, maxPriceLimit)" class="py-1 px-2 rounded border border-neutral-200 bg-neutral-50 hover:bg-neutral-100 text-neutral-700 text-left truncate">
                                    &gt; Rp 450rb
                                </button>
                                <button type="button" @click="setBudget(0, maxPriceLimit)" class="py-1 px-2 rounded border border-neutral-200 bg-neutral-50 hover:bg-neutral-100 text-neutral-700 text-left truncate font-semibold">
                                    Semua Harga
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 3. ACCORDION: KATEGORI KOLEKSI -->
                <div class="pt-5">
                    <button type="button" @click="categoryOpen = !categoryOpen" class="w-full flex justify-between items-center text-left focus:outline-none">
                        <span class="font-serif text-base font-bold text-neutral-900">Koleksi Wewangian</span>
                        <span class="text-lg font-mono text-neutral-500" x-text="categoryOpen ? '—' : '+'"></span>
                    </button>

                    <div x-show="categoryOpen" x-collapse class="mt-4 space-y-2 text-xs">
                        <a href="{{ route('products.index', array_merge(request()->except(['category', 'page']))) }}" 
                           class="flex justify-between items-center py-1 {{ !request('category') ? 'font-bold text-black' : 'text-neutral-600 hover:text-black' }}">
                            <span>Semua Koleksi</span>
                            <span>{{ $totalProductsCount }}</span>
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('products.index', array_merge(request()->except(['page']), ['category' => $cat->slug])) }}" 
                               class="flex justify-between items-center py-1 {{ request('category') === $cat->slug ? 'font-bold text-brand-goldDark' : 'text-neutral-600 hover:text-black' }}">
                                <span>{{ $cat->name }}</span>
                                <span>{{ $cat->products_count ?? $cat->products()->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Reset Filters Button -->
                @if(request()->hasAny(['min_price', 'max_price', 'availability', 'category', 'gender', 'search']))
                    <div class="pt-4 border-t border-neutral-100">
                        <a href="{{ route('products.index') }}" class="block text-center text-xs font-semibold text-red-600 hover:underline">
                            Hapus Semua Filter (Reset)
                        </a>
                    </div>
                @endif

            </form>

        </aside>

        <!-- ==================================================== -->
        <!-- RIGHT AREA: HEADER, SORTING, ACTIVE PILLS, GRID     -->
        <!-- ==================================================== -->
        <main class="lg:col-span-9 space-y-6">
            
            <!-- Top Controls: Product Count & Sorting (From User Screenshots) -->
            <div class="bg-white p-4 rounded-2xl border border-neutral-200/90 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                
                <!-- Product Count (Matching Screenshot 1: "2 dari 54 produk") -->
                <div class="text-xs text-neutral-700">
                    @if($filteredCount < $totalProductsCount)
                        <span class="font-bold text-neutral-900">{{ $filteredCount }}</span> dari <span class="font-bold text-neutral-900">{{ $totalProductsCount }}</span> produk
                    @else
                        <span class="font-bold text-neutral-900">{{ $totalProductsCount }}</span> produk tersedia
                    @endif
                </div>

                <!-- Sorting Dropdown (From User Screenshots: "Urutkan berdasarkan: Secara alfabetis, AZ ∨") -->
                <div class="flex items-center space-x-2 text-xs">
                    <span class="text-neutral-500">Urutkan berdasarkan:</span>
                    <select onchange="window.location.href = this.value;" 
                            class="bg-transparent font-semibold text-neutral-900 border-b border-neutral-300 pb-0.5 focus:outline-none cursor-pointer">
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" {{ request('sort', 'popular') === 'popular' ? 'selected' : '' }}>
                            Paling Populer
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'az'])) }}" {{ request('sort') === 'az' ? 'selected' : '' }}>
                            Secara alfabetis, AZ
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'za'])) }}" {{ request('sort') === 'za' ? 'selected' : '' }}>
                            Secara alfabetis, ZA
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" {{ request('sort') === 'price_low' ? 'selected' : '' }}>
                            Harga rendah ke tinggi
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" {{ request('sort') === 'price_high' ? 'selected' : '' }}>
                            Harga tinggi ke rendah
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'bestseller'])) }}" {{ request('sort') === 'bestseller' ? 'selected' : '' }}>
                            Terlaris (Best Seller)
                        </option>
                        <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" {{ request('sort') === 'newest' ? 'selected' : '' }}>
                            Tanggal baru ke lama
                        </option>
                    </select>
                </div>

            </div>

            <!-- Active Filter Badges / Pills (From Screenshot 1 & 2: "Rp 0 - Rp 426.475 ✕") -->
            @php
                $hasActivePriceFilter = request()->filled('min_price') || (request()->filled('max_price') && (float)request('max_price') < $maxPriceInDb);
                $hasActiveAvail = !empty($selectedAvailability);
            @endphp

            @if($hasActivePriceFilter || $hasActiveAvail || request('category') || request('gender') || request('search'))
                <div class="flex flex-wrap items-center gap-2">
                    
                    <!-- Price Filter Pill -->
                    @if($hasActivePriceFilter)
                        <a href="{{ route('products.index', request()->except(['min_price', 'max_price', 'page'])) }}" 
                           class="inline-flex items-center space-x-2 bg-white border border-neutral-300 hover:border-black text-neutral-800 text-xs px-3 py-1 rounded-full shadow-sm transition-colors group">
                            <span>Rp {{ number_format($currentMinPrice, 0, ',', '.') }} - Rp {{ number_format($currentMaxPrice, 0, ',', '.') }}</span>
                            <span class="text-neutral-400 group-hover:text-black font-bold">✕</span>
                        </a>
                    @endif

                    <!-- Availability Pills -->
                    @if(in_array('stok_habis', $selectedAvailability))
                        <a href="{{ route('products.index', array_merge(request()->except(['page']), ['availability' => array_diff($selectedAvailability, ['stok_habis'])])) }}" 
                           class="inline-flex items-center space-x-2 bg-white border border-neutral-300 hover:border-black text-neutral-800 text-xs px-3 py-1 rounded-full shadow-sm transition-colors group">
                            <span>Stok Habis</span>
                            <span class="text-neutral-400 group-hover:text-black font-bold">✕</span>
                        </a>
                    @endif

                    @if(in_array('tersedia', $selectedAvailability))
                        <a href="{{ route('products.index', array_merge(request()->except(['page']), ['availability' => array_diff($selectedAvailability, ['tersedia'])])) }}" 
                           class="inline-flex items-center space-x-2 bg-white border border-neutral-300 hover:border-black text-neutral-800 text-xs px-3 py-1 rounded-full shadow-sm transition-colors group">
                            <span>Tersedia</span>
                            <span class="text-neutral-400 group-hover:text-black font-bold">✕</span>
                        </a>
                    @endif

                    <!-- Category Pill -->
                    @if(request('category'))
                        <a href="{{ route('products.index', request()->except(['category', 'page'])) }}" 
                           class="inline-flex items-center space-x-2 bg-white border border-neutral-300 hover:border-black text-neutral-800 text-xs px-3 py-1 rounded-full shadow-sm transition-colors group">
                            <span>Koleksi: {{ ucfirst(str_replace('-', ' ', request('category'))) }}</span>
                            <span class="text-neutral-400 group-hover:text-black font-bold">✕</span>
                        </a>
                    @endif

                    <!-- Search Keyword Pill -->
                    @if(request('search'))
                        <a href="{{ route('products.index', request()->except(['search', 'page'])) }}" 
                           class="inline-flex items-center space-x-2 bg-white border border-neutral-300 hover:border-black text-neutral-800 text-xs px-3 py-1 rounded-full shadow-sm transition-colors group">
                            <span>Pencarian: "{{ request('search') }}"</span>
                            <span class="text-neutral-400 group-hover:text-black font-bold">✕</span>
                        </a>
                    @endif

                    <!-- Clear All Pill -->
                    <a href="{{ route('products.index') }}" class="text-xs text-neutral-500 hover:text-black underline ml-2">
                        Hapus Semua
                    </a>
                </div>
            @endif

            <!-- Product Grid -->
            @if($products->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl border border-neutral-200 shadow-sm p-8 space-y-3">
                    <svg class="w-16 h-16 mx-auto text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-base font-bold text-neutral-800">Tidak ada parfum yang cocok dengan filter budget Anda</h3>
                    <p class="text-xs text-neutral-500 max-w-sm mx-auto">
                        Coba geser rentang harga lebih luas atau bersihkan filter untuk melihat wewangian lainnya.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('products.index') }}" class="inline-block text-xs font-bold uppercase tracking-wider bg-black text-white px-6 py-2.5 rounded-xl hover:bg-neutral-800 transition-colors">
                            Lihat Semua Koleksi
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        @include('pages.products._card', ['product' => $product])
                    @endforeach
                </div>

                <div class="pt-8">
                    {{ $products->links() }}
                </div>
            @endif

        </main>

    </div>

</div>
@endsection
