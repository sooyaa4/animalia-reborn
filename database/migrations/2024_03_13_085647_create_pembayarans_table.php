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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('CASCADE');

            $table->decimal('amount', 10, 2);
            $table->string('fraud_status');
            $table->string('status_code');
            $table->string('status_message');

            $table->string('payment_type');
            $table->string('transaction_status');
            $table->timestamp('transaction_time')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
