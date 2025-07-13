<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->unsignedBigInteger('id_penggunaan');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('jumlah_meter');
            $table->string('status');
            $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
