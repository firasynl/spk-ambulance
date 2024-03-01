<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;
    public $table = 'unit_kerja';

    protected $fillable = [
        'unit_kerja'
    ];
}
