<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    // Wajib ditambahkan agar kolom 'items' JSON bisa menerima data keranjang
    protected $casts = [
        'items' => 'array',
    ];

    // Mengizinkan penyimpanan data secara langsung (Mass Assignment)
    protected $guarded = []; 
}