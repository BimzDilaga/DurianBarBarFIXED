<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Bar Bar Es Duren
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (Landing Page)
Route::get('/', [MenuController::class, 'index'])->name('home');

// 2. FITUR MENU & KATEGORI
Route::get('/menu', function () {
    return view('menu.index');
})->name('menu.index');

Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory'])->name('menu.category');

// Halaman Detail Produk
Route::get('/detail/{id}', [\App\Http\Controllers\MenuController::class, 'show']);

// 3. FITUR AUTENTIKASI (Login, Register, Logout)
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    
    // Ini udah diganti jadi POST ya bos
    Route::post('/logout', 'logout')->name('logout');
});

// 4. HALAMAN LAINNYA
// Halaman Contact Us
Route::get('/contact', function () {
    return view('contact');
});

// Halaman Profil User (Udah dibersihin, sisa yang pakai satpam aja)
Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');