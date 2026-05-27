<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan kolom ini sesuai dengan database kamu ya
    protected $fillable = [
        'user_id', 'order_id', 'provinsi', 'kabupaten', 'outlet', 
        'desa', 'kodepos', 'alamat_detail', 'catatan_pesanan', 
        'items', 'total_harga', 'status_pembayaran'
    ];

    // 👇 TAMBAHKAN KODE INI 👇
    protected $casts = [
        'items' => 'array',
    ];
}