<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // Sesuaikan ID ini dengan data di database kamu untuk rekomendasi
        $recommendations = Product::whereIn('id', [8, 1, 2])->get(); 
        return view('welcome', compact('products', 'recommendations'));
    }

    // INI DIA YANG TADI HILANG BIAR GAK EROR LAGI
    public function showByCategory($kategori)
    {
        $products = Product::where('kategori', $kategori)->get();
        $title = ucwords(str_replace('-', ' ', $kategori));
        return view('menu.category', compact('products', 'title'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('detail', compact('product'));
    }

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