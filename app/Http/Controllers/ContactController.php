<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // 1. Validasi inputan biar gak ada yang kosong
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // 2. Bungkus data dari form
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message
        ];

        // 3. Proses kirim email ke bos Bar Bar
        Mail::to('durianbarbarr@gmail.com')->send(new ContactMail($data));

        // 4. Balikin ke halaman contact us dengan notif sukses
        return back()->with('success', 'Pesan kamu berhasil dikirim ke Bar Bar Es Duren! Tunggu balasan dari kami ya.');
    }
}