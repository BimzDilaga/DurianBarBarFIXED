<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Konfigurasi Midtrans dari file .env
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // 2. Siapin data pesanan (Nanti datanya ambil dari database/keranjang pesanan asli ya bos)
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(), // Bikin ID pesanan acak buat contoh
                'gross_amount' => 25000, // Total harga
            ),
            'item_details' => array(
                array(
                    'id' => 'ITEM1',
                    'price' => 25000,
                    'quantity' => 1,
                    'name' => 'Es Durian Bar Bar'
                )
            ),
            'customer_details' => array(
                'first_name' => 'Bima',
                'last_name' => 'Sakti',
                'email' => 'bima@example.com',
                'phone' => '08111222333',
            ),
        );

        // 3. Minta Snap Token ke Midtrans
        $snapToken = Snap::getSnapToken($params);

        // 4. Kirim tokennya ke halaman checkout
        return view('checkout', ['snapToken' => $snapToken]);
    }
}