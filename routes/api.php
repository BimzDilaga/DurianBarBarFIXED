<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Ganti import controller-nya ke CheckoutController
use App\Http\Controllers\CheckoutController; 

// Arahkan ke CheckoutController agar fungsi potong stoknya jalan
Route::post('/midtrans-callback', [CheckoutController::class, 'callback']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');