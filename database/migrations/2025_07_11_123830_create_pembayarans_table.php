<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pembayaran')->primary();
            $table->unsignedBigInteger('id_tagihan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_pembayaran');
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_bayar', 10, 2);
            $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihans')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
