<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitKerja extends Model
{
    use HasFactory;
    public $table = 'unit_kerja';

    protected $fillable = [
        'unit_kerja'
    ];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(Users::class);
    }
}
