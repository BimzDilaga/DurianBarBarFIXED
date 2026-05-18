<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    // 1. Fungsi untuk nampilin halaman checkout biasa (Saat klik "Lanjut Checkout" di keranjang)
    public function index()
    {
        return view('checkout');
    }

    // 2. Fungsi untuk memproses data dari keranjang ke Midtrans (Saat klik "PROSES PEMBAYARAN")
    public function process(Request $request)
    {
        // Tangkap data keranjang dari input hidden Javascript
        $dataKeranjang = json_decode($request->data_keranjang, true);

        // Pencegahan kalau user nekat klik bayar tapi keranjangnya kosong
        if (!$dataKeranjang || count($dataKeranjang) == 0) {
            return redirect('/menu')->with('error', 'Keranjang kamu masih kosong, jajan dulu yuk!');
        }

        // Konfigurasi Midtrans dari file .env
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Siapkan variabel untuk nampung total harga dan detail barang
        $item_details = [];
        $gross_amount = 0;

        // Looping (Urai) isi keranjang dari Javascript untuk dimasukkan ke format Midtrans
        foreach ($dataKeranjang as $item) {
            $item_details[] = [
                'id'       => $item['id'],
                'price'    => $item['price'],
                'quantity' => $item['qty'],
                'name'     => substr($item['name'], 0, 50) // Nama barang max 50 huruf buat Midtrans
            ];
            // Hitung total harga otomatis
            $gross_amount += ($item['price'] * $item['qty']);
        }

        // Siapin data pesanan utuh buat dikirim ke Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id'     => 'ORDER-' . time() . '-' . rand(100, 999), // Bikin ID pesanan unik pakai waktu
                'gross_amount' => $gross_amount, // Menggunakan total harga yang dihitung di atas
            ),
            'item_details' => $item_details, // Menggunakan barang-barang dari keranjang
            'customer_details' => array(
                // Nanti ini bisa kamu ubah ngambil dari data user yang login: Auth::user()->name dll
                'first_name' => 'Pelanggan', 
                'last_name'  => 'Bar Bar',
                'email'      => 'pelanggan@barbarduren.com',
                'phone'      => '08111222333',
            ),
        );

        // Minta Snap Token ke Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Kirim tokennya ke halaman checkout buat nampilin pop-up pembayaran
        return view('checkout', ['snapToken' => $snapToken]);
    }
}