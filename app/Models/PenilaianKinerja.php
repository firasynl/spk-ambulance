<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenilaianKinerja extends Model
{
    use HasFactory;
    public $table = 'penilaian_kinerja';

    protected $fillable = [
        'pegawai', 'user', 'tanggal'
    ];

    public static function join(){
        $data = DB::table('penilaian_kinerja')
            ->join('pegawai', 'penilaian_kinerja.pegawai', 'pegawai.id')
            ->join('user', 'penilaian_kinerja.user', 'user.id')
            ->join('jabatan', 'pegawai.jabatan_pegawai', 'jabatan.id')
            ->select('penilaian_kinerja.*', 'pegawai.nama_pegawai as pegawai', 'jabatan.jabatan as jabatan', 'user.nama_user as user');
        return $data;
    }
}
