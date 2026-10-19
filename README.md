# 👑 MYKONOS Official Parfums — Luxury E-Commerce Web Application

Aplikasi web toko online resmi **MYKONOS Haute Parfumerie & Extrait de Parfum**, dibangun secara profesional menggunakan **Laravel 13** dan **PHP 8.3** (Laragon), terintegrasi dengan database, katalog interaktif, keranjang belanja session/drawer, alur checkout lengkap, invoice receipt, dan dashboard admin toko.

Desain visual dan pengalaman pengguna dirancang mengikuti standar estetika mewah dari situs resmi [officialmykonos.com](https://officialmykonos.com).

---

## ✨ Fitur Utama Aplikasi

### 1. 🌟 Desain & Pengalaman Mewah (Haute Parfumerie UI)
* **Announcement Marquee Ticker**: Bar promosi berjalan di bagian paling atas: *"FREE VIALS FOR EVERY PURCHASE • GRATIS ONGKIR SE-INDONESIA • 100% ORIGINAL OFFICIAL STORE"*.
* **Header & Navigasi Eksklusif**: Logo khas *MYKONOS* dengan tipografi serif klasik (*Cinzel* & *Playfair Display*), menu RUMAH, PRODUK, SUNFORGED, TENTANG KAMI, KONTAK, tombol pencarian langsung, akun, dan indikator keranjang dinamis.
* **Hero Carousel Slider**: Menampilkan *Sunforged Collection* (Imperium, Inferno, Marbella, Nautilus, Untamed), *Glitch Extrait de Parfum*, dan koleksi feminin *Untuknya*.
* **Pillars of Excellence**: Garansi 100% Original, Ketahanan 14+ Jam (Extrait de Parfum), Free Tester Vials di setiap order, dan Garansi 100% Pecah diganti baru.

### 2. 🛍️ Katalog Produk & Filter Pintar
* **Tabs "Penjualan! Paling Populer"**: Filter cepat produk diskon (Glitch -52%) dan produk terpopuler.
* **Showcase "Untuknya" & "Untuk Pria"**: Kurasi wewangian wanita (Royal Ispahan, Baby Love, Marbella) dan pria/unisex.
* **Filter Multi-Kriteria**: Berdasarkan Kategori, Target Gender (Pria, Wanita, Unisex), Fragrance Family (Gourmand, Woody, Floral, Fresh Aquatic), dan Rentang Harga.
* **Live Quick View Modal**: Modal pratinjau cepat tanpa meninggalkan halaman untuk memeriksa notes wewangian dan langsung menambahkan ke keranjang.

### 3. 🧪 Halaman Detail Produk (Product Detail Page - PDP)
* **Pilihan Varian Botol Interaktif**: Pilihan ukuran 50ml dan 100ml dengan kalkulasi harga dan stok otomatis (Alpine.js).
* **Piramida Olfaktori (Fragrance Notes)**:
  * **Top Notes**: Aroma pembuka (15–30 menit pertama)
  * **Heart / Middle Notes**: Karakter inti wewangian (2–4 jam)
  * **Base Notes**: Jejak aroma penutup mewah (12–16+ jam)
* **Indikator Performa**: Visual meter untuk *Longevity* (Ketahanan) dan *Sillage* (Pancaran Jejak Aroma).
* **Ulasan Pembeli Terverifikasi**: Rating bintang dan testimoni asli pembeli.

### 4. 🛒 Keranjang Belanja & Slide-over Drawer
* **Slide-over Ajax Cart Drawer**: Keranjang geser samping instan saat menambah produk tanpa reload halaman.
* **Free Shipping Progress Bar**: Indikator dinamis belanja menuju target Gratis Ongkir Se-Indonesia (min. Rp 500.000).
* **Kontrol Kuantitas**: Tambah, kurang, dan hapus item langsung secara real-time.

### 5. 💳 Checkout & Bukti Pesanan (Invoice Receipt)
* **Formulir Pengiriman Lengkap**: Nama, WhatsApp, Email, Alamat Lengkap, Kota, Provinsi, dan Kode Pos.
* **Pilihan Ekspedisi**: SiCepat BEST, JNE Express REG, J&T Express.
* **Metode Pembayaran Lengkap**: QRIS Instant (GoPay/ShopeePay/BCA Mobile), BCA Virtual Account, Mandiri, Transfer Bank.
* **Sistem Voucher Promo**: Dukungan kode promo (misal: `MYKONOSVIP`, `FREEONGKIR`).
* **Halaman Konfirmasi Pesanan**:
  * Nomor order unik (contoh: `MYK-20261019-XXXXX`)
  * Kode QRIS pembayaran instan
  * Timeline status pesanan (Diterima ➔ Dikemas ➔ Di Kurir ➔ Terkirim)
  * **Tombol Konfirmasi Otomatis ke WhatsApp Admin CS**.

### 6. 📊 Admin Management Panel (`/admin`)
* **Dashboard Metrik**: Total Pendapatan, Total Pesanan Masuk, Total Katalog Produk, dan Peringatan Stok Menipis.
* **Kelola Pesanan**: Pembaruan status pesanan (*Pending*, *Processing*, *Shipped*, *Completed*, *Cancelled*) dan penambahan nomor resi pengiriman kurir.
* **Kelola Katalog Parfum**: Tambah wewangian baru, pengaturan harga, stok, konsentrasi, piramida notes, dan gender.

---

## 🗄️ Arsitektur Database

Sistem database dirancang fleksibel dan kompatibel untuk **SQLite** (bawaan tanpa setup) maupun **MySQL** (Laragon):

| Tabel | Keterangan |
| :--- | :--- |
| `categories` | Kategori utama (*Sunforged*, *Untuk Wanita*, *Untuk Pria*, *Unisex*, *Discovery Set*) |
| `products` | Katalog parfum, deskripsi, olfactory notes, performa longevity/sillage, harga, diskon, stok |
| `product_variants` | Varian ukuran botol (50ml, 100ml) dengan harga dan stok terpisah |
| `orders` | Rekam pesanan, data pembeli, alamat, kurir, metode pembayaran, dan status transaksi |
| `order_items` | Rincian produk dan varian yang dibeli dalam setiap order |
| `reviews` | Testimoni dan rating bintang dari pembeli terverifikasi |
| `users` | Akun administrator dan pelanggan |

> 💡 **File Dump SQL Siap Pakai**: Tersedia file siap impor di [`database/mykonos_store.sql`](file:///c:/laragon/www/TokoOnline-RiStore/database/mykonos_store.sql).

---

## 🚀 Panduan Menjalankan Proyek di Laragon / Lokal

### Prasyarat
- PHP >= 8.2 (Direkomendasikan PHP 8.3)
- Composer
- Laragon atau Web Server lokal (Apache / Nginx / PHP Built-in Server)

### Langkah Instalasi

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/rioo1611/TokoOnline-RiStore.git
   cd TokoOnline-RiStore
   ```

2. **Pengaturan File Environment**:
   Salin `.env.example` ke `.env`:
   ```bash
   copy .env.example .env
   ```

3. **Install Dependensi Composer (jika diperlukan)**:
   ```bash
   composer install
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Jalankan Migrasi & Seeder Database**:
   ```bash
   php artisan migrate --seed
   ```
   *Perintah ini akan membuat semua tabel dan mengisi data resmi parfum Mykonos beserta ulasan awal.*

6. **Jalankan Server**:
   Jika menggunakan Laragon:
   - Akses via browser: `http://tokoonline-ristore.test`
   
   Atau via Artisan CLI:
   ```bash
   php artisan serve
   ```
   Akses di: `http://localhost:8000`

---

## 🔐 Akun Akses Default

* **Admin Panel**: Akses URL `/admin`
* **Email Admin**: `admin@mykonos.id`
* **Password**: `password123`

---

## 💎 Koleksi Parfum yang Tersedia di Database
1. **Mykonos x SetiawanAde - Glitch Extrait de Parfum** (Diskon 52%, Aroma Futuristik Metallic Bergamot & Ambergris)
2. **Mykonos - Royal Ispahan Extrait de Parfum** (Damascus Rose & Lychee Bourbon Vanilla)
3. **Mykonos - Baby Love EDP** (Soft Powdery Violet & Calming Musky)
4. **Mykonos Sunforged - Imperium** (Gold Bottle - Lion Crest, Citrus Woody Aromatic)
5. **Mykonos Sunforged - Inferno** (Black Bottle - Dragon Crest, Smoky Saffron & Cherry Tobacco)
6. **Mykonos Sunforged - Marbella** (Rose Gold Bottle - Phoenix Crest, Sweet Berry & Caramel)
7. **Mykonos Sunforged - Nautilus** (Navy Blue Bottle - Seahorse Crest, Marine Salty Fresh)
8. **Mykonos Sunforged - Untamed** (Champagne Bottle - Wild Stallion Crest, Roasted Coffee & Dark Rum)

---

## 📜 Lisensi & Hak Cipta
Hak cipta konsep merek parfum milik Official Mykonos. Proyek kode web dikembangkan untuk project e-commerce profesional berbasis Laravel 13.
