<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Indikator extends Model
{
    use HasFactory;
    public $table = 'indikator';

    protected $fillable = [
        'indikator', 'jabatan'
    ];

    public static function join(){
        $data = DB::table('indikator')
            ->join('jabatan', 'indikator.jabatan', 'jabatan.id')
            ->select('indikator.*', 'jabatan.jabatan as jabatan');
        return $data;
    }
}
