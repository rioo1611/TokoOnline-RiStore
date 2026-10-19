@extends('layouts.app')

@section('title', 'Keranjang Belanja | MYKONOS Official')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="border-b border-neutral-200 pb-4 mb-8">
        <h1 class="font-serif text-3xl font-bold text-neutral-900">Keranjang Belanja Anda</h1>
        <p class="text-xs text-neutral-500 mt-1">Periksa kembali wewangian pilihan Anda sebelum melanjutkan ke pembayaran.</p>
    </div>

    @if(empty($cart))
        <div class="text-center py-20 bg-white rounded-3xl border border-neutral-200 shadow-sm max-w-2xl mx-auto space-y-4">
            <svg class="w-16 h-16 mx-auto text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h2 class="text-lg font-bold text-neutral-800">Keranjang Belanja Anda Masih Kosong</h2>
            <p class="text-xs text-neutral-500 max-w-sm mx-auto">
                Eksplorasi mahakarya parfum Mykonos dan dapatkan bonus Free Tester Vial di setiap pembelian!
            </p>
            <div class="pt-2">
                <a href="{{ route('products.index') }}" class="inline-block text-xs font-bold uppercase tracking-widest bg-black text-white px-8 py-3.5 rounded-xl hover:bg-neutral-800 transition-colors shadow-lg">
                    Jelajahi Produk Sekarang
                </a>
            </div>
        </div>
    @else
        <!-- Free Shipping Target Progress Bar -->
        <div class="bg-amber-50/70 border border-amber-200 rounded-2xl p-5 mb-8">
            <div class="flex items-center justify-between text-xs font-semibold text-amber-900 mb-2">
                @if($remainingForFreeShipping > 0)
                    <span>Tambah <strong>Rp {{ number_format($remainingForFreeShipping, 0, ',', '.') }}</strong> lagi untuk mendapatkan <span class="underline">GRATIS ONGKIR SE-INDONESIA</span>!</span>
                @else
                    <span class="text-emerald-700 font-bold flex items-center space-x-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Selamat! Anda Memenuhi Syarat GRATIS ONGKIR SE-INDONESIA!</span>
                    </span>
                @endif
                <span>{{ $progressToFreeShipping }}%</span>
            </div>
            <div class="w-full bg-amber-200/60 h-2.5 rounded-full overflow-hidden">
                <div class="bg-amber-600 h-full rounded-full transition-all duration-500" style="width: {{ $progressToFreeShipping }}%;"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left: Items Table -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-6">
                
                <div class="divide-y divide-neutral-100">
                    @foreach($cart as $key => $item)
                        <div class="py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-contain bg-neutral-100 rounded-xl p-2 border border-neutral-200">
                                <div>
                                    <h3 class="text-sm font-bold text-neutral-900">{{ $item['name'] }}</h3>
                                    <p class="text-xs text-neutral-500 mt-0.5">Varian Ukuran: <strong class="text-neutral-800">{{ $item['variant_size'] }}</strong></p>
                                    <p class="text-xs font-semibold text-neutral-800 mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto space-x-6">
                                <!-- Stepper -->
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-neutral-300 rounded-lg overflow-hidden bg-white">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="px-3 py-1 text-xs hover:bg-neutral-100 font-bold text-neutral-600">-</button>
                                    <span class="px-3 py-1 text-xs font-bold text-neutral-900">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1 text-xs hover:bg-neutral-100 font-bold text-neutral-600">+</button>
                                </form>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <div class="text-sm font-bold text-neutral-900">
                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                    </div>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="mt-1">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $key }}">
                                        <button type="submit" class="text-[11px] text-red-500 hover:text-red-700 underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-neutral-200 flex justify-between items-center text-xs">
                    <a href="{{ route('products.index') }}" class="font-semibold text-neutral-700 hover:text-black">
                        ← Tambah Produk Lain
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-neutral-400 hover:text-red-600" onclick="return confirm('Apakah Anda yakin ingin mengosongkan keranjang?')">
                            Kosongkan Keranjang
                        </button>
                    </form>
                </div>

            </div>

            <!-- Right: Order Summary & Voucher -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-6">
                <h2 class="text-sm font-bold uppercase tracking-widest text-neutral-900 border-b border-neutral-100 pb-3">
                    Ringkasan Pesanan
                </h2>

                <div class="space-y-3 text-xs text-neutral-600">
                    <div class="flex justify-between">
                        <span>Subtotal Produk:</span>
                        <span class="font-bold text-neutral-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ongkos Kirim:</span>
                        @if($subtotal >= 500000)
                            <span class="font-bold text-emerald-600">GRATIS</span>
                        @else
                            <span class="font-bold text-neutral-900">Rp 20.000</span>
                        @endif
                    </div>

                    <div class="flex justify-between text-neutral-500">
                        <span>Free Tester Vial:</span>
                        <span class="text-amber-600 font-semibold">1x Sample (Free)</span>
                    </div>

                    <div class="pt-3 border-t border-neutral-200 flex justify-between items-baseline text-sm">
                        <span class="font-bold text-neutral-900">Perkiraan Total:</span>
                        <span class="font-bold text-lg text-neutral-900">
                            Rp {{ number_format($subtotal + ($subtotal >= 500000 ? 0 : 20000), 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('checkout.index') }}" 
                       class="block w-full py-4 bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest text-center rounded-xl transition-all shadow-xl">
                        Lanjut ke Pembayaran →
                    </a>
                </div>

                <div class="p-3 bg-neutral-50 rounded-xl border border-neutral-100 text-[11px] text-neutral-500 space-y-1">
                    <div class="flex items-center space-x-1.5 font-semibold text-neutral-700">
                        <span>🔒</span>
                        <span>Transaksi Aman & Terenkripsi</span>
                    </div>
                    <p>Mendukung QRIS, BCA, Mandiri, dan Pengiriman Cepat Se-Indonesia.</p>
                </div>
            </div>

        </div>
    @endif

</div>
@endsection

