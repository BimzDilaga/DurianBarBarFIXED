<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // 1. TAMPILAN FORM DAFTAR
    public function showRegister() {
        return view('register');
    }

    // 2. PROSES SIMPAN DATA DAFTAR
    public function register(Request $request) {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|min:6|confirmed'
        ]);

        // Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        // MENYIMPAN PASSWORD KE SESSION (Agar bisa diintip di Profil)
        session(['password_mentah' => $request->password]);

        // Memicu pengiriman email verifikasi
        event(new Registered($user));

        // Login otomatis setelah daftar
        Auth::login($user);

        // Arahkan ke profile (nanti akan dicek oleh middleware verified)
        return redirect('/profile');
    }

    // 3. TAMPILAN FORM LOGIN
    public function showLogin() {
        return view('login');
    }

    // 4. PROSES LOGIN
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // MENYIMPAN PASSWORD KE SESSION SAAT LOGIN
            session(['password_mentah' => $request->password]);

            return redirect('/profile');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // 5. LOGOUT
    public function logout() {
        Auth::logout();
        
        // Menghapus password dari memori saat logout
        session()->forget('password_mentah');
        
        return redirect('/');
    }

    // ==========================================
    // FITUR LUPA PASSWORD
    // ==========================================

    // 6. TAMPILAN FORM LUPA PASSWORD
    public function showForgotPassword() {
        return view('forgot-password');
    }

    // 7. PROSES KIRIM EMAIL RESET PASSWORD
    public function sendResetLinkEmail(Request $request) {
        // Validasi email
        $request->validate(['email' => 'required|email']);

        // Proses kirim link dari sistem bawaan Laravel
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Jika berhasil terkirim
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email kamu!');
        }

        // Jika gagal (email tidak ditemukan)
        return back()->withErrors(['email' => 'Maaf, email tersebut tidak terdaftar di sistem kami.']);
    }

    // 8. TAMPILAN FORM RESET PASSWORD BARU (DARI EMAIL)
    public function showResetPassword(Request $request, $token) {
        return view('reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // 9. PROSES UPDATE PASSWORD KE DATABASE
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed', // Pastikan input konfirmasi bernama password_confirmation
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // Jika sukses, lempar ke halaman login
        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
        }

        // Jika gagal (token expired, dsb)
        return back()->withErrors(['email' => 'Gagal mereset password. Pastikan link belum kadaluarsa.']);
    }
}