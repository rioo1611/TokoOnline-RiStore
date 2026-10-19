@extends('layouts.app')

@section('title', 'Pembayaran & Checkout | MYKONOS Official')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="border-b border-neutral-200 pb-4 mb-8">
        <h1 class="font-serif text-3xl font-bold text-neutral-900">Pembayaran & Pengiriman</h1>
        <p class="text-xs text-neutral-500 mt-1">Lengkapi data penerima untuk pengiriman pesanan wewangian resmi Mykonos.</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST" x-data="{
        voucherCode: '',
        discount: 0,
        subtotal: {{ $subtotal }},
        shipping: {{ $shippingCost }},
        voucherApplied: false,
        voucherMsg: '',

        applyVoucher() {
            let code = this.voucherCode.trim().toUpperCase();
            if (code === 'MYKONOSVIP') {
                this.discount = Math.min(50000, this.subtotal * 0.1);
                this.voucherApplied = true;
                this.voucherMsg = 'Voucher VIP Berhasil! Potongan 10% (Rp ' + Number(this.discount).toLocaleString('id-ID') + ')';
            } else if (code === 'FREEONGKIR') {
                this.discount = this.shipping;
                this.voucherApplied = true;
                this.voucherMsg = 'Voucher Gratis Ongkir Berhasil Diterapkan!';
            } else {
                this.voucherApplied = false;
                this.voucherMsg = 'Kode voucher tidak valid atau telah kedaluwarsa.';
            }
        },

        calculateTotal() {
            return Math.max(0, this.subtotal + this.shipping - this.discount);
        }
    }">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left: Checkout Forms -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Section 1: Customer Contact -->
                <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center space-x-2 border-b border-neutral-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">1</span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-neutral-900">Informasi Pembeli</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name', 'Rio Saputra') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1">Nomor WhatsApp / HP *</label>
                            <input type="tel" name="customer_phone" required value="{{ old('customer_phone', '081234567890') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-neutral-700 mb-1">Alamat Email (Untuk Bukti & Resi) *</label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email', 'rio.saputra@example.com') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Shipping Address -->
                <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center space-x-2 border-b border-neutral-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-neutral-900">Alamat Pengiriman</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-neutral-700 mb-1">Alamat Lengkap Rumah / Kantor *</label>
                            <textarea name="shipping_address" required rows="2" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black" placeholder="Contoh: Jl. Sudirman No. 88, Gedung Menara Tower Lt. 12, RT 01 / RW 05">{{ old('shipping_address', 'Jl. Rasuna Said Kav. B4, Setiabudi') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Kota / Kabupaten *</label>
                                <input type="text" name="city" required value="{{ old('city', 'Jakarta Selatan') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Provinsi *</label>
                                <input type="text" name="province" required value="{{ old('province', 'DKI Jakarta') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Kode Pos *</label>
                                <input type="text" name="postal_code" required value="{{ old('postal_code', '12920') }}" class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Courier Selection -->
                <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center space-x-2 border-b border-neutral-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-neutral-900">Pilihan Kurir Ekspedisi</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex flex-col justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-neutral-900">SiCepat BEST</span>
                                <input type="radio" name="courier" value="SiCepat BEST (1-2 Hari)" checked class="text-black focus:ring-black">
                            </div>
                            <span class="text-[11px] text-neutral-500 mt-2">Estimasi 1-2 Hari Kerja</span>
                            <span class="text-xs font-bold text-emerald-600 mt-1">{{ $subtotal >= 500000 ? 'GRATIS' : 'Rp 20.000' }}</span>
                        </label>

                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex flex-col justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-neutral-900">JNE Express REG</span>
                                <input type="radio" name="courier" value="JNE Express REG (2-3 Hari)" class="text-black focus:ring-black">
                            </div>
                            <span class="text-[11px] text-neutral-500 mt-2">Estimasi 2-3 Hari Kerja</span>
                            <span class="text-xs font-bold text-emerald-600 mt-1">{{ $subtotal >= 500000 ? 'GRATIS' : 'Rp 20.000' }}</span>
                        </label>

                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex flex-col justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-neutral-900">J&T Express</span>
                                <input type="radio" name="courier" value="J&T Express (2-4 Hari)" class="text-black focus:ring-black">
                            </div>
                            <span class="text-[11px] text-neutral-500 mt-2">Estimasi 2-4 Hari Kerja</span>
                            <span class="text-xs font-bold text-emerald-600 mt-1">{{ $subtotal >= 500000 ? 'GRATIS' : 'Rp 20.000' }}</span>
                        </label>
                    </div>
                </div>

                <!-- Section 4: Payment Method Selection -->
                <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center space-x-2 border-b border-neutral-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-black text-white text-xs font-bold flex items-center justify-center">4</span>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-neutral-900">Metode Pembayaran</h2>
                    </div>

                    <div class="space-y-3">
                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex items-center justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="payment_method" value="QRIS Instant (GoPay / ShopeePay / OVO / Dana / BCA Mobile)" checked class="text-black focus:ring-black">
                                <div>
                                    <div class="text-xs font-bold text-neutral-900">QRIS Instant Otomatis</div>
                                    <div class="text-[11px] text-neutral-500">Scan QRIS dari semua m-Banking & e-Wallet (Bebas Biaya Admin)</div>
                                </div>
                            </div>
                            <span class="text-xs font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded">Rekomendasi</span>
                        </label>

                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex items-center justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="payment_method" value="BCA Virtual Account" class="text-black focus:ring-black">
                                <div>
                                    <div class="text-xs font-bold text-neutral-900">BCA Virtual Account</div>
                                    <div class="text-[11px] text-neutral-500">Nomor VA otomatis terverifikasi 24 Jam</div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-neutral-500">BCA</span>
                        </label>

                        <label class="p-4 rounded-xl border border-neutral-300 hover:border-black cursor-pointer flex items-center justify-between has-[:checked]:border-black has-[:checked]:bg-neutral-50">
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="payment_method" value="Mandiri Virtual Account" class="text-black focus:ring-black">
                                <div>
                                    <div class="text-xs font-bold text-neutral-900">Mandiri / Bank Lainnya</div>
                                    <div class="text-[11px] text-neutral-500">Transfer bank otomatis</div>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-neutral-500">ATM / IB</span>
                        </label>
                    </div>
                </div>

                <!-- Notes for Store -->
                <div class="bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm">
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Catatan Tambahan untuk Admin Mykonos (Opsional)</label>
                    <input type="text" name="notes" placeholder="Contoh: Mohon sertakan tester vial wangi vanilla, bungkus rapat." class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                </div>

            </div>

            <!-- Right: Order Summary Sidebar -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-neutral-200 p-6 shadow-sm space-y-6 sticky top-28">
                <h2 class="text-sm font-bold uppercase tracking-widest text-neutral-900 border-b border-neutral-100 pb-3">
                    Barang yang Dipesan ({{ count($cart) }})
                </h2>

                <div class="divide-y divide-neutral-100 max-h-60 overflow-y-auto pr-1">
                    @foreach($cart as $item)
                        <div class="py-3 flex items-center justify-between space-x-3">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-contain bg-neutral-100 rounded-lg p-1 border">
                                <div>
                                    <h4 class="text-xs font-bold text-neutral-900 line-clamp-1">{{ $item['name'] }}</h4>
                                    <p class="text-[10px] text-neutral-500">{{ $item['variant_size'] }} × {{ $item['quantity'] }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold text-neutral-900">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Voucher Code Box -->
                <div class="pt-2 border-t border-neutral-100">
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Gunakan Voucher Promo</label>
                    <div class="flex space-x-2">
                        <input type="text" 
                               name="voucher_code" 
                               x-model="voucherCode" 
                               placeholder="Kode: MYKONOSVIP" 
                               class="w-full text-xs uppercase px-3 py-2 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                        <button type="button" 
                                @click="applyVoucher()" 
                                class="px-4 py-2 bg-neutral-900 hover:bg-black text-white text-xs font-bold uppercase rounded-lg transition-colors">
                            Pakai
                        </button>
                    </div>
                    <p x-show="voucherMsg" x-text="voucherMsg" class="text-[11px] mt-1 font-semibold" :class="voucherApplied ? 'text-emerald-600' : 'text-red-500'"></p>
                </div>

                <!-- Cost Breakdown -->
                <div class="space-y-2 text-xs text-neutral-600 pt-2 border-t border-neutral-100">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span class="font-semibold text-neutral-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Ongkos Kirim:</span>
                        @if($shippingCost == 0)
                            <span class="font-bold text-emerald-600">GRATIS</span>
                        @else
                            <span class="font-semibold text-neutral-900">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <div class="flex justify-between" x-show="discount > 0">
                        <span class="text-emerald-600 font-semibold">Diskon Voucher:</span>
                        <span class="font-bold text-emerald-600" x-text="'- Rp ' + Number(discount).toLocaleString('id-ID')"></span>
                    </div>

                    <div class="flex justify-between text-neutral-500">
                        <span>Bonus Tester:</span>
                        <span class="text-amber-600 font-semibold">1x Free Vial Sample</span>
                    </div>

                    <div class="pt-3 border-t border-neutral-200 flex justify-between items-baseline">
                        <span class="text-sm font-bold text-neutral-900">Total Pembayaran:</span>
                        <span class="text-xl font-bold text-neutral-900" x-text="'Rp ' + Number(calculateTotal()).toLocaleString('id-ID')">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-xl">
                    Konfirmasi & Bayar Sekarang →
                </button>

                <p class="text-[10px] text-center text-neutral-400">
                    Dengan menekan tombol, Anda menyetujui Syarat & Ketentuan Pembelian Resmi Mykonos Indonesia.
                </p>
            </div>

        </div>
    </form>

</div>
@endsection

