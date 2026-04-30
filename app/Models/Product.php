<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pastikan tulisannya 'protected' dan '$fillable' (pakai dolar)
    protected $fillable = ['nama', 'deskripsi', 'harga_lama', 'harga_baru', 'gambar', 'warna_bg'];
}