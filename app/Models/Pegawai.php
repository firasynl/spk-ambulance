<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    use HasFactory;
    public $table = 'pegawai';

    protected $fillable = [
        'nama_pegawai', 'nik', 'jabatan_pegawai', 'unit_kerja_pegawai'
    ];

    public static function join(){
        $data = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan_pegawai', 'jabatan.id')
            ->join('unit_kerja', 'pegawai.unit_kerja_pegawai', 'unit_kerja.id')
            ->select('pegawai.*', 'jabatan.jabatan as jabatan', 'unit_kerja.unit_kerja as unit_kerja');
        return $data;
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function penilaian_kinerja()
    {
        return $this->hasMany(PenilaianKinerja::class);
    }
}
