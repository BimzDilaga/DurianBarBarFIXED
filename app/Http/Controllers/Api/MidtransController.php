<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Ambil data JSON murni dari Midtrans
        $payload = $request->getContent();
        $notification = json_decode($payload);

        if (!$notification) {
            return response()->json(['message' => 'Payload tidak valid'], 400);
        }

        // 2. Kunci rahasia dari Midtrans (.env)
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        // 3. Buat kecocokan Signature Key untuk keamanan
        $hashed = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . $serverKey);

        if ($hashed == $notification->signature_key) {
            
            // 🔥 PERBAIKAN DI SINI: Cari berdasarkan kolom 'order_id', bukan 'id'
            $order = Order::where('order_id', $notification->order_id)->first();

            if ($order) {
                $status = $notification->transaction_status;

                // 4. Cek status transaksinya
                if ($status == 'capture' || $status == 'settlement') {
                    // JIKA LUNAS, ubah status di database jadi 'success'
                    $order->update(['status_pembayaran' => 'success']);
                } elseif (in_array($status, ['cancel', 'deny', 'expire'])) {
                    // JIKA GAGAL/KADALUARSA, ubah jadi 'failed'
                    $order->update(['status_pembayaran' => 'failed']);
                }
                
                return response()->json(['message' => 'Status pembayaran berhasil diperbarui']);
            } else {
                return response()->json(['message' => 'Data order tidak ditemukan di database'], 404);
            }
        }

        return response()->json(['message' => 'Signature key tidak cocok!'], 403);
    }
}