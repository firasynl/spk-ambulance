<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jabatan extends Model
{
    use HasFactory;
    public $table = 'jabatan';

    protected $fillable = [
        'jabatan'
    ];
    
    public function indikator(): HasMany
    {
        return $this->hasMany(Indikator::class);
    }
    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class);
    }

}
