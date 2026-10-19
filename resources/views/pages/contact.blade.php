@extends('layouts.app')

@section('title', 'Hubungi Kami | MYKONOS Official Parfums')

@section('content')
<div class="bg-neutral-900 py-16 text-white text-center space-y-3">
    <span class="text-xs font-bold uppercase tracking-[0.3em] text-brand-gold">CUSTOMER CARE & LIAISON</span>
    <h1 class="font-cinzel text-3xl sm:text-5xl font-black tracking-wider uppercase">
        HUBUNGI KAMI
    </h1>
    <p class="text-xs sm:text-sm text-neutral-400 max-w-xl mx-auto font-light">
        Konsultasikan preferensi aroma Anda atau dapatkan bantuan instan mengenai pengiriman dan pemesanan.
    </p>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
        
        <!-- Left: Quick Contact Info -->
        <div class="space-y-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-brand-goldDark">Layanan Pelanggan</span>
                <h2 class="font-serif text-3xl font-bold text-neutral-900 mt-1">Kami Siap Membantu Anda</h2>
                <p class="text-xs sm:text-sm text-neutral-600 mt-2 leading-relaxed">
                    Tim Fragrance Consultant kami aktif setiap hari dari jam 09.00 - 21.00 WIB untuk membantu Anda memilih signature scent yang tepat.
                </p>
            </div>

            <div class="space-y-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Official%20Mykonos,%20saya%20ingin%20konsultasi%20parfum" 
                   target="_blank" 
                   class="p-5 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center space-x-4 hover:bg-emerald-100/70 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xl">
                        💬
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-emerald-800">WhatsApp Customer Care</div>
                        <div class="text-sm font-bold text-neutral-900">+62 812-3456-7890</div>
                        <div class="text-[11px] text-neutral-500">Respon cepat (Rata-rata &lt; 5 menit)</div>
                    </div>
                </a>

                <div class="p-5 rounded-2xl bg-white border border-neutral-200 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-neutral-100 text-neutral-800 flex items-center justify-center text-xl">
                        ✉️
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-neutral-500">Email Korespondensi</div>
                        <div class="text-sm font-bold text-neutral-900">support@officialmykonos.com</div>
                        <div class="text-[11px] text-neutral-500">Pertanyaan kemitraan & pesanan khusus</div>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-neutral-200 flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-neutral-100 text-neutral-800 flex items-center justify-center text-xl">
                        🏬
                    </div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-neutral-500">Official Offline Flagship Store</div>
                        <div class="text-sm font-bold text-neutral-900">Senayan City Mall, Level 2, Jakarta</div>
                        <div class="text-[11px] text-neutral-500">Buka Setiap Hari: 10.00 - 22.00 WIB</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Message Form -->
        <div class="bg-white p-8 rounded-3xl border border-neutral-200 shadow-xl space-y-4">
            <h3 class="font-serif text-xl font-bold text-neutral-900">Kirim Pesan Langsung</h3>
            <p class="text-xs text-neutral-500">Isi formulir di bawah ini dan kami akan membalas melalui email atau WhatsApp Anda.</p>
            
            <form @submit.prevent="alert('Pesan Anda telah berhasil dikirim! Tim konsultan wewangian kami akan segera menghubungi Anda.'); $el.reset();" class="space-y-4 pt-2">
                <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Nama Lengkap *</label>
                    <input type="text" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Email *</label>
                        <input type="email" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-700 mb-1">Nomor WhatsApp *</label>
                        <input type="tel" required class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 focus:outline-none focus:border-black">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Topik Pesan *</label>
                    <select class="w-full text-xs px-3.5 py-2.5 rounded-lg border border-neutral-300 bg-white focus:outline-none">
                        <option>Konsultasi Rekomendasi Wewangian</option>
                        <option>Pertanyaan Status Pengiriman</option>
                        <option>Klaim Garansi Botol Pecah</option>
                        <option>Kerjasama & Pembelian Grosir / Souvenir</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-700 mb-1">Pesan Anda *</label>
                    <textarea rows="4" required class="w-full text-xs px-3.5 py-2 rounded-lg border border-neutral-300 focus:outline-none focus:border-black" placeholder="Tuliskan pertanyaan atau rekomendasi aroma yang Anda inginkan..."></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-black hover:bg-neutral-800 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-md">
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

