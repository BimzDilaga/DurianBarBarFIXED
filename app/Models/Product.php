<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama', 'kategori', 'harga_baru', 'harga_lama', 
    'deskripsi', 'detail_lengkap', 'gambar', 'warna_bg', 'is_promo', 'stock'
];
    
}