<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
// ==========================================
// PANEL DEVELOPER / ADMIN (Wajib Login & Wajib Admin)
// ==========================================
use App\Http\Middleware\AdminMiddleware; 

// Sesuaikan 'AdminController' dengan nama controller tempat bos menaruh fungsi di atas tadi
Route::post('/admin/pesanan/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatusPesanan']);

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/produk', [AdminController::class, 'index']);
    Route::post('/admin/produk/simpan', [AdminController::class, 'simpanProduk']);
   Route::post('/admin/produk/update-stok/{id}', [AdminController::class, 'updateStok']);
    Route::post('/admin/produk/tambah-stok/{id}', [AdminController::class, 'tambahStok']);
    Route::post('/admin/produk/kurang-stok/{id}', [AdminController::class, 'kurangStok']);
    Route::post('/admin/produk/hapus/{id}', [AdminController::class, 'hapusProduk']);
    Route::post('/admin/produk/update-stok-massal', [App\Http\Controllers\AdminController::class, 'updateStokMassal']);
});

// ==========================================
// HALAMAN UTAMA & MENU
// ==========================================
Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'halamanMenu'])->name('menu.index');
Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory'])->name('menu.category');
Route::get('/detail/{id}', [MenuController::class, 'show']);

// ==========================================
// FITUR KERANJANG & CHECKOUT
// ==========================================
Route::get('/beli/{id}', [MenuController::class, 'beli']); 
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); 
Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.proses');

Route::post('/proses-checkout', function (Request $request) {
    $response = app(CheckoutController::class)->prosesCheckout($request);
    session()->forget('cart');
    return $response;
})->middleware('auth')->name('midtrans.bayar');

Route::post('/midtrans-callback', [CheckoutController::class, 'callback']);

// ==========================================
// HALAMAN STATIS
// ==========================================
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/outlet', function () { return view('outlet'); });
Route::get('/contact', function () { return view('contact'); });
Route::post('/contact', [ContactController::class, 'sendEmail']);

// ==========================================
// AUTENTIKASI (LOGIN, DLL)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==========================================
// VERIFIKASI EMAIL
// ==========================================
Route::get('/email/verify', function () { return view('auth.verify-email'); })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = \App\Models\User::findOrFail($id);
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return abort(403, 'Link kadaluarsa.');
    }
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    \Illuminate\Support\Facades\Auth::login($user);
    return redirect('/verifikasi-sukses'); 
})->middleware(['signed'])->name('verification.verify');

Route::get('/verifikasi-sukses', function () { return view('auth.verifikasi-sukses'); })->middleware('auth');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ==========================================
// HALAMAN TERKUNCI
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::get('/pembayaran-sukses', function () {
        session()->forget('cart');
        return view('pembayaran-sukses');
    })->name('pembayaran.sukses');
    Route::get('/riwayat', [CheckoutController::class, 'riwayat'])->name('riwayat.index');// Rute untuk memproses form tambah produk
Route::post('/admin/produk/tambah', [AdminController::class, 'simpanProduk']);
});