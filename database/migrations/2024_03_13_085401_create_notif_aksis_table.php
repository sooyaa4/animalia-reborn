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
        Schema::create('notif_aksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('tanggal_aksi');
            $table->longText('isi');
            $table->longText('isi_admin');

            $table->uuid('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('CASCADE');

            $table->enum('type', ['cart', 'favorite']);
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
        Schema::dropIfExists('notif_aksis');
    }
};
