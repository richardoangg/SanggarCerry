<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only('create', 'store', 'edit', 'update', 'destroy');
    }
    
    public function index(Request $request)
    {
        $q = '';
        $jadwal = Jadwal::query();

        if($request->q) {
            $q = $request->q;
            $jadwal = $jadwal->where(function($query) use($q) {
                $query->where('hari', 'like', '%'.$q.'%')
                        ->orWhere('jam', 'like', '%'.$q.'%');
            })->latest()->paginate(10);
        } else {
            $jadwal = $jadwal->latest()->paginate(10);
        }

        return view('jadwal.index', compact('jadwal', 'q'));
    }

    public function create()
    {
        return view('jadwal.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jam' => 'date_format:H:i'
        ], [
            'jam.date_format' => 'Format jam salah'
        ]);

        $check = DB::table('jadwal')->where('hari', '=', $request->hari)
                                    ->where('jam', '=', $request->jam.':00')
                                    ->count();

        if($check > 0) {
            return redirect()->back()->withInput($request->all())->with('error', 'Data sudah ada');
        }

        Jadwal::create($request->except('_token'));

        return redirect()->route('jadwal.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $this->validate($request, [
            'jam' => 'date_format:H:i'
        ], [
            'jam.date_format' => 'Format jam salah'
        ]);

        $check = DB::table('jadwal')->where(function($query) use($request) {
            $query->where('hari', '=', $request->hari)
            ->where('jam', '=', $request->jam.':00');
        })
        ->where('id', '!=', $jadwal->id)
        ->count();

        if($check > 0) {
            return redirect()->back()->withInput($request->all())->with('error', 'Data sudah ada');
        }

        $jadwal->update($request->except('_token', '_method'));

        return redirect()->route('jadwal.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data berhasil dihapus');
    }
}
