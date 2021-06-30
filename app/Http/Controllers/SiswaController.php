<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        $q = '';
        $siswa = Siswa::query();

        if($request->q) {
            $q = $request->q;
            $siswa = $siswa->where(function($query) use($q) {
                $query->where('nama', 'like', '%'.$q.'%')
                        ->orWhere('umur', 'like', '%'.$q.'%')
                        ->orWhere('wali', 'like', '%'.$q.'%')
                        ->orWhere('alamat', 'like', '%'.$q.'%')
                        ->orWhere('status', 'like', '%'.$q.'%');
            })->latest()->paginate(10);
        } else {
            $siswa = $siswa->latest()->paginate(10);
        }

        return view('siswa.index', compact('siswa', 'q'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        Siswa::create($request->except('_token'));

        return redirect()->route('siswa.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->except('_token', '_method'));

        return redirect()->route('siswa.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus');
    }
}
