<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    public function index(Request $request)
    {
        $q = '';
        $orangtua = User::where('role', '=', 'orangtua');

        if($request->q) {
            $q = $request->q;
            $orangtua = $orangtua->where(function($query) use($q) {
                $query->where('nama', 'like', '%'.$q.'%')
                        ->orWhere('username', 'like', '%'.$q.'%');
            })->latest()->paginate(10);
        } else {
            $orangtua = $orangtua->latest()->paginate(10);
        }

        return view('orangtua.index', compact('orangtua', 'q'));
    }

    public function create()
    {
        return view('orangtua.create');
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
        $req['role'] = 'orangtua';

        User::create($req);

        return redirect()->route('orangtua.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(User $orangtua)
    {

        return view('orangtua.edit', compact('orangtua'));
    }

    public function update(Request $request, User $orangtua)
    {
        $this->validate($request, [
            'username' => 'unique:users,username,'.$orangtua->id
        ], [
            'username.unique' => 'Username sudah digunakan'
        ]);

        $orangtua->update($request->except('_token', '_method'));

        return redirect()->route('orangtua.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(User $orangtua)
    {

        $orangtua->delete();

        return redirect()->route('orangtua.index')->with('success', 'Data berhasil dihapus');
    }

    public function editPassword(User $orangtua)
    {
        return view('orangtua.edit_password', compact('orangtua'));
    }

    public function updatePassword(Request $request, User $orangtua)
    {

        $this->validate($request, [
            'password' => 'min:8|confirmed'
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama'
        ]);

        $orangtua->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('orangtua.index')->with('success', 'Password berhasil disimpan');
    }
}
