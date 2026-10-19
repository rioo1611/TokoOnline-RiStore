@extends('layouts.app')

@section('title', $product->name . ' | MYKONOS Official')

@section('content')
<div class="bg-white border-b border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 text-xs text-neutral-500">
        <a href="{{ route('home') }}" class="hover:text-black">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-black">Katalog</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}" class="hover:text-black">{{ $product->category->name ?? 'Parfum' }}</a>
        <span class="mx-2">/</span>
        <span class="text-neutral-900 font-semibold">{{ $product->name }}</span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" 
     x-data="{
         selectedVariantId: {{ $product->variants->first()->id ?? 'null' }},
         selectedPrice: {{ $product->variants->first()->price ?? $product->price }},
         selectedOriginalPrice: {{ $product->variants->first()->original_price ?? ($product->original_price ?? 'null') }},
         selectedStock: {{ $product->variants->first()->stock ?? $product->stock }},
         selectedSize: '{{ $product->variants->first()->size ?? '50ml' }}',
         quantity: 1,

         selectVariant(id, price, origPrice, stock, size) {
             this.selectedVariantId = id;
             this.selectedPrice = price;
             this.selectedOriginalPrice = origPrice;
             this.selectedStock = stock;
             this.selectedSize = size;
         }
     }">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left: Image Showcase -->
        <div class="lg:col-span-6 sticky top-28">
            <div class="bg-[#F8F8F8] rounded-3xl p-8 border border-neutral-200 flex items-center justify-center min-h-[460px] relative overflow-hidden">
                @if($product->is_sold_out)
                    <span class="absolute top-6 left-6 bg-neutral-600 text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">
                        Terjual Habis
                    </span>
                @elseif($product->badge)
                    <span class="absolute top-6 left-6 {{ str_contains($product->badge, '%') ? 'bg-red-600' : 'bg-neutral-900' }} text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider">
                        {{ $product->badge }}
                    </span>
                @endif

                <img src="{{ asset($product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="max-h-[380px] object-contain drop-shadow-2xl transition-transform duration-500 hover:scale-105">
            </div>

            <!-- Authentic Trust Badges -->
            <div class="grid grid-cols-3 gap-3 mt-4 text-center">
                <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-200/60">
                    <div class="text-[11px] font-bold text-neutral-800">100% Original</div>
                    <div class="text-[10px] text-neutral-500">Garansi Pabrik Mykonos</div>
                </div>
                <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-200/60">
                    <div class="text-[11px] font-bold text-neutral-800">Free Tester Vial</div>
                    <div class="text-[10px] text-neutral-500">Di Setiap Order</div>
                </div>
                <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-200/60">
                    <div class="text-[11px] font-bold text-neutral-800">Garansi Pecah</div>
                    <div class="text-[10px] text-neutral-500">Diganti Baru 100%</div>
                </div>
            </div>
        </div>

        <!-- Right: Product Specifications & Purchase Box -->
        <div class="lg:col-span-6 space-y-6">
            
            <div>
                <div class="flex items-center space-x-3 text-xs font-bold uppercase tracking-widest text-brand-goldDark">
                    <span>{{ $product->concentration }}</span>
                    <span>•</span>
                    <span class="text-neutral-500">{{ ucfirst($product->gender) }}</span>
                    <span>•</span>
                    <span class="text-neutral-500">{{ $product->category->name ?? 'Parfums' }}</span>
                </div>

                <h1 class="font-serif text-2xl sm:text-4xl font-bold text-neutral-900 mt-2 leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Rating -->
                <div class="flex items-center space-x-3 mt-3">
                    <div class="flex text-amber-400 text-sm">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <span class="text-xs font-bold text-neutral-800">{{ $product->rating }} / 5.0</span>
                    <span class="text-neutral-300">•</span>
                    <a href="#reviews" class="text-xs text-neutral-500 hover:text-black underline">
                        {{ $product->reviews_count }} Ulasan Terverifikasi
                    </a>
                </div>
            </div>

            <!-- Price Display with Dynamic Alpine update -->
            <div class="p-4 bg-neutral-50 rounded-2xl border border-neutral-200/80 flex items-baseline space-x-4">
                <span class="text-3xl font-bold text-neutral-900" x-text="formatRupiah(selectedPrice)">
                    {{ $product->formatted_price }}
                </span>
                <span x-show="selectedOriginalPrice" class="text-sm text-neutral-400 line-through" x-text="formatRupiah(selectedOriginalPrice)">
                    {{ $product->formatted_original_price }}
                </span>
                @if($product->discount_percent)
                    <span class="text-xs font-bold text-red-600 bg-red-100 px-2 py-0.5 rounded">
                        HEMAT {{ $product->discount_percent }}%
                    </span>
                @endif
            </div>

            <!-- Short Description -->
            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed font-light">
                {{ $product->short_description }}
            </p>

            <!-- Variant Selector (50ml vs 100ml) -->
            @if($product->variants->isNotEmpty())
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-xs font-bold text-neutral-800">
                        <span>PILIH UKURAN BOTOL:</span>
                        <span class="text-neutral-500 font-normal">Ukuran Terpilih: <strong class="text-black" x-text="selectedSize"></strong></span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($product->variants as $variant)
                            <button type="button" 
                                    @click="selectVariant({{ $variant->id }}, {{ $variant->price }}, {{ $variant->original_price ?? 'null' }}, {{ $variant->stock }}, '{{ $variant->size }}')"
                                    class="p-3 rounded-xl border text-left transition-all relative flex flex-col justify-between"
                                    :class="selectedVariantId === {{ $variant->id }} ? 'border-black bg-neutral-900 text-white shadow-md' : 'border-neutral-200 bg-white text-neutral-800 hover:border-neutral-400'">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-bold tracking-wider uppercase">{{ $variant->size }}</span>
                                    @if($variant->stock <= 0)
                                        <span class="text-[9px] bg-red-500 text-white px-1.5 py-0.5 rounded">Habis</span>
                                    @else
                                        <span class="text-[10px] text-emerald-400 font-semibold" :class="selectedVariantId === {{ $variant->id }} ? 'text-emerald-300' : 'text-emerald-600'">Tersedia</span>
                                    @endif
                                </div>
                                <div class="text-xs font-bold mt-2" :class="selectedVariantId === {{ $variant->id }} ? 'text-white' : 'text-neutral-900'">
                                    {{ $variant->formatted_price }}
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quantity & Actions -->
            <div class="space-y-4 pt-2">
                <div class="flex items-center space-x-4">
                    <span class="text-xs font-bold uppercase text-neutral-700">Jumlah:</span>
                    <div class="flex items-center border border-neutral-300 rounded-lg overflow-hidden bg-white">
                        <button @click="if(quantity > 1) quantity--" class="px-3.5 py-2 text-neutral-600 hover:bg-neutral-100 font-bold">-</button>
                        <span class="px-4 py-2 text-xs font-bold text-neutral-900" x-text="quantity"></span>
                        <button @click="quantity++" class="px-3.5 py-2 text-neutral-600 hover:bg-neutral-100 font-bold">+</button>
                    </div>
                    <span class="text-xs text-neutral-500">
                        (Stok sisa: <strong class="text-neutral-800" x-text="selectedStock"></strong> pcs)
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                    <button type="button" 
                            @click="if(selectedStock > 0) addToCart({{ $product->id }}, selectedVariantId, quantity)"
                            :disabled="selectedStock <= 0"
                            class="w-full py-4 text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-md flex items-center justify-center space-x-2"
                            :class="selectedStock > 0 ? 'bg-black text-white hover:bg-neutral-800' : 'bg-neutral-200 text-neutral-400 cursor-not-allowed'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span x-text="selectedStock > 0 ? '+ Tambah ke Keranjang' : 'Stok Habis / Sold Out'"></span>
                    </button>

                    <button type="button" 
                            @click="if(selectedStock > 0) { addToCart({{ $product->id }}, selectedVariantId, quantity); setTimeout(() => window.location.href = '{{ route('checkout.index') }}', 400); }"
                            :disabled="selectedStock <= 0"
                            class="w-full py-4 text-xs font-bold uppercase tracking-widest rounded-xl transition-all border border-neutral-800 text-neutral-900 hover:bg-neutral-100 flex items-center justify-center"
                            :class="selectedStock > 0 ? '' : 'hidden'">
                        Beli Langsung Sekarang
                    </button>
                </div>
            </div>

            <!-- OLFACTORY PYRAMID (Notes Breakdown) -->
            <div class="pt-6 border-t border-neutral-200 space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-neutral-900">
                    Piramida Olfaktori (Fragrance Notes)
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Top Notes</span>
                        <p class="text-xs font-medium text-neutral-800 mt-1">{{ $product->top_notes ?? 'Bergamot, Sitrus Segar' }}</p>
                        <p class="text-[10px] text-neutral-500 mt-0.5">Aroma pembuka (15-30 menit)</p>
                    </div>

                    <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-rose-700">Heart Notes</span>
                        <p class="text-xs font-medium text-neutral-800 mt-1">{{ $product->middle_notes ?? 'Bunga & Rempah Eksotis' }}</p>
                        <p class="text-[10px] text-neutral-500 mt-0.5">Karakter inti aroma (2-4 jam)</p>
                    </div>

                    <div class="p-4 rounded-xl bg-neutral-50 border border-neutral-200/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-900">Base Notes</span>
                        <p class="text-xs font-medium text-neutral-800 mt-1">{{ $product->base_notes ?? 'Ambergris, Kayu, Vanila' }}</p>
                        <p class="text-[10px] text-neutral-500 mt-0.5">Jejak aroma akhir (12+ jam)</p>
                    </div>
                </div>
            </div>

            <!-- PERFORMANCE METERS -->
            <div class="p-5 bg-neutral-950 text-white rounded-2xl space-y-3">
                <div class="text-[11px] font-bold uppercase tracking-widest text-brand-gold">Performa Extrait de Parfum</div>
                
                <div class="space-y-2 text-xs">
                    <div class="flex justify-between">
                        <span class="text-neutral-400">Ketahanan (Longevity):</span>
                        <span class="font-bold text-white">{{ $product->longevity }}</span>
                    </div>
                    <div class="w-full bg-neutral-800 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-brand-gold h-full rounded-full" style="width: 95%;"></div>
                    </div>

                    <div class="flex justify-between pt-1">
                        <span class="text-neutral-400">Jejak Aroma (Sillage):</span>
                        <span class="font-bold text-white">{{ $product->sillage }}</span>
                    </div>
                    <div class="w-full bg-neutral-800 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-cyan-400 h-full rounded-full" style="width: 90%;"></div>
                    </div>
                </div>
            </div>

            <!-- Full Narrative Description -->
            <div class="pt-4 border-t border-neutral-200 space-y-2">
                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-neutral-900">Deskripsi & Kisah Wewangian</h3>
                <p class="text-xs text-neutral-600 leading-relaxed font-light">
                    {{ $product->description }}
                </p>
            </div>

        </div>

    </div>

    <!-- REVIEWS SECTION -->
    <section id="reviews" class="mt-20 pt-12 border-t border-neutral-200">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
            <div>
                <h2 class="font-serif text-2xl font-bold text-neutral-900">Ulasan Pembeli Terverifikasi ({{ $product->reviews->count() }})</h2>
                <div class="flex items-center space-x-2 mt-1">
                    <div class="flex text-amber-400 text-sm">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <span class="text-xs text-neutral-600 font-semibold">{{ $product->rating }} dari 5.0 bintang</span>
                </div>
            </div>
            <button @click="alert('Fitur tulis ulasan akan otomatis aktif setelah pesanan Anda berstatus selesai.')" 
                    class="mt-4 sm:mt-0 text-xs font-bold uppercase tracking-wider px-5 py-2.5 bg-neutral-900 text-white rounded-lg hover:bg-neutral-800">
                Tulis Ulasan
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($product->reviews as $review)
                <div class="p-6 rounded-2xl bg-white border border-neutral-200/90 shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-full bg-neutral-100 flex items-center justify-center font-bold text-xs text-neutral-700">
                                {{ substr($review->customer_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-neutral-900">{{ $review->customer_name }}</h4>
                                <span class="text-[10px] text-emerald-600 font-semibold flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    <span>Verified Buyer • Ukuran: {{ $review->variant_size ?? '50ml' }}</span>
                                </span>
                            </div>
                        </div>
                        <div class="flex text-amber-400 text-xs">
                            @for($i = 0; $i < $review->rating; $i++)
                                <span>★</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-neutral-700 leading-relaxed italic">
                        "{{ $review->comment }}"
                    </p>
                    <div class="text-[10px] text-neutral-400">
                        {{ $review->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-10 bg-neutral-50 rounded-xl text-neutral-500 text-xs">
                    Belum ada ulasan untuk varian ini. Jadilah yang pertama mengulas!
                </div>
            @endforelse
        </div>
    </section>

    <!-- RELATED PRODUCTS -->
    @if($relatedProducts->isNotEmpty())
        <section class="mt-20 pt-12 border-t border-neutral-200">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-neutral-400">Koleksi Terkait</span>
                    <h2 class="font-serif text-2xl font-bold text-neutral-900 mt-1">Anda Mungkin Juga Menyukai</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-bold uppercase tracking-wider text-black hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rel)
                    @include('pages.products._card', ['product' => $rel])
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection

