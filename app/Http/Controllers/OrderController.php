<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; 
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    // ==============================================================
    // 1. MENAMPILKAN HALAMAN CHECKOUT
    // ==============================================================
    public function halamanCheckout(Request $request)
    {
        // 1. TANGKAP DATA DARI JAVASCRIPT KERANJANG (POST)
        if ($request->has('cart_data')) {
            $jsCart = json_decode($request->input('cart_data'), true);
            $formattedCart = [];
            
            if (is_array($jsCart)) {
                foreach ($jsCart as $item) {
                    $formattedCart[$item['id']] = [
                        'id' => $item['id'],
                        'nama' => $item['name'] ?? $item['nama'] ?? 'Produk', 
                        'gambar' => basename($item['img'] ?? $item['gambar'] ?? 'Logo.png'), 
                        'harga_baru' => $item['price'] ?? $item['harga'] ?? 0,
                        'quantity' => $item['qty'] ?? $item['quantity'] ?? 1
                    ];
                }
            }
            session()->put('cart', $formattedCart);
        }

        // 2. AMBIL DATA DARI SESSION
        $cart = session('cart', []);
        
        // Kalau keranjang benar-benar kosong, lempar balik ke menu
        if (empty($cart)) {
            return redirect('/menu')->with('error', 'Keranjang kosong, jajan dulu yuk!');
        }

        // 3. HITUNG TOTAL HARGA
        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga_baru'] * $item['quantity'];
        }

        // 4. LEMPAR SEMUA NAMA VARIABEL KE BLADE
        return view('checkout', [
            'cart'         => $cart,
            'displayItems' => $cart, 
            'totalHarga'   => $totalHarga
        ]);
    }

    // ==============================================================
    // 2. PROSES TOMBOL BAYAR SEKARANG -> MIDTRANS
    // ==============================================================
    public function prosesCheckout(Request $request)
    {
        $data = $request->json()->all();

        $item_details = [];
        $gross_amount = 0;

        // 1. SIAPKAN DATA ITEM DAN HITUNG TOTAL HARGA
        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                $harga = $item['harga_baru'] ?? 0;
                $qty = $item['quantity'] ?? $item['qty'] ?? 1;
                
                $item_details[] = [
                    'id'       => $item['id'],
                    'price'    => $harga,
                    'quantity' => $qty,
                    'name'     => substr($item['nama'], 0, 50)
                ];
                
                $gross_amount += ($harga * $qty);
            }
        }

        if ($gross_amount <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Total pembayaran tidak boleh Rp 0.'
            ], 400);
        }

        $order_id = $request->order_id ?? 'ORDER-' . time() . '-' . rand(100, 999);

        // 2. MULAI DATABASE TRANSACTION 
        // (Sistem keamanan: Kalau stok habis, pesanan otomatis dibatalkan)
        DB::beginTransaction();

        try {
            // A. SIMPAN DATA PESANAN KE TABEL ORDERS
            $order = Order::create([
                'user_id'           => auth()->id(), 
                'order_id'          => $order_id, 
                'provinsi'          => $request->provinsi,
                'kabupaten'         => $request->kabupaten,
                'outlet'            => $request->outlet,
                'desa'              => $request->desa,
                'kodepos'           => $request->kodepos,
                'alamat_detail'     => $request->alamat_detail,
                'catatan_pesanan'   => $request->catatan,
                'items'             => json_encode($data['items'] ?? []), 
                'total_harga'       => $gross_amount, 
                'status_pembayaran' => 'pending',
            ]);

            // B. LOGIKA PENGURANGAN STOK PRODUK
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $qty = $item['quantity'] ?? $item['qty'] ?? 1;
                    $product = Product::find($item['id']);

                    if ($product) {
                        if ($product->stock >= $qty) {
                            // Potong stok sejumlah barang yang dibeli
                            $product->decrement('stock', $qty);
                        } else {
                            // Jika stok kurang, lemparkan error untuk membatalkan proses
                            throw new Exception("Maaf, stok " . $product->nama . " tidak mencukupi. Sisa stok: " . $product->stock);
                        }
                    }
                }
            }

            // C. SETUP MIDTRANS
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id'     => $order_id,
                    'gross_amount' => $gross_amount,
                ),
                'item_details' => $item_details,
                'customer_details' => array(
                    'first_name' => Auth::user()->name ?? 'Pelanggan', 
                    'email'      => Auth::user()->email ?? 'pelanggan@barbarduren.com',
                ),
            );

            // D. REQUEST TOKEN MIDTRANS
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            
            // E. SIMPAN PERMANEN KE DATABASE & KOSONGKAN KERANJANG
            DB::commit();
            session()->forget('cart');

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (Exception $e) {
            // Jika ada error (termasuk stok tidak cukup), batalkan semua penyimpanan ke database
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    // ==============================================================
    // 3. FUNGSI WEBHOOK UNTUK MIDTRANS
    // ==============================================================
    public function callbackBypass(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Order::where('order_id', $request->order_id)->first();
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status_pembayaran' => 'success']);
                } elseif (in_array($request->transaction_status, ['expire', 'cancel', 'deny'])) {
                    $order->update(['status_pembayaran' => 'failed']);
                }
            }
        }
        return response()->json(['message' => 'Callback Midtrans berhasil diproses'], 200);
    }
}