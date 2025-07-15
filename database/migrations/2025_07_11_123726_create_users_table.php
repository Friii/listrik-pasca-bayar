<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username');
            $table->string('password');
            $table->string('nama_admin');
            $table->unsignedBigInteger('id_level');
            $table->foreign('id_level')->references('id_level')->on('levels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
