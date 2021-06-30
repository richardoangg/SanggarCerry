<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $q = '';
        $guru = User::where('role', '=', 'guru');

        if($request->q) {
            $q = $request->q;
            $guru = $guru->where(function($query) use($q) {
                $query->where('nama', 'like', '%'.$q.'%')
                        ->orWhere('username', 'like', '%'.$q.'%');
            })->latest()->paginate(10);
        } else {
            $guru = $guru->latest()->paginate(10);
        }

        return view('guru.index', compact('guru', 'q'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:users,username',
            'password' => 'min:8|confirmed'
        ], [
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama'
        ]);

        $req = $request->except('_token', 'password_confirmation');
        $req['password'] = bcrypt($request->password);
        $req['role'] = 'guru';

        User::create($req);

        return redirect()->route('guru.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(User $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, User $guru)
    {
        $this->validate($request, [
            'username' => 'unique:users,username,'.$guru->id
        ], [
            'username.unique' => 'Username sudah digunakan'
        ]);

        $guru->update($request->except('_token', '_method'));

        return redirect()->route('guru.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(User $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dihapus');
    }

    public function editPassword(User $guru)
    {
        return view('guru.edit_password', compact('guru'));
    }

    public function updatePassword(Request $request, User $guru)
    {
        $this->validate($request, [
            'password' => 'min:8|confirmed'
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama'
        ]);

        $guru->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('guru.index')->with('success', 'Password berhasil disimpan');
    }
}
