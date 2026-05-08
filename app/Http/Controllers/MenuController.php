<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // WAJIB DITAMBAH: Biar bisa manggil tabel recommendations

class MenuController extends Controller
{
    // ==========================================
    // 1. HALAMAN HOME (Landing Page)
    // ==========================================
    public function index()
    {
        $products = Product::all();
        // Sedot data dari tabel recommendations hasil seeder tadi (bukan hardcode ID lagi)
        $recommendations = DB::table('recommendations')->get(); 
        
        return view('welcome', compact('products', 'recommendations'));
    }

    // ==========================================
    // 2. HALAMAN SEMUA MENU (Berdasarkan Kategori)
    // ==========================================
    // ==========================================
    // 2. HALAMAN SEMUA MENU (Berdasarkan Kategori)
    // ==========================================
    public function halamanMenu()
    {
        $menus = Product::all()->groupBy('kategori');
        
        // INI YANG DIGANTI: Tambahin .index biar dia nyari ke dalam folder menu
        return view('menu.index', compact('menus')); 
    }
    // ==========================================
    // 3. HALAMAN SPESIFIK 1 KATEGORI (Yang Tadi Sempat Hilang)
    // ==========================================
    public function showByCategory($kategori)
    {
        $products = Product::where('kategori', $kategori)->get();
        $title = ucwords(str_replace('-', ' ', $kategori));
        return view('menu.category', compact('products', 'title'));
    }

    // ==========================================
    // 4. HALAMAN DETAIL PRODUK
    // ==========================================
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('detail', compact('product'));
    }

    // ==========================================
    // 5. FITUR KERANJANG (CART) & CHECKOUT
    // ==========================================
    public function beli($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "nama" => $product->nama,
                "gambar" => $product->gambar,
                "harga_baru" => $product->harga_baru,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        
        // Setelah klik beli, langsung lari ke halaman checkout
        return redirect()->route('checkout');
    }

    public function kurang($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                // Kalau cuma 1 terus dikurang, hapus dari keranjang
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('checkout');
    }

    public function checkout() 
    {
        return view('checkout');
    }

    
}