<?php

namespace App\Models;

use App\Models\Absen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsenSiswa extends Model
{
    use HasFactory;

    protected $table = 'absen_siswa';
    protected $fillable = [
        'absen_id',
        'siswa_id',
        'status'
    ];

    public function absen()
    {
        return $this->belongsTo(Absen::class, 'absen_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
