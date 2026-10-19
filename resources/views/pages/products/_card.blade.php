<div class="group bg-white rounded-2xl p-4 border border-neutral-200/90 hover:border-black transition-all duration-300 flex flex-col justify-between hover:shadow-xl">
    
    <!-- Image & Badge Container -->
    <div class="relative bg-[#F8F8F8] rounded-xl p-4 flex items-center justify-center h-56 overflow-hidden">
        
        <!-- Badge (Screenshot 2: -52%, Screenshot 3: Terjual habis) -->
        @if($product->is_sold_out)
            <span class="absolute top-3 left-3 bg-neutral-500 text-white text-[10px] font-bold px-2 py-0.5 rounded tracking-wide uppercase">
                Terjual habis
            </span>
        @elseif($product->badge)
            <span class="absolute top-3 left-3 {{ str_contains($product->badge, '%') ? 'bg-red-600' : 'bg-neutral-900' }} text-white text-[10px] font-bold px-2 py-0.5 rounded tracking-wide uppercase">
                {{ $product->badge }}
            </span>
        @endif

        <!-- Quick View Overlay Button -->
        <button @click="openQuickView({{ $product->id }})" 
                class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 bg-white/95 hover:bg-black hover:text-white text-neutral-800 p-2 rounded-full shadow-md transition-all duration-300"
                title="Lihat Cepat">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        </button>

        <!-- Product Image -->
        <a href="{{ route('products.show', $product->slug) }}" class="w-full h-full flex items-center justify-center">
            <img src="{{ asset($product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="max-h-48 object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-md">
        </a>
    </div>

    <!-- Product Details -->
    <div class="mt-4 flex-1 flex flex-col justify-between space-y-2">
        <div>
            <div class="text-[10px] font-semibold text-neutral-400 uppercase tracking-widest">
                {{ $product->concentration }} • {{ ucfirst($product->gender) }}
            </div>
            
            <a href="{{ route('products.show', $product->slug) }}" class="block text-xs font-bold text-neutral-900 hover:text-brand-goldDark transition-colors line-clamp-2 mt-1 leading-snug">
                {{ $product->name }}
            </a>

            @if($product->scent_family)
                <p class="text-[11px] text-neutral-500 line-clamp-1 mt-0.5">
                    {{ $product->scent_family }}
                </p>
            @endif
        </div>

        <div class="pt-2 border-t border-neutral-100">
            <!-- Price Display (Matching Screenshot 2 & 3: "Mulai dari Rp ...") -->
            <div class="flex flex-col">
                <div class="flex items-baseline space-x-2">
                    <span class="text-xs font-bold text-neutral-900">
                        {{ $product->variants->count() > 1 ? 'Mulai dari ' : '' }}{{ $product->formatted_price }}
                    </span>
                </div>
                @if($product->original_price)
                    <span class="text-[10px] text-neutral-400 line-through">
                        {{ $product->formatted_original_price }}
                    </span>
                @endif
            </div>

            <!-- Action Button -->
            <div class="mt-3">
                @if($product->is_sold_out)
                    <button disabled class="w-full py-2 bg-neutral-200 text-neutral-400 text-[11px] font-bold uppercase tracking-wider rounded cursor-not-allowed">
                        Terjual Habis
                    </button>
                @else
                    <button @click="addToCart({{ $product->id }}, null, 1)" 
                            class="w-full py-2 bg-black hover:bg-neutral-800 text-white text-[11px] font-bold uppercase tracking-wider rounded transition-colors shadow-sm">
                        + Keranjang
                    </button>
                @endif
            </div>
        </div>

    </div>

</div>
