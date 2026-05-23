<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom-kolom yang dibutuhkan CheckoutController
            $table->string('order_id')->nullable()->after('id');
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('outlet')->nullable();
            $table->string('desa')->nullable();
            $table->string('kodepos')->nullable();
            $table->text('alamat_detail')->nullable();
            $table->text('catatan_pesanan')->nullable();
            $table->json('items')->nullable(); // Untuk nyimpen array produk
            $table->integer('total_harga')->nullable();
            $table->string('status_pembayaran')->default('pending');
            $table->string('snap_token')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn([
                'order_id', 'provinsi', 'kabupaten', 'outlet', 'desa', 
                'kodepos', 'alamat_detail', 'catatan_pesanan', 'items', 
                'total_harga', 'status_pembayaran', 'snap_token'
            ]);
        });
    }
};