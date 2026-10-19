@extends('layouts.app')

@section('title', 'Tentang Kami | MYKONOS Official Parfums')

@section('content')
<div class="bg-neutral-900 py-16 text-white text-center space-y-3">
    <span class="text-xs font-bold uppercase tracking-[0.3em] text-brand-gold">OUR STORY & HERITAGE</span>
    <h1 class="font-cinzel text-3xl sm:text-5xl font-black tracking-wider uppercase">
        SENI WEWANGIAN MYKONOS
    </h1>
    <p class="text-xs sm:text-sm text-neutral-400 max-w-xl mx-auto font-light">
        Mendefinisikan ulang standar Haute Parfumerie Indonesia dengan konsentrasi minyak wangi murni tertinggi dan botol artistik bernilai koleksi.
    </p>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-4">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-goldDark">Filosofi Penciptaan</span>
            <h2 class="font-serif text-3xl font-bold text-neutral-900 leading-tight">
                Bukan Sekadar Parfum, Tapi Sebuah Mahakarya Emosi
            </h2>
            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed font-light">
                MYKONOS didirikan atas gairah untuk menghadirkan pengalaman wewangian setara brand niche dunia tanpa kompromi kualitas. Setiap formula diracik oleh master perfumer bersertifikasi internasional menggunakan bahan baku olfaktori terbaik dari Grasse, Prancis, dan perkebunan eksotis nusantara.
            </p>
            <p class="text-xs sm:text-sm text-neutral-600 leading-relaxed font-light">
                Kami memilih konsentrasi <strong>Extrait de Parfum (30% - 40% fragrance oil)</strong> agar keharuman bertahan 12 hingga 16 jam di kulit dan pakaian Anda, menemani setiap babak penting dalam hidup Anda.
            </p>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-2xl border border-neutral-200">
            <img src="{{ asset('images/hero-sunforged.png') }}" alt="Sunforged Craftsmanship" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Values Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 pt-8 border-t border-neutral-200">
        <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm space-y-3 text-center">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mx-auto text-xl">✨</div>
            <h3 class="font-serif text-base font-bold text-neutral-900">Konsentrasi Ekstrak Murni</h3>
            <p class="text-xs text-neutral-500 leading-relaxed">Ketahanan 12-16+ jam dengan sillage mengesankan yang mengisi ruangan dengan lembut dan berkarakter.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm space-y-3 text-center">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mx-auto text-xl">🌿</div>
            <h3 class="font-serif text-base font-bold text-neutral-900">IFRA & Cruelty-Free</h3>
            <p class="text-xs text-neutral-500 leading-relaxed">Aman untuk kulit sensitif, bebas bahan berbahaya, dan tidak pernah diuji pada hewan (100% cruelty-free).</p>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-neutral-200 shadow-sm space-y-3 text-center">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center mx-auto text-xl">🎁</div>
            <h3 class="font-serif text-base font-bold text-neutral-900">Free Vial Discovery</h3>
            <p class="text-xs text-neutral-500 leading-relaxed">Setiap botol yang Anda pesan selalu disertai tester vial varian lain gratis untuk eksplorasi aroma berikutnya.</p>
        </div>
    </div>

</div>
@endsection

