<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * DI SINI TEMPATNYA! 
     * Laravel pakai nama 'up' untuk menjalankan perintah buat tabel.
     */
    public function up(): void  // <--- Pastikan tulisannya 'up' kecil semua
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('harga_lama');
            $table->string('harga_baru');
            $table->string('gambar');
            $table->string('warna_bg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
