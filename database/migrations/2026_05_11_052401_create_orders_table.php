<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('number'); // ID Pesanan dari Midtrans
        $table->string('total_price');
        $table->enum('status', ['pending', 'success', 'failed']);
        $table->string('nama_pelanggan');
        $table->text('item_details'); // Nyimpen daftar makanan yang dibeli
        $table->timestamps();
        
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
