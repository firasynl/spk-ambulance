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
        Schema::create('penilaian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai');
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('periode_id');
            $table->foreign('pegawai')->references('id')->on('pegawai');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('periode_id')->references('id')->on('periode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_kinerja');
    }
};
