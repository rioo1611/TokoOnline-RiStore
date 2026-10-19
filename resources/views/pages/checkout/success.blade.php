@extends('layouts.app')

@section('title', 'Pesanan Diterima #' . $order->order_number . ' | MYKONOS Official')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="bg-white rounded-3xl border border-neutral-200 shadow-xl overflow-hidden">
        
        <!-- Header Banner -->
        <div class="bg-neutral-900 text-white p-8 text-center space-y-3">
            <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-400 mx-auto flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <span class="text-xs font-bold uppercase tracking-[0.25em] text-brand-gold">PESANAN RESMI BERHASIL DIBUAT</span>
            <h1 class="font-serif text-2xl sm:text-3xl font-bold">Terima Kasih, {{ $order->customer_name }}!</h1>
            <p class="text-xs text-neutral-300 font-light max-w-md mx-auto">
                Nomor Pesanan Anda: <strong class="text-white font-mono text-sm tracking-wider">{{ $order->order_number }}</strong>
            </p>
        </div>

        <!-- Order Body -->
        <div class="p-8 space-y-8">
            
            <!-- Payment Instructions Box (QRIS / VA) -->
            <div class="p-6 rounded-2xl bg-amber-50/60 border border-amber-200/80 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center sm:text-left">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-amber-800 bg-amber-100 px-2 py-0.5 rounded">
                        METODE PEMBAYARAN: {{ $order->payment_method }}
                    </span>
                    <h3 class="text-base font-bold text-neutral-900">Total Tagihan: {{ $order->formatted_total }}</h3>
                    <p class="text-xs text-neutral-600">
                        Status Pembayaran: <span class="font-semibold text-amber-700 uppercase tracking-wider">{{ $order->payment_status }}</span>. Silakan selesaikan pembayaran untuk mempercepat proses packing.
                    </p>
                </div>

                <!-- QRIS Mock / Badge -->
                <div class="p-3 bg-white rounded-xl border border-neutral-300 text-center shadow-sm">
                    <div class="w-28 h-28 bg-neutral-900 flex flex-col items-center justify-center rounded text-white p-2 text-center">
                        <span class="font-bold text-xs tracking-widest text-brand-gold">QRIS</span>
                        <div class="w-16 h-16 border-2 border-dashed border-white/50 rounded flex items-center justify-center my-1 text-[9px] text-neutral-400">
                            [ SCAN QR ]
                        </div>
                        <span class="text-[8px] text-neutral-400 uppercase">Mykonos Official</span>
                    </div>
                </div>
            </div>

            <!-- Tracking & Status Timeline -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-neutral-700">Status Proses Pesanan:</h3>
                
                <div class="grid grid-cols-4 gap-2 text-center text-xs">
                    <div class="space-y-1">
                        <div class="h-2 rounded-full bg-emerald-500"></div>
                        <span class="font-bold text-neutral-900 text-[11px]">1. Diterima</span>
                    </div>
                    <div class="space-y-1">
                        <div class="h-2 rounded-full {{ in_array($order->status, ['processing', 'shipped', 'completed']) ? 'bg-emerald-500' : 'bg-neutral-200' }}"></div>
                        <span class="font-semibold text-neutral-600 text-[11px]">2. Dikemas</span>
                    </div>
                    <div class="space-y-1">
                        <div class="h-2 rounded-full {{ in_array($order->status, ['shipped', 'completed']) ? 'bg-emerald-500' : 'bg-neutral-200' }}"></div>
                        <span class="font-semibold text-neutral-600 text-[11px]">3. Di Kurir</span>
                    </div>
                    <div class="space-y-1">
                        <div class="h-2 rounded-full {{ $order->status === 'completed' ? 'bg-emerald-500' : 'bg-neutral-200' }}"></div>
                        <span class="font-semibold text-neutral-600 text-[11px]">4. Terkirim</span>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-neutral-100 text-xs">
                
                <div class="space-y-2">
                    <h4 class="font-bold uppercase tracking-wider text-neutral-800">Tujuan Pengiriman:</h4>
                    <p class="text-neutral-600 font-medium">{{ $order->customer_name }} ({{ $order->customer_phone }})</p>
                    <p class="text-neutral-600 leading-relaxed">{{ $order->shipping_address }}</p>
                    <p class="text-neutral-600">{{ $order->city }}, {{ $order->province }} {{ $order->postal_code }}</p>
                    <p class="text-neutral-500 mt-1">Kurir: <strong class="text-neutral-800">{{ $order->courier }}</strong></p>
                </div>

                <div class="space-y-2">
                    <h4 class="font-bold uppercase tracking-wider text-neutral-800">Rincian Pembayaran:</h4>
                    <div class="flex justify-between text-neutral-600">
                        <span>Subtotal Produk:</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-neutral-600">
                        <span>Ongkos Kirim:</span>
                        <span>{{ $order->shipping_cost == 0 ? 'GRATIS' : 'Rp ' . number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between text-emerald-600 font-semibold">
                            <span>Diskon Voucher:</span>
                            <span>- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between font-bold text-sm text-neutral-900 pt-2 border-t border-neutral-200">
                        <span>Total Akhir:</span>
                        <span>{{ $order->formatted_total }}</span>
                    </div>
                </div>

            </div>

            <!-- Order Items List -->
            <div class="pt-4 border-t border-neutral-100 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-neutral-800">Daftar Produk:</h4>
                <div class="divide-y divide-neutral-100">
                    @foreach($order->items as $item)
                        <div class="py-3 flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset($item->product_image ?? 'images/product-glitch.png') }}" alt="{{ $item->product_name }}" class="w-12 h-12 object-contain bg-neutral-100 rounded p-1 border">
                                <div>
                                    <div class="font-bold text-neutral-900">{{ $item->product_name }}</div>
                                    <div class="text-[11px] text-neutral-500">Ukuran: {{ $item->variant_size }} × {{ $item->quantity }} pcs</div>
                                </div>
                            </div>
                            <span class="font-bold text-neutral-900">{{ $item->formatted_subtotal }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons: WhatsApp & Home -->
            <div class="pt-6 border-t border-neutral-200 flex flex-col sm:flex-row gap-4">
                <a href="{{ $waLink }}" target="_blank" 
                   class="flex-1 py-3.5 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center space-x-2 shadow-lg transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.299.144.347.491 1.2.534 1.288.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.274.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                    <span>Konfirmasi ke WhatsApp Admin Mykonos</span>
                </a>

                <a href="{{ route('home') }}" 
                   class="py-3.5 px-6 rounded-xl border border-neutral-300 text-neutral-800 hover:bg-neutral-50 font-bold text-xs uppercase tracking-wider text-center transition-colors">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>

</div>
@endsection

