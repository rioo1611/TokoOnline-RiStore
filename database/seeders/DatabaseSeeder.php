<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin & Customer User
        User::updateOrCreate(
            ['email' => 'admin@mykonos.id'],
            [
                'name' => 'Mykonos Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Siti Rahmawati',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Categories
        $catSunforged = Category::create([
            'name' => 'Sunforged Collection',
            'slug' => 'sunforged-collection',
            'description' => 'Koleksi mahakarya Mykonos berbalut botol metalik mewah dengan konsentrasi Extrait de Parfum tingkat tinggi.',
            'image' => 'images/hero-sunforged.png',
            'badge' => 'Signature Line',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $catWanita = Category::create([
            'name' => 'Untuk Wanita (For Her)',
            'slug' => 'untuk-wanita',
            'description' => 'Eksplorasi wewangian feminin berkarakter manis vanila, buket bunga mawar eksotis, dan kelembutan bedak bayi mewah.',
            'image' => 'images/banner-untuknya.png',
            'badge' => 'Most Loved',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        $catPria = Category::create([
            'name' => 'Untuk Pria (For Him)',
            'slug' => 'untuk-pria',
            'description' => 'Aroma maskulin, karismatik dengan sentuhan rempah, kayu cedar, dan kesegaran sitrus mediterania.',
            'image' => 'images/product-imperium.png',
            'badge' => 'Gentlemen Choice',
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        $catUnisex = Category::create([
            'name' => 'Unisex Versatile',
            'slug' => 'unisex',
            'description' => 'Komposisi aroma adaptif yang memancarkan aura percaya diri untuk siapapun dan berbagai momen istimewa.',
            'image' => 'images/product-glitch.png',
            'badge' => 'Daily Drivers',
            'is_featured' => true,
            'sort_order' => 4,
        ]);

        $catDiscovery = Category::create([
            'name' => 'Discovery Sets & Vials',
            'slug' => 'discovery-set',
            'description' => 'Paket tester eksplorasi mini size untuk menemukan wewangian signature Anda sebelum membeli botol penuh.',
            'image' => 'images/hero-sunforged.png',
            'badge' => 'Try First',
            'is_featured' => false,
            'sort_order' => 5,
        ]);

        // 3. Products
        $products = [
            [
                'category_id' => $catUnisex->id,
                'name' => 'Mykonos x SetiawanAde - Glitch Extrait de Parfum 50ml & 100ml',
                'slug' => 'mykonos-x-setiawanade-glitch',
                'badge' => '-52%',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Gourmand Metallic Amber',
                'short_description' => 'Kolaborasi fenomenal dengan arsitektur aroma futuristik, perpaduan bergamot renyah, heliotrope, dan ambery tonka yang adiktif.',
                'description' => 'Glitch lahir dari imajinasi masa depan yang menembus batas olfaktori. Dibuka dengan sentuhan Italian Bergamot yang menyegarkan berpadu kilatan aldehid modern, kemudian bertransisi menjadi harmoni lavender lembut dan sentuhan metallic accord yang memikat. Dasarnya ditopang oleh Ambergris pekat, Tonka Bean manis hangat, dan Oakmoss yang memberikan ketahanan luar biasa hingga 14 jam.',
                'top_notes' => 'Italian Bergamot, Pink Pepper, Clean Aldehydes',
                'middle_notes' => 'French Lavender, Metallic Accord, Violet Leaf, Cedarwood',
                'base_notes' => 'Ambergris, Roasted Tonka Bean, Oakmoss, Clean White Musk',
                'longevity' => '12 - 14 Jam',
                'sillage' => 'Strong (Radius 2-3 Meter)',
                'projection' => 'Kuat & Mengisi Ruangan',
                'mood' => 'Futuristik, Percaya Diri, Magnetik, Misterius',
                'price' => 239000,
                'original_price' => 499000,
                'discount_percent' => 52,
                'stock' => 85,
                'is_sold_out' => false,
                'rating' => 4.9,
                'reviews_count' => 1420,
                'image' => 'images/product-glitch.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '50ml', 'price' => 239000, 'original_price' => 499000, 'stock' => 50, 'sku' => 'MYK-GLITCH-50'],
                    ['size' => '100ml', 'price' => 389000, 'original_price' => 699000, 'stock' => 35, 'sku' => 'MYK-GLITCH-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Aditya Pratama', 'rating' => 5, 'comment' => 'Parfum lokal terbaik yang pernah saya beli! Wanginya mewah banget, mirip niche perfume jutaan rupiah. Ketahanan 12 jam di baju masih kecium.', 'variant_size' => '100ml'],
                    ['customer_name' => 'Farhan Nugraha', 'rating' => 5, 'comment' => 'Diskon 52% langsung checkout tanpa mikir. Wangi Glitch ini khas banget, orang kantor pada nanya pake parfum apa.', 'variant_size' => '50ml'],
                    ['customer_name' => 'Jessica Tanuwijaya', 'rating' => 5, 'comment' => 'Beli buat kado pacar, tapi malah sering saya pake sendiri karena unisex dan baunya enak banget saat drydown!', 'variant_size' => '50ml'],
                ]
            ],
            [
                'category_id' => $catWanita->id,
                'name' => 'Mykonos - Royal Ispahan Extrait de Parfum 50ml & 100ml',
                'slug' => 'mykonos-royal-ispahan',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'women',
                'scent_family' => 'Floral Oriental Luxury',
                'short_description' => 'Kemegahan mawar Ispahan Persia berpadu kelembutan leci manis dan vanila Bourbon yang mewah.',
                'description' => 'Royal Ispahan adalah perwujudan keanggunan ratu istana timur. Mawar Damaskus terbaik dipadukan dengan manisnya buah leci ranum dan sentuhan dupa mistis. Pada fase akhir, Madagascar Vanilla dan Ambergris menyatu membentuk jejak aroma manis yang memabukkan dan tahan seharian penuh.',
                'top_notes' => 'Turkish Rose, Candied Lychee, Bergamot',
                'middle_notes' => 'Damascus Rose, Peony, Incense, Cedar',
                'base_notes' => 'Madagascar Vanilla, Light Oud, Ambergris, Cashmeran',
                'longevity' => '14 - 16 Jam',
                'sillage' => 'Enormous (Jejak aroma sangat panjang)',
                'projection' => 'Sangat Kuat',
                'mood' => 'Glamour, Romantis, Elegan, Berkelas',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 5.0,
                'reviews_count' => 890,
                'image' => 'images/product-royal-ispahan.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-ISPAHAN-50'],
                    ['size' => '100ml', 'price' => 649000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-ISPAHAN-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Clarissa Putri', 'rating' => 5, 'comment' => 'Kapan restock min? Wanginya beneran rose oud terenak se-Indonesia, gak nusuk hidung sama sekali.', 'variant_size' => '50ml'],
                    ['customer_name' => 'Dewi Anggraini', 'rating' => 5, 'comment' => 'Juara! Pakai ini buat kondangan malem, wanginya nempel sampe besok paginya.', 'variant_size' => '100ml'],
                ]
            ],
            [
                'category_id' => $catWanita->id,
                'name' => 'Mykonos - Baby Love EDP 50ml',
                'slug' => 'mykonos-baby-love-edp',
                'badge' => 'Terjual habis',
                'concentration' => 'Eau de Parfum',
                'gender' => 'women',
                'scent_family' => 'Soft Powdery Floral',
                'short_description' => 'Aroma kelembutan bedak bayi mewah nan menenangkan, bersih, hangat, dan membuat siapapun merasa nyaman.',
                'description' => 'Baby Love adalah wewangian nostaljik yang membawa ketenangan hati. Sentuhan bunga Violet dan Chamomile berpadu dengan bedak talek halus serta White Musk yang lembut seperti pelukan hangat di sore hari.',
                'top_notes' => 'Violet, Italian Mandarin, Soft Bergamot',
                'middle_notes' => 'Chamomile Blossoms, Turkish Rose, Iris Butter',
                'base_notes' => 'Warm Powdery Notes, White Musk, Vanilla Pods, Cedarwood',
                'longevity' => '8 - 10 Jam',
                'sillage' => 'Moderate & Intimate',
                'projection' => 'Lembut Menenangkan',
                'mood' => 'Comforting, Pure, Calming, Nostalgic',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 4.8,
                'reviews_count' => 640,
                'image' => 'images/product-baby-love.png',
                'is_featured' => false,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-BABYLOVE-50'],
                ],
                'reviews' => [
                    ['customer_name' => 'Nabila Syakieb', 'rating' => 5, 'comment' => 'Wangi bayi paling berkelas! Gak kayak minyak telon, tapi bener-bener parfum mahal.', 'variant_size' => '50ml'],
                ]
            ],
            [
                'category_id' => $catSunforged->id,
                'name' => 'Mykonos Sunforged - Imperium Extrait de Parfum',
                'slug' => 'mykonos-sunforged-imperium',
                'badge' => 'Signature Lion',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'men',
                'scent_family' => 'Citrus Woody Aromatic',
                'short_description' => 'Lambang keagungan Singa Emas, perpaduan sitrus segar bergamot Sisilia, rempah kapulaga, dan kayu cendana ningrat.',
                'description' => 'Imperium diciptakan untuk pria yang memimpin dengan kharisma alami. Botol emas bersimbol singa perkasa ini menyimpan kesegaran sitrus Mediterania di lapis awal, disusul kapulaga pedas hangat dan ditutup oleh kayu cendana serta amber kaya nuansa.',
                'top_notes' => 'Sicilian Bergamot, Calabrian Lemon, Zesty Grapefruit',
                'middle_notes' => 'French Lavender, Cardamom, Aquatic Accord, Pink Pepper',
                'base_notes' => 'Ambergris, Haitian Vetiver, Mysore Sandalwood, Oakmoss',
                'longevity' => '12 - 14 Jam',
                'sillage' => 'Strong',
                'projection' => 'Radius 2 Meter',
                'mood' => 'Pemimpin, Karismatik, Sukses, Berwibawa',
                'price' => 349000,
                'original_price' => 429000,
                'discount_percent' => 18,
                'stock' => 45,
                'is_sold_out' => false,
                'rating' => 4.9,
                'reviews_count' => 1120,
                'image' => 'images/product-imperium.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '50ml', 'price' => 349000, 'original_price' => 429000, 'stock' => 25, 'sku' => 'MYK-IMPERIUM-50'],
                    ['size' => '100ml', 'price' => 499000, 'original_price' => 599000, 'stock' => 20, 'sku' => 'MYK-IMPERIUM-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Bambang Soebroto', 'rating' => 5, 'comment' => 'Botol emasnya beneran berat dan mewah banget. Wanginya maskulin dan tahan dari pagi sampe malem di ruangan ber-AC.', 'variant_size' => '100ml'],
                ]
            ],
            [
                'category_id' => $catSunforged->id,
                'name' => 'Mykonos Sunforged - Inferno Extrait de Parfum',
                'slug' => 'mykonos-sunforged-inferno',
                'badge' => 'Bold Dragon',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'men',
                'scent_family' => 'Spicy Smoky Oriental',
                'short_description' => 'Kekuatan Naga Hitam yang menyala, ledakan saffron berasap, ceri hitam pekat, daun tembakau cerutu, dan kulit mewah.',
                'description' => 'Inferno adalah aroma api gairah malam yang mendebarkan. Perpaduan manis gelap Black Cherry dengan kepulan rempah saffron dan kayu manis, disempurnakan oleh kulit Tuscan dan Bourbon Vanilla yang sangat memikat.',
                'top_notes' => 'Smoked Saffron, Dark Black Cherry, Indonesian Nutmeg',
                'middle_notes' => 'Ceylon Cinnamon Bark, Rich Leather Accord, Sweet Tobacco Leaf',
                'base_notes' => 'Dark Agarwood (Oud), Roasted Amber, Bourbon Vanilla, Cedarwood',
                'longevity' => '14 - 18 Jam',
                'sillage' => 'Enormous & Deep',
                'projection' => 'Sangat Menusuk & Memikat',
                'mood' => 'Seksi, Misterius, Kuat, Berani',
                'price' => 359000,
                'original_price' => 450000,
                'discount_percent' => 20,
                'stock' => 30,
                'is_sold_out' => false,
                'rating' => 5.0,
                'reviews_count' => 980,
                'image' => 'images/product-inferno.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '50ml', 'price' => 359000, 'original_price' => 450000, 'stock' => 15, 'sku' => 'MYK-INFERNO-50'],
                    ['size' => '100ml', 'price' => 529000, 'original_price' => 650000, 'stock' => 15, 'sku' => 'MYK-INFERNO-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Rian Hidayat', 'rating' => 5, 'comment' => 'Ini parfum buat night out paling gokil. Baunya deep banget, leather dan cherry-nya balance sempurna.', 'variant_size' => '100ml'],
                ]
            ],
            [
                'category_id' => $catSunforged->id,
                'name' => 'Mykonos Sunforged - Marbella Extrait de Parfum',
                'slug' => 'mykonos-sunforged-marbella',
                'badge' => 'Rose Gold Phoenix',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'women',
                'scent_family' => 'Fruity Floral Gourmand',
                'short_description' => 'Keindahan burung Phoenix tembaga, pesta buah berry manis, nektar persik, dan lelehan krim karamel vanila.',
                'description' => 'Marbella menangkap kehangatan senja musim panas di pesisir Mediterania. Stroberi liar dan nektar peach bertemu dengan keharuman bunga melati dan peony, diakhiri dengan krim vanila kocok yang adiktif.',
                'top_notes' => 'Wild Strawberry, Sweet Raspberry, Spanish Peach Nectar',
                'middle_notes' => 'Pink Peony, Jasmine Sambac, Melted Caramel Sugar',
                'base_notes' => 'Whipped Vanilla Cream, White Amber, Soft Cedarwood',
                'longevity' => '12 - 14 Jam',
                'sillage' => 'Strong & Sweet',
                'projection' => 'Manis Semerbak',
                'mood' => 'Playful, Ceria, Mempesona, Manis Mewah',
                'price' => 349000,
                'original_price' => 429000,
                'discount_percent' => 18,
                'stock' => 40,
                'is_sold_out' => false,
                'rating' => 4.9,
                'reviews_count' => 1050,
                'image' => 'images/product-marbella.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 349000, 'original_price' => 429000, 'stock' => 20, 'sku' => 'MYK-MARBELLA-50'],
                    ['size' => '100ml', 'price' => 499000, 'original_price' => 599000, 'stock' => 20, 'sku' => 'MYK-MARBELLA-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Sarah Amalia', 'rating' => 5, 'comment' => 'Wangi gourmand manis tapi gak bikin pusing! Manisnya seger buah berry dulu baru keluar vanila karamelnya.', 'variant_size' => '50ml'],
                ]
            ],
            [
                'category_id' => $catSunforged->id,
                'name' => 'Mykonos Sunforged - Nautilus Extrait de Parfum',
                'slug' => 'mykonos-sunforged-nautilus',
                'badge' => 'Ocean Seahorse',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Marine Salty Fresh Aquatic',
                'short_description' => 'Kedalaman samudra dalam botol biru safir, butiran garam laut, daun sage, jeruk nipis, dan lumut laut segar.',
                'description' => 'Nautilus adalah hembusan angin samudra yang murni dan menyegarkan jiwa. Butiran garam laut yang renyah berpadu dengan mint dingin dan sage aromatik, didukung oleh kayu apung dan amber abu-abu yang elegan.',
                'top_notes' => 'Sea Salt Crystals, Oceanic Breeze, Crisp Garden Mint, Kaffir Lime',
                'middle_notes' => 'Sea Driftwood, Clary Sage, Mineral Amber, Cardamom',
                'base_notes' => 'Grey Ambergris, Blue Cypress, Sea Moss, Clean Musk',
                'longevity' => '10 - 12 Jam',
                'sillage' => 'Strong & Refreshing',
                'projection' => 'Segar & Bersih',
                'mood' => 'Bebas, Energik, Menyegarkan, Modern',
                'price' => 349000,
                'original_price' => 429000,
                'discount_percent' => 18,
                'stock' => 35,
                'is_sold_out' => false,
                'rating' => 4.8,
                'reviews_count' => 720,
                'image' => 'images/product-nautilus.png',
                'is_featured' => true,
                'is_popular' => false,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 349000, 'original_price' => 429000, 'stock' => 20, 'sku' => 'MYK-NAUTILUS-50'],
                    ['size' => '100ml', 'price' => 499000, 'original_price' => 599000, 'stock' => 15, 'sku' => 'MYK-NAUTILUS-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Dimas Arya', 'rating' => 5, 'comment' => 'Parfum aquatic terbaik saat cuaca panas terik. Tetap segar berjam-jam tanpa aroma apek.', 'variant_size' => '50ml'],
                ]
            ],
            [
                'category_id' => $catSunforged->id,
                'name' => 'Mykonos Sunforged - Untamed Extrait de Parfum',
                'slug' => 'mykonos-sunforged-untamed',
                'badge' => 'Wild Spirit',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Ambery Spicy Coffee Leather',
                'short_description' => 'Semangat kuda liar yang bebas, biji kopi arabika panggang, rum manis berumur, tonka bean, dan kayu cendana.',
                'description' => 'Untamed merefleksikan jiwa petualang yang tak kenal takut. Aroma seduhan kopi hitam pekat dengan sentuhan tetesan rum hangat dan blood orange segar, bertransformasi menjadi kehangatan kayu dan amber kristal yang menawan.',
                'top_notes' => 'Sicilian Blood Orange, Cardamom, Sweet Elemi Resin',
                'middle_notes' => 'Dark Roasted Arabica Coffee, Tonka Beans, Aged Dark Rum Accord',
                'base_notes' => 'Warm Australian Sandalwood, Dark Patchouli, Golden Amber',
                'longevity' => '14 - 16 Jam',
                'sillage' => 'Enormous',
                'projection' => 'Sangat Berkarakter',
                'mood' => 'Petualang, Liar, Hangat, Karismatik',
                'price' => 369000,
                'original_price' => 450000,
                'discount_percent' => 18,
                'stock' => 28,
                'is_sold_out' => false,
                'rating' => 4.9,
                'reviews_count' => 860,
                'image' => 'images/product-untamed.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '50ml', 'price' => 369000, 'original_price' => 450000, 'stock' => 14, 'sku' => 'MYK-UNTAMED-50'],
                    ['size' => '100ml', 'price' => 549000, 'original_price' => 650000, 'stock' => 14, 'sku' => 'MYK-UNTAMED-100'],
                ],
                'reviews' => [
                    ['customer_name' => 'Kevin Sanjaya', 'rating' => 5, 'comment' => 'Aroma kopi dan rum di Untamed ini beneran addictive banget. Kalau lewat orang pasti noleh.', 'variant_size' => '100ml'],
                ]
            ],
            [
                'category_id' => $catDiscovery->id,
                'name' => 'Mykonos - Ukuran Perjalanan 15ML Collection',
                'slug' => 'mykonos-ukuran-perjalanan-15ml',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Travel Discovery Set',
                'short_description' => 'Paket botol mini travel size 15ml praktis untuk dibawa bepergian, berisi varian terpopuler Mykonos.',
                'description' => 'Koleksi ukuran perjalanan 15ml yang sangat portabel untuk menemani aktivitas harian Anda. Tetap wangi semerbak di manapun Anda berada.',
                'top_notes' => 'Multi-notes varian terpilih',
                'middle_notes' => 'Harmoni floral dan rempah',
                'base_notes' => 'Ambergris & Vanilla',
                'longevity' => '12 Jam',
                'sillage' => 'Strong',
                'projection' => '2 Meter',
                'mood' => 'Praktis, Elegan, Versatile',
                'price' => 199000,
                'original_price' => 199000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 4.9,
                'reviews_count' => 520,
                'image' => 'images/product-travel-15ml.png',
                'is_featured' => false,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '15ml', 'price' => 199000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-TRV-15'],
                ],
            ],
            [
                'category_id' => $catWanita->id,
                'name' => 'Mykonos - Aphrodite Extrait de Parfum 50ml & 100ml',
                'slug' => 'mykonos-aphrodite',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'women',
                'scent_family' => 'Floral Woody Sensual',
                'short_description' => 'Pesona sang dewi cinta Aphrodite, sensualitas melati malam, kayu cendana, dan kehangatan amber mewah.',
                'description' => 'Aphrodite dirancang untuk wanita yang memancarkan pesona magnetik. Bunga melati eksotis berpadu kayu manis dan vanilla madu.',
                'top_notes' => 'Jasmine Sambac, Cinnamon Bark',
                'middle_notes' => 'Myrrh, Cedarwood, Warm Heliotrope',
                'base_notes' => 'Golden Amber, Bourbon Vanilla, Sandalwood',
                'longevity' => '14 - 16 Jam',
                'sillage' => 'Enormous',
                'projection' => 'Sangat Memikat',
                'mood' => 'Sensual, Menawan, Ratu Malam',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 5.0,
                'reviews_count' => 1100,
                'image' => 'images/product-aphrodite.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-APH-50'],
                    ['size' => '100ml', 'price' => 649000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-APH-100'],
                ],
            ],
            [
                'category_id' => $catWanita->id,
                'name' => 'Mykonos - Bonfire Vanilla Extrait de Parfum 50ml',
                'slug' => 'mykonos-bonfire-vanilla',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'women',
                'scent_family' => 'Smoky Sweet Vanilla Gourmand',
                'short_description' => 'Sensasi api unggun di malam dingin, vanila manis berasap yang hangat, lezat, dan memikat.',
                'description' => 'Bonfire Vanilla adalah wewangian gourmand unik yang memadukan kayu berasap dengan kemanisan vanila madu dan marshmallow panggang.',
                'top_notes' => 'Toasted Marshmallow, Pink Pepper',
                'middle_notes' => 'Smoked Guaiac Wood, Clove',
                'base_notes' => 'Bourbon Vanilla, Cashmere Wood, Amber',
                'longevity' => '14 - 16 Jam',
                'sillage' => 'Strong',
                'projection' => 'Hangat & Mengundang',
                'mood' => 'Cozy, Manis Hangat, Menggoda',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 4.9,
                'reviews_count' => 760,
                'image' => 'images/product-bonfire-vanilla.png',
                'is_featured' => false,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-BNF-50'],
                ],
            ],
            [
                'category_id' => $catUnisex->id,
                'name' => 'Mykonos - Kafe Tetes Extrait de Parfum 50ml',
                'slug' => 'mykonos-kafe-tetes',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Rich Coffee Gourmand',
                'short_description' => 'Aroma seduhan kopi tetes tradisional kental berpadu susu kental manis dan karamel hangat.',
                'description' => 'Kafe Tetes merefleksikan aroma kafe favorit di pagi hari. Kopi robusta pekat berpadu krim vanila dan gula aren lumer.',
                'top_notes' => 'Fresh Roasted Coffee, Condensed Milk Accord',
                'middle_notes' => 'Brown Sugar, Dark Chocolate, Cardamom',
                'base_notes' => 'Vanilla Bean, Cedarwood, Amber',
                'longevity' => '12 - 14 Jam',
                'sillage' => 'Strong',
                'projection' => 'Aromatik Lezat',
                'mood' => 'Warm, Energizing, Addictive',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 4.8,
                'reviews_count' => 690,
                'image' => 'images/product-kafe-tetes.png',
                'is_featured' => false,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-KAF-50'],
                ],
            ],
            [
                'category_id' => $catUnisex->id,
                'name' => 'Mykonos - California Blue Extrait de Parfum 50ml & 100ml',
                'slug' => 'mykonos-california-blue',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'unisex',
                'scent_family' => 'Fresh Citrus Aquatic Coastal',
                'short_description' => 'Kesegaran pantai California di musim panas, udara laut biru jernih, jeruk sitrus, dan kayu apung.',
                'description' => 'California Blue membawa Anda ke pantai Pasifik yang cerah. Hembusan angin samudra yang murni berpadu sitrus segar.',
                'top_notes' => 'Californian Lemon, Bergamot, Sea Spray',
                'middle_notes' => 'Lavender, Rosemary, Blue Sage',
                'base_notes' => 'Driftwood, White Musk, Mineral Amber',
                'longevity' => '12 - 14 Jam',
                'sillage' => 'Strong',
                'projection' => 'Segar & Bersih',
                'mood' => 'Summer, Fresh, Free Spirit',
                'price' => 449000,
                'original_price' => 449000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 4.9,
                'reviews_count' => 840,
                'image' => 'images/product-california-blue.png',
                'is_featured' => false,
                'is_popular' => true,
                'is_bestseller' => false,
                'variants' => [
                    ['size' => '50ml', 'price' => 449000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-CAL-50'],
                    ['size' => '100ml', 'price' => 649000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-CAL-100'],
                ],
            ],
            [
                'category_id' => $catWanita->id,
                'name' => 'Mykonos - Opera Hitam Extrait de Parfum 100ml',
                'slug' => 'mykonos-opera-hitam',
                'badge' => 'Terjual habis',
                'concentration' => 'Extrait de Parfum',
                'gender' => 'women',
                'scent_family' => 'Dark Floral Luxury',
                'short_description' => 'Kemewahan teater opera megah dalam botol kristal artistik, bunga putih eksotis, nilam gelap, dan ambergris.',
                'description' => 'Opera Hitam adalah mahakarya wewangian glamor untuk malam istimewa. Bunga melati putih bertemu kepekatan kopi hitam dan kayu nilam.',
                'top_notes' => 'Black Coffee, Pink Pepper, Orange Blossom',
                'middle_notes' => 'Jasmine Sambac, Bitter Almond, Licorice',
                'base_notes' => 'Dark Vanilla, Indonesian Patchouli, Cedar, Amber',
                'longevity' => '16+ Jam',
                'sillage' => 'Enormous',
                'projection' => 'Megah & Mewah',
                'mood' => 'Dramatic, Glamorous, Luxurious',
                'price' => 799000,
                'original_price' => 799000,
                'discount_percent' => null,
                'stock' => 0,
                'is_sold_out' => true,
                'rating' => 5.0,
                'reviews_count' => 1400,
                'image' => 'images/product-opera-hitam.png',
                'is_featured' => true,
                'is_popular' => true,
                'is_bestseller' => true,
                'variants' => [
                    ['size' => '100ml', 'price' => 799000, 'original_price' => null, 'stock' => 0, 'sku' => 'MYK-OPH-100'],
                ],
            ],
        ];

        foreach ($products as $pData) {
            $variants = $pData['variants'] ?? [];
            $reviews = $pData['reviews'] ?? [];
            unset($pData['variants'], $pData['reviews']);

            $product = Product::create($pData);

            foreach ($variants as $v) {
                $v['product_id'] = $product->id;
                ProductVariant::create($v);
            }

            foreach ($reviews as $r) {
                $r['product_id'] = $product->id;
                $r['is_verified_buyer'] = true;
                Review::create($r);
            }
        }

        // 4. Seed a Sample Order for Demo Dashboard
        $demoOrder = Order::create([
            'order_number' => 'MYK-20261019-001',
            'customer_name' => 'Rian Hidayat',
            'customer_email' => 'rian.hidayat@example.com',
            'customer_phone' => '081234567890',
            'shipping_address' => 'Jl. Senopati Raya No. 42, Kebayoran Baru',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'postal_code' => '12190',
            'courier' => 'SiCepat BEST (1 Hari Sampai)',
            'subtotal' => 598000,
            'shipping_cost' => 0,
            'discount' => 50000,
            'total' => 548000,
            'payment_method' => 'QRIS Instant (GoPay/ShopeePay/BCA)',
            'payment_status' => 'paid',
            'status' => 'processing',
            'tracking_number' => 'SCP-9921827102',
            'notes' => 'Mohon sertakan vial tester Glitch & Imperium ya min.',
        ]);

        $glitch = Product::where('slug', 'mykonos-x-setiawanade-glitch')->first();
        if ($glitch) {
            OrderItem::create([
                'order_id' => $demoOrder->id,
                'product_id' => $glitch->id,
                'product_name' => $glitch->name,
                'variant_size' => '50ml',
                'product_image' => $glitch->image,
                'price' => 239000,
                'quantity' => 1,
                'subtotal' => 239000,
            ]);
        }

        $inferno = Product::where('slug', 'mykonos-sunforged-inferno')->first();
        if ($inferno) {
            OrderItem::create([
                'order_id' => $demoOrder->id,
                'product_id' => $inferno->id,
                'product_name' => $inferno->name,
                'variant_size' => '50ml',
                'product_image' => $inferno->image,
                'price' => 359000,
                'quantity' => 1,
                'subtotal' => 359000,
            ]);
        }
    }
}
