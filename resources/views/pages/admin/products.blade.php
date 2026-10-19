@extends('layouts.app')

@section('title', 'Kelola Produk Parfum | MYKONOS Admin')

@section('content')
<div class="bg-neutral-900 text-white py-8 border-b border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div>
            <div class="text-xs uppercase tracking-widest text-brand-gold font-bold">Katalog Management</div>
            <h1 class="font-cinzel text-2xl font-black tracking-wider">KELOLA PRODUK PARFUM</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-xs font-bold uppercase rounded-lg border border-neutral-700">
            ← Kembali ke Dashboard
        </a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8" x-data="{ addModalOpen: false }">
    
    <div class="flex justify-between items-center">
        <h2 class="text-base font-bold text-neutral-900">Daftar Semua Varian Parfum ({{ $products->total() }})</h2>
        <button @click="addModalOpen = true" class="px-4 py-2 bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-wider rounded-lg shadow-md transition-colors flex items-center space-x-2">
            <span>+ Tambah Parfum Baru</span>
        </button>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-3xl border border-neutral-200 shadow-sm p-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-neutral-200 text-neutral-500 uppercase tracking-wider text-[10px]">
                        <th class="py-3 px-3">Produk</th>
                        <th class="py-3 px-3">Kategori</th>
                        <th class="py-3 px-3">Konsentrasi</th>
                        <th class="py-3 px-3">Harga Base</th>
                        <th class="py-3 px-3">Stok</th>
                        <th class="py-3 px-3">Status</th>
                        <th class="py-3 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($products as $prod)
                        <tr class="hover:bg-neutral-50">
                            <td class="py-4 px-3 flex items-center space-x-3">
                                <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-12 h-12 object-contain bg-neutral-100 rounded p-1 border">
                                <div>
                                    <div class="font-bold text-neutral-900">{{ $prod->name }}</div>
                                    <div class="text-[10px] text-neutral-400">{{ $prod->slug }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-3 text-neutral-700">
                                {{ $prod->category->name ?? '-' }}
                            </td>
                            <td class="py-4 px-3 font-semibold text-neutral-800">
                                {{ $prod->concentration }}
                            </td>
                            <td class="py-4 px-3 font-bold text-neutral-900">
                                {{ $prod->formatted_price }}
                            </td>
                            <td class="py-4 px-3">
                                <span class="font-bold {{ $prod->stock <= 0 ? 'text-red-600' : 'text-emerald-700' }}">
                                    {{ $prod->stock }} pcs
                                </span>
                            </td>
                            <td class="py-4 px-3">
                                @if($prod->is_sold_out)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-neutral-200 text-neutral-600 uppercase">Habis</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 uppercase">Tersedia</span>
                                @endif
                            </td>
                            <td class="py-4 px-3">
                                <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="text-xs font-bold text-brand-goldDark hover:underline">
                                    Lihat di Toko ↗
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modal Tambah Produk Baru -->
    <div x-show="addModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-8 max-h-[90vh] overflow-y-auto" @click.away="addModalOpen = false">
            <div class="flex justify-between items-center border-b border-neutral-200 pb-4 mb-6">
                <h3 class="font-serif text-xl font-bold text-neutral-900">Tambah Wewangian Parfum Baru</h3>
                <button @click="addModalOpen = false" class="text-neutral-400 hover:text-black">✕</button>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Nama Parfum *</label>
                    <input type="text" name="name" required placeholder="Contoh: Mykonos - Matcha Latte Extrait 50ml" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Kategori *</label>
                        <select name="category_id" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 bg-white focus:outline-none">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Target Gender *</label>
                        <select name="gender" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 bg-white focus:outline-none">
                            <option value="unisex">Unisex</option>
                            <option value="women">Untuk Wanita (Women)</option>
                            <option value="men">Untuk Pria (Men)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Konsentrasi *</label>
                        <input type="text" name="concentration" required value="Extrait de Parfum" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Harga Jual (Rp) *</label>
                        <input type="number" name="price" required value="349000" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Jumlah Stok *</label>
                        <input type="number" name="stock" required value="50" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Top Notes</label>
                        <input type="text" name="top_notes" placeholder="Bergamot, Sitrus" class="w-full text-xs px-3 py-2 rounded-lg border border-neutral-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Middle Notes</label>
                        <input type="text" name="middle_notes" placeholder="Rose, Jasmine" class="w-full text-xs px-3 py-2 rounded-lg border border-neutral-300">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Base Notes</label>
                        <input type="text" name="base_notes" placeholder="Vanilla, Musk" class="w-full text-xs px-3 py-2 rounded-lg border border-neutral-300">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Deskripsi Aroma</label>
                    <textarea name="description" rows="3" class="w-full text-xs px-3.5 py-2 rounded-lg border border-neutral-300" placeholder="Jelaskan vibe wewangian dan ketahanannya..."></textarea>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" @click="addModalOpen = false" class="px-5 py-2.5 text-xs text-neutral-600 font-semibold hover:text-black">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-black text-white text-xs font-bold uppercase rounded-xl hover:bg-neutral-800">
                        Simpan Parfum
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
