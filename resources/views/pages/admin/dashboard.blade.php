@extends('layouts.app')

@section('title', 'Admin Dashboard | MYKONOS Store Management')

@section('content')
<div class="bg-neutral-900 text-white py-8 border-b border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="text-xs uppercase tracking-widest text-brand-gold font-bold">Pusat Kontrol Toko</div>
            <h1 class="font-cinzel text-2xl sm:text-3xl font-black tracking-wider">MYKONOS ADMIN PANEL</h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.products') }}" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-xs font-bold uppercase rounded-lg transition-colors border border-neutral-700">
                Kelola Produk
            </a>
            <a href="{{ route('home') }}" class="px-4 py-2 bg-brand-gold text-black hover:bg-brand-goldDark text-xs font-bold uppercase rounded-lg transition-colors">
                Lihat Toko Publik →
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    
    <!-- Summary Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-neutral-200 shadow-sm space-y-2">
            <div class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Total Pendapatan (Paid)</div>
            <div class="text-2xl font-black text-neutral-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="text-[11px] text-emerald-600 font-semibold flex items-center space-x-1">
                <span>↑ Transaksi Berhasil</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-neutral-200 shadow-sm space-y-2">
            <div class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Total Pesanan</div>
            <div class="text-2xl font-black text-neutral-900">{{ $totalOrders }}</div>
            <div class="text-[11px] text-neutral-500 font-medium">Pesanan Masuk</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-neutral-200 shadow-sm space-y-2">
            <div class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Total Katalog Parfum</div>
            <div class="text-2xl font-black text-neutral-900">{{ $totalProducts }}</div>
            <div class="text-[11px] text-neutral-500 font-medium">SKU Aktif di Website</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-neutral-200 shadow-sm space-y-2">
            <div class="text-[11px] font-bold uppercase tracking-wider text-neutral-400">Stok Menipis / Habis</div>
            <div class="text-2xl font-black {{ $lowStockProducts->count() > 0 ? 'text-red-600' : 'text-neutral-900' }}">
                {{ $lowStockProducts->count() }}
            </div>
            <div class="text-[11px] text-neutral-500 font-medium">Perlu Segera Restock</div>
        </div>

    </div>

    <!-- Recent Orders Management -->
    <div class="bg-white rounded-3xl border border-neutral-200 shadow-sm p-6 space-y-6">
        <div class="flex items-center justify-between border-b border-neutral-100 pb-4">
            <div>
                <h2 class="text-base font-bold text-neutral-900">Daftar Pesanan Terbaru</h2>
                <p class="text-xs text-neutral-500">Ubah status pesanan dan perbarui nomor resi pengiriman kurir.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-neutral-200 text-neutral-500 uppercase tracking-wider text-[10px]">
                        <th class="py-3 px-3">No. Order</th>
                        <th class="py-3 px-3">Pelanggan</th>
                        <th class="py-3 px-3">Produk</th>
                        <th class="py-3 px-3">Total</th>
                        <th class="py-3 px-3">Metode Bayar</th>
                        <th class="py-3 px-3">Status Saat Ini</th>
                        <th class="py-3 px-3">Aksi Update Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-neutral-50">
                            <td class="py-4 px-3 font-mono font-bold text-neutral-900">
                                {{ $order->order_number }}
                                <div class="text-[10px] text-neutral-400 font-sans">{{ $order->created_at->format('d M Y H:i') }}</div>
                            </td>
                            <td class="py-4 px-3">
                                <div class="font-bold text-neutral-900">{{ $order->customer_name }}</div>
                                <div class="text-[11px] text-neutral-500">{{ $order->city }} • {{ $order->customer_phone }}</div>
                            </td>
                            <td class="py-4 px-3">
                                <div class="space-y-1">
                                    @foreach($order->items as $item)
                                        <div class="text-neutral-700">
                                            • {{ $item->product_name }} ({{ $item->variant_size }}) × {{ $item->quantity }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-4 px-3 font-bold text-neutral-900">
                                {{ $order->formatted_total }}
                            </td>
                            <td class="py-4 px-3">
                                <span class="bg-neutral-100 text-neutral-800 text-[10px] font-bold px-2 py-0.5 rounded">
                                    {{ $order->payment_method }}
                                </span>
                            </td>
                            <td class="py-4 px-3">
                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase
                                    {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $order->status === 'processing' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-4 px-3">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="text-xs border border-neutral-300 rounded px-2 py-1 bg-white focus:outline-none">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Dikemas</option>
                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                    <button type="submit" class="bg-neutral-900 text-white text-[10px] font-bold px-2.5 py-1.5 rounded hover:bg-black">
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-neutral-400">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
