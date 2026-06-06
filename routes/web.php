<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\CheckoutController;

// ==========================================
// HALAMAN UTAMA & MENU
// ==========================================
// 1. Halaman Home (Landing Page) memanggil fungsi index di MenuController
Route::get('/', [MenuController::class, 'index'])->name('home'); 

// 2. Halaman Menu Utama memanggil fungsi halamanMenu di MenuController
Route::get('/menu', [MenuController::class, 'halamanMenu'])->name('menu.index');

// 3. Jembatan untuk Halaman Kategori (Es Durian, Mie Ayam, dll)
Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory']); 

// 4. Jembatan untuk Halaman Detail Produk
Route::get('/detail/{id}', [MenuController::class, 'show']); 

Route::get('/beli/{id}', [MenuController::class, 'beli']); 
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); 


// ==========================================
// JEMBATAN SINKRONISASI KERANJANG (LOCALSTORAGE)
// ==========================================
// Menerima data dari JavaScript, menyimpannya ke Session, lalu melempar ke /checkout
Route::post('/sync-cart', [CheckoutController::class, 'syncCart']);


// ==========================================
// FITUR CHECKOUT & MIDTRANS (WAJIB LOGIN)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Diubah menjadi GET saja karena data POST keranjang sudah diurus oleh /sync-cart di atas
    Route::get('/checkout', [OrderController::class, 'halamanCheckout'])->name('checkout');
    Route::post('/proses-checkout', [OrderController::class, 'prosesCheckout'])->name('midtrans.bayar');
    
    Route::get('/pembayaran-sukses', function () {
        session()->forget('cart');
        return view('pembayaran-sukses');
    })->name('pembayaran.sukses');
    
    Route::get('/profile', function () { return view('profile'); })->name('profile');

    // Menampilkan halaman riwayat pesanan customer
    Route::get('/riwayat', [OrderController::class, 'riwayatPesanan'])->name('riwayat');
});

// Jalur Webhook Callback Midtrans (Di luar middleware auth agar server Midtrans bisa akses)
Route::post('/midtrans-callback', [OrderController::class, 'callbackBypass']);


// ==========================================
// PANEL DEVELOPER / ADMIN 
// ==========================================
Route::get('/admin/pesanan', [AdminController::class, 'indexPesanan']);
Route::post('/admin/pesanan/update/{id}', [AdminController::class, 'updateStatusPesanan'])->name('admin.updateStatus');
Route::post('/admin/pesanan/update-status/{id}', [AdminController::class, 'updateStatusPesanan']);
Route::post('/admin/produk/tambah', [AdminController::class, 'simpanProduk']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/produk', [AdminController::class, 'index']);
    Route::post('/admin/produk/simpan', [AdminController::class, 'simpanProduk']);
    Route::post('/admin/produk/update-stok/{id}', [AdminController::class, 'updateStok']);
    Route::post('/admin/produk/tambah-stok/{id}', [AdminController::class, 'tambahStok']);
    Route::post('/admin/produk/kurang-stok/{id}', [AdminController::class, 'kurangStok']);
    Route::post('/admin/produk/hapus/{id}', [AdminController::class, 'hapusProduk']);
    Route::post('/admin/produk/update-stok-massal', [AdminController::class, 'updateStokMassal']);
});


// ==========================================
// AUTENTIKASI (LOGIN, REGISTER, DLL)
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
// HALAMAN STATIS
// ==========================================
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/outlet', function () { return view('outlet'); });
Route::get('/contact', function () { return view('contact'); });
Route::post('/contact', [ContactController::class, 'sendEmail']);