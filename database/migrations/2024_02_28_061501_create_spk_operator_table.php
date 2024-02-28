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
        Schema::create('spk_operator', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('penilaian_1')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_2')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_3')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_4')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_5')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_6')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_7')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_8')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_9')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_10')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('penilaian_11')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('perilaku_1')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('perilaku_2')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('perilaku_3')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('perilaku_4')->unsigned()->min(0)->max(100);
            $table->unsignedInteger('perilaku_5')->unsigned()->min(0)->max(100);
            $table->float('capaian_kinerja');
            $table->float('nilai_perilaku');
            $table->float('nilai_akhir');
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spk_operator');
    }
};
