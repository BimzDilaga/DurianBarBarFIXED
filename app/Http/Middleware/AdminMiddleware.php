<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kuncinya di sini bos: ganti ->role menjadi ->customer
        if ($request->user() && $request->user()->customer !== 'admin') {
            abort(403, 'Akses Ditolak! Akun bos bukan akun Developer.');
        }

        return $next($request);
    }
}