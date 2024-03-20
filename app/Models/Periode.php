<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    public $table = 'periode';

    protected $fillable = [
        'nama_periode', 'tanggal_mulai', 'tanggal_selesai', 'status'
    ];

    public function penilaianKinerja()
    {
        return $this->hasMany(PenilaianKinerja::class);
    }
}
