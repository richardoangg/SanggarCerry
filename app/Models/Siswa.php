<?php

namespace App\Models;

use App\Models\AbsenSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [
        'nama',
        'umur',
        'wali',
        'alamat',
        'status'
    ];

    public function absenSiswa()
    {
        return $this->hasMany(AbsenSiswa::class);
    }
}
