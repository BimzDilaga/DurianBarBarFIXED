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
    Schema::table('products', function (Blueprint $table) {
        // Menambah kolom text bernama detail_lengkap, ditaruh setelah kolom deskripsi
        $table->text('detail_lengkap')->nullable()->after('deskripsi');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('detail_lengkap');
    });
    }
};
