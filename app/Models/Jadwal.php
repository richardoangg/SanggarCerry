<?php

namespace App\Models;

use App\Models\Absen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'hari',
        'jam'
    ];

    protected $casts = [
        'jam' => 'datetime',
    ];

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}
