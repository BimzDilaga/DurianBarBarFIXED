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
Route::get('/menu', [MenuController::class, 'halamanMenu'])->name('menu.index');
Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory'])->name('menu.category');
Route::get('/detail/{id}', [MenuController::class, 'show']);

// ==========================================
// 3. FITUR KERANJANG & CHECKOUT
// ==========================================
Route::get('/beli/{id}', [MenuController::class, 'beli']); 
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); 
Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout'); 

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

Route::get('/outlet', function () {
    return view('outlet');
});

// ==========================================
// 5. PEMBAYARAN SUKSES (Udah dibersihin)
// ==========================================
Route::get('/pembayaran-sukses', function () {
    // Kosongin keranjang belanja karena udah dibayar!
    session()->forget('cart'); 
    return view('pembayaran-sukses');
})->name('pembayaran.sukses');

// ==========================================
// 6. AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');