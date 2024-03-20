<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    use HasFactory;

    public $table = 'nilai';

    protected $fillable = [
        'indikator_id','penilaian_kinerja', 'nilai'
    ];

    public function indikator(): BelongsTo
    {
        return $this->belongsTo(Indikator::class);
    }
    public function penilaian_kinerja(): BelongsTo
    {
        return $this->belongsTo(PenilaianKinerja::class);
    }
}
