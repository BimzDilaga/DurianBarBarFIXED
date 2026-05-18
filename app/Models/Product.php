<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 'detail_lengkap' sudah ditambahkan ke dalam array fillable
    protected $fillable = [
        'nama', 
        'deskripsi', 
        'detail_lengkap', 
        'harga_lama', 
        'harga_baru', 
        'gambar', 
        'warna_bg'
    ];
}