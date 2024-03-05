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
}
