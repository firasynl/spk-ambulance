<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    public $table = 'dokter';

    protected $fillable = [
        'penilaian_1','penilaian_2','penilaian_3','penilaian_4','penilaian_5','penilaian_6','penilaian_7','penilaian_8','penilaian_9','penilaian_10','penilaian_11','penilaian_12','penilaian_13','perilaku_1','perilaku_2','perilaku_3','perilaku_4','perilaku_5','capaian_kinerja','nilai_perilaku','nilai_akhir'
    ];
}
