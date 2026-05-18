<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi otomatis
    protected $fillable = ['user_id', 'nama_produk', 'harga'];

    // Bikin relasi supaya Order tau ini punyanya User siapa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}