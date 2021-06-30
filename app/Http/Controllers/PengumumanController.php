<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->only('create', 'store', 'edit', 'update', 'destroy');
    }
    
    public function index(Request $request)
    {
        $q = '';
        $pengumuman = Pengumuman::query();

        if($request->q) {
            $q = $request->q;
            $pengumuman = $pengumuman->where(function($query) use($q) {
                $query->where('judul', 'like', '%'.$q.'%')
                        ->orWhere('deskripsi', 'like', '%'.$q.'%');
            })->latest()->paginate(10);
        } else {
            $pengumuman = $pengumuman->latest()->paginate(10);
        }

        return view('pengumuman.index', compact('pengumuman', 'q'));
    }

    public function create()
    {
        return view('pengumuman.create');
    }

    public function store(Request $request)
    {
        Pengumuman::create($request->except('_token'));

        return redirect()->route('pengumuman.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $pengumuman->update($request->except('_token', '_method'));

        return redirect()->route('pengumuman.index')->with('success', 'Data berhasil disimpan');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.show', compact('pengumuman'));
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Data berhasil dihapus');
    }
}
