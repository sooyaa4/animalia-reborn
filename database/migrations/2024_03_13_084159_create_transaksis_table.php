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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('notrans')->unique();
            
            $table->timestamp('tanggal_transaksi');
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamp('tanggal_diterima')->nullable();

            $table->uuid('kupon_id')->nullable();
            $table->foreign('kupon_id')->references('id')->on('kupons')->onDelete('CASCADE');

            $table->double('total');
            $table->double('subtotal');
            $table->double('after_discount')->nullable();

            $table->unsignedBigInteger('verifikator_id')->nullable();
            $table->foreign('verifikator_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->unsignedBigInteger('pembeli_id')->nullable();
            $table->foreign('pembeli_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
