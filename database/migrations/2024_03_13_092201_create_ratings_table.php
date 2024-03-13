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
        Schema::create('ratings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->longText('ulasan');
            $table->integer('star_rating');
            $table->unsignedBigInteger('pembeli_id');
            $table->foreign('pembeli_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('produk_id');
            $table->foreign('produk_id')->references('id')->on('produks')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
