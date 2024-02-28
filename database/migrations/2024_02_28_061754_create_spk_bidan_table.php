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
        Schema::create('spk_bidan', function (Blueprint $table) {
            $table->id();
            $table->integer('penilaian_1');
            $table->integer('penilaian_2');
            $table->integer('penilaian_3');
            $table->integer('penilaian_4');
            $table->integer('penilaian_5');
            $table->integer('penilaian_6');
            $table->integer('penilaian_7');
            $table->integer('penilaian_8');
            $table->integer('penilaian_9');
            $table->integer('penilaian_10');
            $table->integer('penilaian_11');
            $table->integer('penilaian_12');
            $table->integer('penilaian_13');
            $table->integer('perilaku_1');
            $table->integer('perilaku_2');
            $table->integer('perilaku_3');
            $table->integer('perilaku_4');
            $table->integer('perilaku_5');
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
        Schema::dropIfExists('spk_bidan');
    }
};
