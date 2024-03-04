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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator');
            $table->unsignedBigInteger('penilaian_kinerja');
            $table->integer('nilai');
            $table->foreign('indikator')->references('id')->on('indikator');
            $table->foreign('penilaian_kinerja')->references('id')->on('penilaian_kinerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
