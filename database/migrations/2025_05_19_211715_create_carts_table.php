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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menghubungkan ke tabel users
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Menghubungkan ke tabel produk
            $table->integer('quantity'); // Jumlah produk yang dimasukkan
            $table->string('varian')->nullable(); // Menambahkan kolom varian untuk menyimpan pilihan varian produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};