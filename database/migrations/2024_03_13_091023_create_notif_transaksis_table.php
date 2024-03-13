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
        Schema::create('notif_transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('tanggal_aksi');
            $table->longText('isi');
            $table->longText('isi_admin');

            $table->uuid('transaksi_id')->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('CASCADE');

            $table->uuid('pembayaran_id')->nullable();
            $table->foreign('pembayaran_id')->references('id')->on('pembayarans')->onDelete('CASCADE');

            $table->enum('type', ['transaksi', 'pembayaran']);
            $table->enum('baca', ['ya', 'belum']);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_transaksis');
    }
};
