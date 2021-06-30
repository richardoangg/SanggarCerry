<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absen;
use App\Models\AbsenSiswa;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function getIndex()
    {
        $date = [
            'hari' => Carbon::now()->translatedFormat('l'),
            'tanggal' => Carbon::now()->translatedFormat('d F Y')
        ];

        $count = [
            'siswa' => DB::table('siswa')->count(),
            'guru' => DB::table('users')->where('role', '=', 'guru')->count(),
            'izin' => DB::table('absen_siswa')->where('status', '=', 'izin')->count(),
            'sakit' => DB::table('absen_siswa')->where('status', '=', 'sakit')->count(),
            'alpa' => DB::table('absen_siswa')->where('status', '=', 'alpa')->count()
        ];

        // get absen terbaru
        $q = DB::table('absen')->count();
        $absen = '';
        $absen_siswa = NULL;

        if($q > 0) {
            $absen = Absen::with('jadwal')->latest()->first();
            $absen_siswa = AbsenSiswa::with('siswa')->where('absen_id', '=', $absen->id)->latest()->take(5)->get();
        }

        // pengumuman terbaru
        $pengumuman = Pengumuman::latest()->take(3)->get();

        return view('pages.index', compact('date', 'count', 'absen', 'absen_siswa', 'pengumuman'));
    }
}
