<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Cek apakah yang klik "Buy" udah login?
        if (Auth::check()) {

            // Kalau udah login, simpan datanya!
            Order::create([
                'user_id' => Auth::id(), // Ini ngambil ID akun yang lagi login
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
            ]);

            // Balik lagi ke halaman menu bawa pesan sukses
            return redirect()->back()->with('success', 'Berhasil! Pesanan ' . $request->nama_produk . ' sedang diproses.');
        }

        // Kalau belum login, lempar ke halaman login
        return redirect('/login')->with('error', 'Kamu harus login dulu buat beli!');
    }
}