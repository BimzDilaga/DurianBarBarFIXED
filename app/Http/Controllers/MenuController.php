<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Recommendation; 
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // 1. Fungsi untuk halaman utama (welcome.blade.php)
 public function index()
{
    // Mengambil semua produk untuk slider atas
    $products = \App\Models\Product::all();
    
    // Kita ambil data Udang Keju (ID 8) dkk LANGSUNG dari tabel products
    // Supaya $rec->id nilainya 8, bukan 1.
    $recommendations = \App\Models\Product::whereIn('id', [8, 1, 2])->get(); 
    
    return view('welcome', compact('products', 'recommendations'));
}
    // 2. Fungsi untuk halaman list kategori (es durian, mie ayam, dll)
    // Posisinya HARUS DI DALAM class MenuController (sebelum kurung penutup paling bawah)
   public function showByCategory($kategori)
    {
        $products = Product::where('kategori', $kategori)->get();
        $title = ucwords(str_replace('-', ' ', $kategori));

        return view('menu.category', compact('products', 'title'));
    } // <--- NAH INI YANG KETINGGALAN BOS!

    public function show($id)
    {
        // Cari produk berdasarkan ID
        $product = \App\Models\Product::findOrFail($id);

        // Kirim data produk ke halaman detail
        return view('detail', compact('product'));
    }

    public function checkout($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('checkout', compact('product'));
}

} // <--- NAH, KURUNG KURAWAL PENUTUP CLASS ITU HARUSNYA CUMA ADA DI PALING BAWAH SINI