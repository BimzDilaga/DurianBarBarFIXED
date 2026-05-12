<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['number', 'total_price', 'status', 'nama_pelanggan', 'alamat', 'item_details'];
}
