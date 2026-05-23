<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // Contoh: ORDER-123456789
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('outlet');
            $table->string('desa')->nullable();
            $table->string('kodepos')->nullable();
            $table->text('alamat_detail');
            $table->text('catatan_pesanan')->nullable();
            $table->json('items'); // Menyimpan array keranjang belanja
            $table->decimal('total_harga', 15, 2);
            $table->string('status_pembayaran')->default('pending'); // pending, success, failed
            $table->string('snap_token')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};