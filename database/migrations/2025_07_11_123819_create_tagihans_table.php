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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tagihan')->primary();
            $table->unsignedBigInteger('id_penggunaan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('jumlah_meter');
            $table->string('status')->default('Belum Bayar');
            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaans')->onDelete('cascade');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};