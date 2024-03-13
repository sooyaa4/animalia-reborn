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
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('transaksi_id')->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('CASCADE');

            $table->unsignedBigInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('jenis_kirims')->onDelete('CASCADE');

            $table->uuid('alamat_id')->nullable();
            $table->foreign('alamat_id')->references('id')->on('alamats')->onDelete('CASCADE');

            $table->double('ongkir')->nullable();

            $table->string('services')->nullable();

            $table->string('noresi')->nullable();

            $table->enum('status', ['pending', 'kemas', 'dikirim'])->default('pending');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
