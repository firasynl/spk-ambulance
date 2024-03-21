<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    public $table = 'users';

    protected $fillable = [
        'nama', 'unit_kerja', 'email', 'password', 'usertype'
    ];

    public static function join(){
        $data = DB::table('users')
            ->join('unit_kerja', 'users.unit_kerja', 'unit_kerja.id')
            ->select('users.*', 'unit_kerja.unit_kerja as unit_kerja');
        return $data;
    }


}
