<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\AbsenSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:guru'])->only('create', 'store', 'destroy');
    }

    public function index(Request $request)
    {
        $q = '';
        $absen = Absen::with('jadwal')->withCount('absenSiswa');

        if($request->q) {
            $q = $request->q;
            $absen = $absen->where(function($query) use($q) {
                $query->where('pertemuan_ke', 'like', '%'.$q.'%')
                        ->orWhereHas('jadwal', function($query) use($q) {
                            $query->where('hari', 'like', '%'.$q.'%')
                                    ->orWhere('jam', 'like', '%'.$q.'%')
                                ->orWhere('guru', 'like', '%'.$q.'%');
                        });
            })->latest()->paginate(10);
        } else {
            $absen = $absen->latest()->paginate(10);
        }

        return view('absen.index', compact('absen', 'q'));
    }

    public function create()
    {
        $jadwal = Jadwal::orderByRaw("FIELD(hari , 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu') ASC")->get();
        $siswa = DB::table('siswa')->get();

        return view('absen.create', compact('jadwal', 'siswa'));
    }

    public function store(Request $request)
    {

        // cek apakah absen untuk pertemuan ini dengan siswa ini sudah ada
        $check = Absen::where('jadwal_id', '=', $request->jadwal_id)
                        ->where('pertemuan_ke', '=', $request->pertemuan_ke)
                        ->whereHas('absenSiswa', function($query) use($request) {
                            $query->where('siswa_id', '=', $request->siswa_id);
                        })
                        ->count();

        if($check > 0) {
            return redirect()->back()->withInput($request->all())->with('error', 'Absen untuk pertemuan ini sudah ada');
        }

        DB::beginTransaction();

        try {
            // cek apakah absen dengan pertemuan ini sudah ada, jika sudah maka get id nya saja
            $check_absen = DB::table('absen')->where('jadwal_id', '=', $request->jadwal_id)
                                            ->where('pertemuan_ke', '=', $request->pertemuan_ke)
                                            ->take(1)
                                            ->get();

            if(count($check_absen) > 0) {
                $absen_id = $check_absen[0]->id;
            } else {
                $absen = Absen::create($request->only('jadwal_id', 'pertemuan_ke','guru'));
                $absen_id = $absen->id;
            }

            AbsenSiswa::create([
                'absen_id' => $absen_id,
                'siswa_id' => $request->siswa_id,
                'status' => $request->status


            ]);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            dd($e);
        }

        return redirect()->route('absen.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($absen)
    {
        $absen_id = $absen;
        $absen = Absen::with(['jadwal', 'absenSiswa.siswa'])->find($absen);
        $absen_siswa = AbsenSiswa::where('absen_id', '=', $absen_id)->latest()->paginate(10);

        return view('absen.show', compact('absen', 'absen_siswa'));
    }

    public function destroy(Absen $absen)
    {
        $absen->delete();

        return redirect()->route('absen.index')->with('success', 'Data berhasil dihapus');
    }
}
