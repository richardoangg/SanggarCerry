@extends('template.app')

@section('title', 'Orangtua')

@section('content')
    <div class="row mt-5 py-3">
        <div class="col-lg-12">
            @if(request()->session()->has('success'))
                <div class="alert alert-success font-14 font-poppins">
                    {{ request()->session()->get('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <p class="font-signika text-dark">Daftar orangtua</p>
                <div>
                    <a href="{{ route('orangtua.create') }}" class="btn btn-sm btn-success font-14 font-poppins">Tambah Data</a>
                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="wrap-search">
                                <form action="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm font-14 font-poppins" value="{{ $q }}" placeholder="Cari ..." name="q">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-sm btn-light"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-poppins font-14">Nama</th>
                                    <th class="font-poppins font-14">Username</th>
                                    <th class="font-poppins font-14">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orangtua as $data)
                                    <tr>
                                        <td class="font-poppins font-14">{{ $data->nama }}</td>
                                        <td class="font-poppins font-14">{{ $data->username }}</td>
                                        <td>
                                            <form action="{{ route('orangtua.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('orangtua.edit-password', $data->id) }}" class="btn btn-sm btn-outline-success font-poppins font-14">Ganti Password</a>
                                                <a href="{{ route('orangtua.edit', $data->id) }}" class="btn btn-sm btn-warning font-poppins font-14">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger font-poppins font-14">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                        </table>
                            </tbody>
                    </div>

                    {{ $orangtua->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
