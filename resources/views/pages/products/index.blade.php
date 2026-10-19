@extends('layouts.app')

@section('title', 'Katalog Parfum | MYKONOS Official Parfums')

@section('content')
<div class="bg-neutral-900 py-12 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2">
        <span class="text-xs uppercase tracking-[0.3em] text-brand-gold font-bold">Koleksi Lengkap</span>
        <h1 class="font-cinzel text-3xl sm:text-4xl font-black tracking-wider uppercase">
            KATALOG RESMI MYKONOS
        </h1>
        <p class="text-xs sm:text-sm text-neutral-400 max-w-xl mx-auto">
            Temukan seni arsitektur wewangian yang merefleksikan kepribadian Anda dengan konsentrasi Extrait de Parfum terbaik.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Filter & Sort Bar -->
    <div class="bg-white p-6 rounded-2xl border border-neutral-200/80 mb-8 space-y-6 shadow-sm">
        
        <!-- Category Filter Pills -->
        <div class="flex items-center space-x-2 overflow-x-auto pb-2 scrollbar-none">
            <a href="{{ route('products.index') }}" 
               class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors whitespace-nowrap {{ !request('category') ? 'bg-black text-white' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200' }}">
                Semua Produk ({{ $totalCount }})
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $cat->slug])) }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-colors whitespace-nowrap {{ request('category') === $cat->slug ? 'bg-black text-white' : 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-neutral-100 items-center">
            
            <!-- Gender Filter -->
            <div class="flex items-center space-x-2">
                <span class="text-xs text-neutral-500 font-semibold uppercase">Untuk:</span>
                <div class="flex space-x-1">
                    <a href="{{ route('products.index', array_merge(request()->query(), ['gender' => null])) }}" 
                       class="px-2.5 py-1 text-xs rounded border {{ !request('gender') ? 'bg-neutral-800 text-white border-neutral-800' : 'border-neutral-300 text-neutral-600' }}">
                        Semua
                    </a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['gender' => 'women'])) }}" 
                       class="px-2.5 py-1 text-xs rounded border {{ request('gender') === 'women' ? 'bg-neutral-800 text-white border-neutral-800' : 'border-neutral-300 text-neutral-600' }}">
                        Wanita
                    </a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['gender' => 'men'])) }}" 
                       class="px-2.5 py-1 text-xs rounded border {{ request('gender') === 'men' ? 'bg-neutral-800 text-white border-neutral-800' : 'border-neutral-300 text-neutral-600' }}">
                        Pria
                    </a>
                    <a href="{{ route('products.index', array_merge(request()->query(), ['gender' => 'unisex'])) }}" 
                       class="px-2.5 py-1 text-xs rounded border {{ request('gender') === 'unisex' ? 'bg-neutral-800 text-white border-neutral-800' : 'border-neutral-300 text-neutral-600' }}">
                        Unisex
                    </a>
                </div>
            </div>

            <!-- Search Keyword -->
            <form action="{{ route('products.index') }}" method="GET" class="relative">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('gender')) <input type="hidden" name="gender" value="{{ request('gender') }}"> @endif
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari nama atau aroma parfum..." 
                       class="w-full text-xs px-3.5 py-2 pl-9 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                <svg class="w-4 h-4 text-neutral-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>

            <!-- Sorting Select -->
            <div class="flex items-center justify-end space-x-2">
                <span class="text-xs text-neutral-500 font-semibold uppercase">Urutkan:</span>
                <select onchange="location = this.value;" class="text-xs border border-neutral-300 rounded-lg px-3 py-2 bg-white focus:outline-none focus:border-black">
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'popular'])) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga: Termurah</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'rating'])) }}" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                    <option value="{{ route('products.index', array_merge(request()->query(), ['sort' => 'newest'])) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                </select>
            </div>

        </div>

    </div>

    <!-- Products Grid -->
    @if($products->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl border border-neutral-200">
            <svg class="w-16 h-16 mx-auto text-neutral-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-base font-bold text-neutral-800">Tidak ada produk ditemukan</h3>
            <p class="text-xs text-neutral-500 mt-1">Coba gunakan kata kunci lain atau reset filter pencarian Anda.</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 text-xs font-bold uppercase tracking-wider bg-black text-white px-5 py-2.5 rounded hover:bg-neutral-800">
                Reset Semua Filter
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('pages.products._card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @endif

</div>
@endsection

