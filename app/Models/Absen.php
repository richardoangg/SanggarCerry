<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\AbsenSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';
    protected $fillable = [
        'jadwal_id',
        'pertemuan_ke',
        'guru'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function absenSiswa()
    {
        return $this->hasMany(AbsenSiswa::class);
    }
}
