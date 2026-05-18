<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
// 3. FITUR KERANJANG (Bisa diakses siapa saja / disimpan di session)
// ==========================================
Route::get('/beli/{id}', [MenuController::class, 'beli']); 
Route::get('/kurang/{id}', [MenuController::class, 'kurang']); 

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
// 5. AUTENTIKASI (LOGIN, REGISTER, LOGOUT)
// ==========================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout wajib login dulu
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// ==========================================
// 6. FITUR VERIFIKASI EMAIL
// ==========================================

// 1. Halaman "Tolong cek email kamu"
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 2. Proses ketika user mengklik link verifikasi di email (SUDAH DIUBAH)
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

    // DIARAHKAN KE HALAMAN SUKSES (Bukan langsung profil)
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
// 7. HALAMAN TERKUNCI (WAJIB LOGIN & VERIFIKASI EMAIL)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Halaman Profil
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Halaman Checkout (Mendukung GET dan POST sekaligus)
    Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout'); 
    Route::post('/checkout', [MenuController::class, 'checkout'])->name('checkout.proses'); 

    // Halaman Pembayaran Sukses
    Route::get('/pembayaran-sukses', function () {
        session()->forget('cart'); 
        return view('pembayaran-sukses');
    })->name('pembayaran.sukses');

});