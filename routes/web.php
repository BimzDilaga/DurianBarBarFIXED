<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;              // Cukup tulis satu kali saja
use Illuminate\Support\Facades\DB;   // Cukup tulis satu kali saja

Route::get('/', function () {
    // Ambil data untuk Slider (Recommendation Utama)
    $products = Product::all();
    
    // Ambil data untuk kartu bawah
    $recommends = DB::table('recommendations')->get();

    return view('welcome', compact('products', 'recommends'));
});

use App\Http\Controllers\AuthController;

// Tampilan Form Daftar
Route::get('/register', [AuthController::class, 'showRegister']);

// Proses Kirim Data ke Database
Route::post('/register', [AuthController::class, 'register']);

// Route untuk Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route Logout
Route::get('/logout', [AuthController::class, 'logout']);
