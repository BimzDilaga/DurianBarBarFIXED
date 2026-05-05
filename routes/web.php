<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;

// ==========================================
// 1. HALAMAN UTAMA
// ==========================================
Route::get('/', [MenuController::class, 'index'])->name('home');

// ==========================================
// 2. MENU & DETAIL PRODUK
// ==========================================
Route::get('/menu', function () {
    return view('menu.index');
})->name('menu.index');

Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory'])->name('menu.category');
Route::get('/detail/{id}', [MenuController::class, 'show']);

// ==========================================
// 3. FITUR KERANJANG (INI YANG BIKIN GAK 404)
// ==========================================
Route::get('/beli/{id}', [MenuController::class, 'beli']); // Buat masukin barang ke keranjang
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); // Buat ngurangin barang
Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout'); // Buat buka halaman kasir

// ==========================================
// 4. HALAMAN STATIS & PROFIL
// ==========================================
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// ==========================================
// 5. AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');