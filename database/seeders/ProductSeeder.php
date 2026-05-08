<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data lama biar nggak duplikat pas di-run ulang
        Product::truncate();
        DB::table('recommendations')->truncate();

        // 2. ISI TABEL RECOMMENDATIONS (3 Menu Landing Page)
        DB::table('recommendations')->insert([
            [
                'nama' => 'Udang Keju',
                'gambar' => 'UdangKeju.png',
            ],
            [
                'nama' => 'Mie Ayam Bakso',
                'gambar' => 'MieAyam.png',
            ],
            [
                'nama' => 'Es Dawet Durian (Jumbo)', 
                'gambar' => 'EsDawet.png',
            ],
        ]);

        // 3. ISI TABEL PRODUCTS (24 Menu Berdasarkan Desain Kamu)
        // 3. ISI TABEL PRODUCTS (Cuma 2 menu yang beneran diskon!)
        $daftar_produk = [
            // --- KATEGORI: ES DURIAN (Gak ada diskon) ---
            ['kategori' => 'es-durian', 'nama' => 'Es Durian Original', 'deskripsi' => 'Daging durian montong, susu kental manis, es serut lembut, dan sirup gula aren.', 'harga_lama' => '0', 'harga_baru' => '15000', 'gambar' => 'EsDurianOri.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],
            ['kategori' => 'es-durian', 'nama' => 'Es Durian Coklat', 'deskripsi' => 'Perpaduan durian montong dengan lumeran coklat premium dan es serut.', 'harga_lama' => '0', 'harga_baru' => '17000', 'gambar' => 'EsDurianCoklat.png', 'warna_bg' => '#795548', 'is_promo' => 0],
            ['kategori' => 'es-durian', 'nama' => 'Es Durian Oreo', 'deskripsi' => 'Durian dengan topping remahan Oreo yang crunchy, susu vanilla, dan es serut.', 'harga_lama' => '0', 'harga_baru' => '18000', 'gambar' => 'EsDurianOreo.png', 'warna_bg' => '#212121', 'is_promo' => 0],
            ['kategori' => 'es-durian', 'nama' => 'Es Durian Mix Buah', 'deskripsi' => 'Durian campur mangga, nangka, alpukat, dan jelly. Segar dan manis!', 'harga_lama' => '0', 'harga_baru' => '20000', 'gambar' => 'EsDurianMix.png', 'warna_bg' => '#FF5722', 'is_promo' => 0],
            ['kategori' => 'es-durian', 'nama' => 'Es Durian Keju', 'deskripsi' => 'Daging durian montong dengan taburan keju parut melimpah dan susu kental manis.', 'harga_lama' => '0', 'harga_baru' => '17000', 'gambar' => 'EsDurianKeju.png', 'warna_bg' => '#FFEB3B', 'is_promo' => 0],

            // --- KATEGORI: MIE AYAM (Cuma Jamur yang diskon) ---
            ['kategori' => 'mie-ayam', 'nama' => 'Mie Ayam Biasa', 'deskripsi' => 'Mie kenyal dengan topping ayam manis gurih dan sawi hijau segar.', 'harga_lama' => '0', 'harga_baru' => '12000', 'gambar' => 'MieAyamBiasa.png', 'warna_bg' => '#F44336', 'is_promo' => 0],
            ['kategori' => 'mie-ayam', 'nama' => 'Mie Ayam Ceker', 'deskripsi' => 'Mie kenyal dengan topping ayam manis gurih, ceker empuk, dan sawi hijau segar.', 'harga_lama' => '0', 'harga_baru' => '14000', 'gambar' => 'MieAyamCeker.png', 'warna_bg' => '#F44336', 'is_promo' => 0],
            ['kategori' => 'mie-ayam', 'nama' => 'Mie Ayam Pangsit', 'deskripsi' => 'Mie ayam lengkap dengan tambahan pangsit rebus atau goreng yang renyah.', 'harga_lama' => '0', 'harga_baru' => '15000', 'gambar' => 'MieAyamPangsit.png', 'warna_bg' => '#F44336', 'is_promo' => 0],
            ['kategori' => 'mie-ayam', 'nama' => 'Mie Ayam Bakso', 'deskripsi' => 'Mie ayam pangsit dengan bakso urat sapi asli yang kenyal dan gurih.', 'harga_lama' => '0', 'harga_baru' => '20000', 'gambar' => 'MieAyam.png', 'warna_bg' => '#F44336', 'is_promo' => 0],
            // INI DISKON!
            ['kategori' => 'mie-ayam', 'nama' => 'Mie Ayam Jamur', 'deskripsi' => 'Mie ayam disajikan dengan tumisan jamur tiram dan ayam berbumbu harum.', 'harga_lama' => '16000', 'harga_baru' => '12000', 'gambar' => 'MieAyamJamur.png', 'warna_bg' => '#F44336', 'is_promo' => 1],

            // --- KATEGORI: ES DAWET (Gak ada diskon) ---
            ['kategori' => 'es-dawet', 'nama' => 'Dawet Durian Reguler', 'deskripsi' => 'Es Dawet premium + durian daging + durian biji + cincau + Gula aren organik.', 'harga_lama' => '0', 'harga_baru' => '38000', 'gambar' => 'DawetDurianReguler.png', 'warna_bg' => '#4CAF50', 'is_promo' => 0],
            ['kategori' => 'es-dawet', 'nama' => 'Dawet Durian Jumbo', 'deskripsi' => 'Porsi Jumbo! Es Dawet premium + durian daging + durian biji + cincau + Gula aren.', 'harga_lama' => '0', 'harga_baru' => '42000', 'gambar' => 'DawetDurianJumbo.png', 'warna_bg' => '#4CAF50', 'is_promo' => 0],
            ['kategori' => 'es-dawet', 'nama' => 'Dawet Original Reguler', 'deskripsi' => 'Es Dawet premium + cincau + Gula aren organik + Creamer premium + Nangka + ketan.', 'harga_lama' => '0', 'harga_baru' => '25000', 'gambar' => 'DawetOriginalReguler.png', 'warna_bg' => '#4CAF50', 'is_promo' => 0],
            ['kategori' => 'es-dawet', 'nama' => 'Dawet Original Jumbo', 'deskripsi' => 'Porsi Jumbo! Es Dawet premium + cincau + Gula aren organik + Creamer premium.', 'harga_lama' => '0', 'harga_baru' => '29000', 'gambar' => 'DawetOriginalJumbo.png', 'warna_bg' => '#4CAF50', 'is_promo' => 0],

            // --- KATEGORI: CEMILAN (Gak ada diskon) ---
            ['kategori' => 'cemilan', 'nama' => 'Kentang Goreng', 'deskripsi' => 'Hidangan cemilan populer yang terbuat dari kentang goreng renyah dan gurih.', 'harga_lama' => '0', 'harga_baru' => '10000', 'gambar' => 'KentangGoreng.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],
            ['kategori' => 'cemilan', 'nama' => 'Jamur Krispi', 'deskripsi' => 'Cemilan dari jamur tiram, dilapisi adonan tepung lalu digoreng hingga renyah.', 'harga_lama' => '0', 'harga_baru' => '12000', 'gambar' => 'JamurKrispi.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],
            ['kategori' => 'cemilan', 'nama' => 'Udang Keju', 'deskripsi' => 'Hidangan dimsum yang populer, dibuat dari campuran udang dengan isian keju lumer.', 'harga_lama' => '0', 'harga_baru' => '15000', 'gambar' => 'UdangKeju.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],
            ['kategori' => 'cemilan', 'nama' => 'Pisang Goreng', 'deskripsi' => 'Cemilan dari irisan pisang raja yang digoreng dalam balutan adonan manis renyah.', 'harga_lama' => '0', 'harga_baru' => '8500', 'gambar' => 'PisangGoreng.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],
            ['kategori' => 'cemilan', 'nama' => 'Pangsit Goreng', 'deskripsi' => 'Hidangan cemilan dari adonan tepung terigu berisi daging cincang renyah.', 'harga_lama' => '0', 'harga_baru' => '8000', 'gambar' => 'PangsitGoreng.png', 'warna_bg' => '#FFC107', 'is_promo' => 0],

            // --- KATEGORI: ES TELER (Cuma Es Teler Durian Reguler yang diskon) ---
            // INI DISKON!
            ['kategori' => 'es-teler', 'nama' => 'Es Teler Durian', 'deskripsi' => 'Rasakan sensasi mewahnya durian asli berpadu dengan alpukat dan nangka.', 'harga_lama' => '25000', 'harga_baru' => '20000', 'gambar' => 'EsTeler.png', 'warna_bg' => '#44AD24', 'is_promo' => 1],
            ['kategori' => 'es-teler', 'nama' => 'Es Teler Durian (Jumbo)', 'deskripsi' => 'Porsi Jumbo! Variasi es teler tradisional dengan potongan daging buah durian.', 'harga_lama' => '0', 'harga_baru' => '29500', 'gambar' => 'EsTelerDurianJumbo.png', 'warna_bg' => '#44AD24', 'is_promo' => 0],
            ['kategori' => 'es-teler', 'nama' => 'Es Teler Reguler', 'deskripsi' => 'Es teler tradisional dengan isian lengkap buah-buahan segar manis dan legit.', 'harga_lama' => '0', 'harga_baru' => '22000', 'gambar' => 'EsTelerReguler.png', 'warna_bg' => '#44AD24', 'is_promo' => 0],
            ['kategori' => 'es-teler', 'nama' => 'Es Teler Jumbo', 'deskripsi' => 'Porsi Jumbo! Es teler tradisional dengan isian lengkap buah-buahan segar.', 'harga_lama' => '0', 'harga_baru' => '26500', 'gambar' => 'EsTelerJumbo.png', 'warna_bg' => '#44AD24', 'is_promo' => 0],
            ['kategori' => 'es-teler', 'nama' => 'Es Teler Alpukat', 'deskripsi' => 'Perpaduan Buah Alpukat Premium Dengan Creamer Khas Sultan yang dikocok.', 'harga_lama' => '0', 'harga_baru' => '23500', 'gambar' => 'EsTelerAlpukat.png', 'warna_bg' => '#44AD24', 'is_promo' => 0],
        ];
        // Masukkan semua data ke tabel products
        DB::table('products')->insert($daftar_produk);
    }
}