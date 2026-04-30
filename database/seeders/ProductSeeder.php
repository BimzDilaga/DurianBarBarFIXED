<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
   public function run(): void
{
    // Ini buat hapus data lama biar nggak numpuk pas di-refresh
    \App\Models\Product::truncate();
    \Illuminate\Support\Facades\DB::table('recommendations')->truncate();

    // MASUKKAN SEMUA MENU DI SINI
    \Illuminate\Support\Facades\DB::table('recommendations')->insert([
        [
            'nama' => 'Udang Keju',
            'gambar' => 'UdangKeju.png',
            'link' => '#',
        ],
        [
            'nama' => 'Mie Ayam Bakso',
            'gambar' => 'MieAyam.png',
            'link' => '#',
        ],
        [
            'nama' => 'Es Dawet Durian (Jumbo)', // Menu yang tadi hilang, tulis lagi di sini
            'gambar' => 'EsDawet.png',
            'link' => '#',
        ],
    ]);
}
}