<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penggunaan')->primary();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_ahir');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};
