<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Indikator extends Model
{
    use HasFactory;
    public $table = 'indikator';

    protected $fillable = [
        'indikator', 'kategori','jabatan_id'
    ];

    public static function join(){
        $data = DB::table('indikator')
            ->join('jabatan', 'indikator.jabatan_id', 'jabatan.id')
            ->select('indikator.*', 'jabatan.jabatan as jabatan');
        return $data;
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function nilai(): HasOne
    {
        return $this->hasOne(Nilai::class);
    }
}
