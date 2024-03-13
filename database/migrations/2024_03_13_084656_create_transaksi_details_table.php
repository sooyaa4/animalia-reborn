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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->uuid('id');

            $table->uuid('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('CASCADE');

            $table->uuid('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('CASCADE');

            $table->uuid('produk_diskon_id')->nullable();
            $table->foreign('produk_diskon_id')->references('id')->on('produk_diskons')->onDelete('CASCADE');

            $table->integer('jumlah');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};
