<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:guru'])->only('edit', 'update', 'destroy');
    }

    public function edit($absen_siswa)
    {
        $absen_siswa = AbsenSiswa::with(['absen', 'absen.jadwal', 'siswa'])->find($absen_siswa);

        return view('absen.edit', compact('absen_siswa'));
    }

    public function update(Request $request, AbsenSiswa $absen_siswa)
    {
        $absen_siswa->update($request->only('status'));

        return redirect()->route('absen.show', $absen_siswa->absen_id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy(AbsenSiswa $absen_siswa)
    {
        $absen_siswa->delete();

        return redirect()->route('absen.show', $absen_siswa->absen_id)->with('success', 'Data berhasil disimpan');
    }
}
