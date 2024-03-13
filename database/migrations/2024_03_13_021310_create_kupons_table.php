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
        Schema::create('kupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('kode');
            $table->double('potongan');
            $table->text('deskripsi');
            $table->integer('max')->nullable();
            $table->enum('tampil', ['ya','tidak'])->default('tidak');
            $table->timestamp('tanggal_awal')->nullable();
            $table->timestamp('tanggal_akhir')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kupons');
    }
};
