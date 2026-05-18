<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class MenuController extends Controller
{
    // ==========================================
    // 1. HALAMAN HOME (Landing Page)
    // ==========================================
    public function index()
    {
        // Kita ambil semua produk untuk slider/keperluan lain
        $products = Product::all();

        // Kita ambil 3 produk terbaru untuk bagian "Recommendation"
        // Kita gunakan alias (AS) agar nama kolomnya cocok dengan file welcome.blade.php
        $recommendations = Product::select('id', 'nama as name', 'gambar as image', 'harga_baru')
                                    ->latest()
                                    ->take(3)
                                    ->get(); 
        
        return view('welcome', compact('products', 'recommendations'));
    }

    // ==========================================
    // 2. HALAMAN SEMUA MENU (Berdasarkan Kategori)
    // ==========================================
    public function halamanMenu()
    {
        // Mengelompokkan menu berdasarkan kategori (Minuman, Makanan, dll)
        $menus = Product::all()->groupBy('kategori');
        
        return view('menu.index', compact('menus')); 
    }

    // ==========================================
    // 3. HALAMAN SPESIFIK 1 KATEGORI
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
        // Jika ID tidak ketemu, otomatis lari ke halaman 404
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

        // Jika produk sudah ada di keranjang, tambah jumlahnya
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika belum ada, masukkan data baru
            $cart[$id] = [
                "id" => $product->id,
                "nama" => $product->nama,
                "gambar" => $product->gambar,
                "harga_baru" => $product->harga_baru,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        
        return redirect()->route('checkout');
    }

    public function kurang($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('checkout');
    }

    // ==========================================
    // 6. FITUR CHECKOUT (MIDTRANS)
    // ==========================================
    public function checkout()
    {
        $cart = session('cart');
        
        // Kalau keranjang kosong, lempar balik ke menu
        if (!$cart || count($cart) == 0) {
            return redirect('/menu');
        }

        // Hitung total harga
        $totalHarga = 0;
        foreach ($cart as $id => $details) {
            $totalHarga += $details['harga_baru'] * $details['quantity'];
        }

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Siapin data pesanan untuk Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => 'BARBAR-' . rand(), 
                'gross_amount' => $totalHarga, 
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->no_hp,
            ),
        );

        // Bikin Token Snap Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Kirim token ke view checkout
        return view('checkout', compact('totalHarga', 'snapToken'));
    }
}