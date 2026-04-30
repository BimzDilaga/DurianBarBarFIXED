<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan ini ada
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. TAMPILAN FORM DAFTAR
    public function showRegister() {
        return view('register');
    }

    // 2. PROSES SIMPAN DATA DAFTAR
    public function register(Request $request) {
        // Proses simpan data (Harus di dalam kurung kurawal ini)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Setelah berhasil simpan, baru pindah ke login
        return redirect('/login')->with('success', 'Daftar berhasil! Silakan login.');
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
            return redirect('/');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // 5. LOGOUT
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}