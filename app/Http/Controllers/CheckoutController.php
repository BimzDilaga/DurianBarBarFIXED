<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; 
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $displayItems = [];
        $isBuyNow = false;
        $buyNowData = null;

        // ==============================================================
        // 1. CEK APAKAH INI DARI TOMBOL "BELI SEKARANG"
        // ==============================================================
        if ($request->has('action') && $request->action == 'buy_now' && $request->has('product_id')) {
            
            $product = Product::find($request->product_id);
            
            if (!$product) {
                $product = (object) [
                    'id' => $request->product_id,
                    'nama' => 'Produk Testing (ID Tidak Ada Di DB)',
                    'harga_baru' => 10000,
                    'harga' => 10000,
                    'gambar' => 'Logo.png' 
                ];
            }

            $buyNowData = [
                [
                    'id'    => $product->id,
                    'name'  => $product->nama,
                    'price' => $product->harga_baru ?? $product->harga, 
                    'qty'   => 1,
                    'image' => asset('image/' . $product->gambar) 
                ]
            ];
            
            $displayItems = [
                $product->id => [
                    'id' => $product->id,
                    'nama' => $product->nama,
                    'harga_baru' => $product->harga_baru ?? $product->harga,
                    'quantity' => 1,
                    'gambar' => $product->gambar
                ]
            ];
            
            $isBuyNow = true;

        } 
        // ==============================================================
        // 2. TANGKAP DATA DARI POP-UP KERANJANG NAVBAR (POST cart_data)
        // ==============================================================
        elseif ($request->has('cart_data')) {
            $parsedCart = json_decode($request->cart_data, true);
            
            if(is_array($parsedCart) && count($parsedCart) > 0) {
                foreach($parsedCart as $item) {
                    $itemId = $item['id'] ?? $item['product_id'] ?? null;
                    
                    if ($itemId) {
                        $product = Product::find($itemId);
                        
                        if ($product) {
                            $displayItems[$product->id] = [
                                'id'         => $product->id,
                                'nama'       => $product->nama,
                                'harga_baru' => $product->harga_baru ?? $product->harga,
                                'quantity'   => $item['qty'] ?? $item['quantity'] ?? 1,
                                'gambar'     => $product->gambar
                            ];
                        } else {
                            $rawImg = $item['gambar'] ?? $item['image'] ?? $item['img'] ?? 'Logo.png';
                            $gambarFile = basename(parse_url($rawImg, PHP_URL_PATH));
                            
                            $displayItems[$itemId] = [
                                'id'         => $itemId,
                                'nama'       => $item['name'] ?? $item['nama'] ?? 'Produk Bar Bar',
                                'harga_baru' => $item['price'] ?? $item['harga'] ?? 0,
                                'quantity'   => $item['qty'] ?? $item['quantity'] ?? 1,
                                'gambar'     => $gambarFile
                            ];
                        }
                    }
                }
                
                session(['cart' => $displayItems]);
            } else {
                return redirect('/menu')->with('error', 'Keranjang kosong, jajan dulu yuk!');
            }
        } 
        // ==============================================================
        // 3. AMBIL DARI SESSION KERANJANG (JIKA REFRESH HALAMAN CHECKOUT)
        // ==============================================================
        else {
            $displayItems = session('cart', []);
            
            if (empty($displayItems)) {
                return redirect('/menu')->with('error', 'Keranjang kosong, jajan dulu yuk!');
            }
        }

        // ==============================================================
        // 4. LEMPAR DATA KE VIEW CHECKOUT (Tanpa Token Midtrans)
        // ==============================================================
        if ($isBuyNow) {
            return view('checkout', [
                'buyNowData' => json_encode($buyNowData)
            ]);
        }

        return view('checkout');
    }

    // ==============================================================
    // 5. PROSES DATA AJAX & BUAT TOKEN MIDTRANS
    // ==============================================================
    public function prosesCheckout(Request $request)
    {
        $data = $request->json()->all();

        $item_details = [];
        $gross_amount = 0;
        $items_for_db = []; 

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $harga = $item['harga_baru'] ?? 0;
                $qty = $item['quantity'] ?? 1;
                
                $item_details[] = [
                    'id'       => $item['id'],
                    'price'    => $harga,
                    'quantity' => $qty,
                    'name'     => substr($item['nama'], 0, 50)
                ];
                
                $items_for_db[] = [
                    'id' => $item['id'], 
                    'nama' => $item['nama'], 
                    'qty' => $qty, 
                    'harga' => $harga
                ];
                
                $gross_amount += ($harga * $qty);
            }
        }

        // --- PENAMBAHAN KEAMANAN DI SINI ---
        // Tolak transaksi jika total tagihan Rp 0
        if ($gross_amount <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Total pembayaran tidak boleh Rp 0. Pastikan keranjang Anda tidak kosong dan harga produk valid.'
            ], 400); // 400 Bad Request
        }
        // -----------------------------------

        $order_id = 'ORDER-' . time() . '-' . rand(100, 999);

        $order = Order::create([
            'order_id'          => $order_id,
            'provinsi'          => $data['provinsi'] ?? '',
            'kabupaten'         => $data['kabupaten'] ?? '',
            'outlet'            => $data['outlet'] ?? '',
            'desa'              => $data['desa'] ?? null,
            'kodepos'           => $data['kodepos'] ?? null,
            'alamat_detail'     => $data['alamat_detail'] ?? '',
            'catatan_pesanan'   => $data['catatan'] ?? null,
            'items'             => $items_for_db,
            'total_harga'       => $gross_amount,
            'status_pembayaran' => 'pending'
        ]);

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id'     => $order_id,
                'gross_amount' => $gross_amount, // Dijamin > 0 karena sudah dicek di atas
            ),
            'item_details' => $item_details,
            'customer_details' => array(
                'first_name' => 'Pelanggan', 
                'last_name'  => 'Bar Bar',
                'email'      => 'pelanggan@barbarduren.com',
                'phone'      => '08111222333',
            ),
        );

        try {
            $snapToken = Snap::getSnapToken($params);
            
            $order->update(['snap_token' => $snapToken]);

            // ==============================================================
            // EKSEKUSI PENGOSONGAN KERANJANG DI SINI
            // ==============================================================
            session()->forget('cart');

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mendapatkan token Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }

    // ==============================================================
    // 6. FUNGSI WEBHOOK UNTUK MENERIMA NOTIFIKASI DARI MIDTRANS
    // ==============================================================
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Order::where('order_id', $request->order_id)->first();
            
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status_pembayaran' => 'success']);
                } 
                elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel' || $request->transaction_status == 'deny') {
                    $order->update(['status_pembayaran' => 'failed']);
                }
            }
        }

        return response()->json(['message' => 'Callback Midtrans berhasil diproses'], 200);
    }
}