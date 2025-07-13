<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->string('username');
            $table->string('password');
            $table->string('nomor_kwh');
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->unsignedBigInteger('id_tarif');
            $table->string('foto')->nullable(); // kolom untuk nama file foto
            $table->foreign('id_tarif')->references('id_tarif')->on('tarifs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
