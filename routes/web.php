<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Selipkan di dalam kelompok middleware (['auth', 'verified']) kamu yang di bagian bawah:
Route::get('/riwayat', [CheckoutController::class, 'riwayat'])->name('riwayat.index');

// ==========================================
// 1. HALAMAN UTAMA (Bisa diakses siapa saja)
// ==========================================
Route::get('/', [MenuController::class, 'index'])->name('home');

// ==========================================
// 2. MENU & DETAIL PRODUK (Bisa diakses siapa saja)
// ==========================================
Route::get('/menu', [MenuController::class, 'halamanMenu'])->name('menu.index');
Route::get('/menu/{kategori}', [MenuController::class, 'showByCategory'])->name('menu.category');
Route::get('/detail/{id}', [MenuController::class, 'show']);

// ==========================================
// 3. FITUR KERANJANG & CHECKOUT
// ==========================================
Route::get('/beli/{id}', [MenuController::class, 'beli']); 
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); 

// FITUR CHECKOUT (Wajib Login Dulu!)
// Pakai "match" biar bisa nerima klik biasa (GET) maupun lemparan data dari pop-up keranjang Navbar (POST)
Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.proses');

// RUTE KHUSUS AJAX MIDTRANS (Ditembak diam-diam saat klik tombol "BAYAR SEKARANG")
Route::post('/proses-checkout', function (Request $request) {
    // 1. Jalankan proses checkout dari controller seperti biasa
    $response = app(CheckoutController::class)->prosesCheckout($request);
    
    // 2. KOSONGKAN KERANJANG seketika setelah pesanan berhasil diproses!
    session()->forget('cart');
    
    // 3. Kembalikan respon ke Midtrans
    return $response;
})->middleware('auth')->name('midtrans.bayar');

// WEBHOOK MIDTRANS (Terima Notifikasi Otomatis - Tidak Boleh Pakai Auth!)
Route::post('/midtrans-callback', [CheckoutController::class, 'callback']);

// ==========================================
// 4. HALAMAN STATIS (Bisa diakses siapa saja)
// ==========================================
Route::get('/about', function () {
    return view('about');
})->name('about');

// Nampilin form Contact Us
Route::get('/contact', function () {
    return view('contact');
});

// Proses ngirim Email pas tombol "SEND IT!" diklik
Route::post('/contact', [ContactController::class, 'sendEmail']);

Route::get('/outlet', function () {
    return view('outlet');
});

// ==========================================
// 5. AUTENTIKASI (LOGIN, REGISTER, LUPA PASSWORD, LOGOUT)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// === RUTE LUPA PASSWORD BARU ===
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// === RUTE RESET PASSWORD (KLIK LINK DARI EMAIL) ===
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Logout wajib login dulu
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// ==========================================
// 6. FITUR VERIFIKASI EMAIL
// ==========================================

// 1. Halaman "Tolong cek email kamu"
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. Proses ketika user mengklik link verifikasi di email
Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = \App\Models\User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return abort(403, 'Link verifikasi tidak valid atau sudah kadaluarsa.');
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    // Paksa login otomatis
    \Illuminate\Support\Facades\Auth::login($user);

    // DIARAHKAN KE HALAMAN SUKSES
    return redirect('/verifikasi-sukses'); 
})->middleware(['signed'])->name('verification.verify');

// 3. RUTE BARU: Menampilkan halaman sukses verifikasi
Route::get('/verifikasi-sukses', function () {
    return view('auth.verifikasi-sukses');
})->middleware('auth');

// 4. Tombol untuk mengirim ulang email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi yang baru sudah dikirim ke email kamu!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// ==========================================
// 7. HAL halaman TERKUNCI (WAJIB LOGIN & VERIFIKASI EMAIL)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Halaman Profil
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Halaman Pembayaran Sukses
    Route::get('/pembayaran-sukses', function () {
        session()->forget('cart'); // Backup tambahan
        return view('pembayaran-sukses');
    })->name('pembayaran.sukses');

});