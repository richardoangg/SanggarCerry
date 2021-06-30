@extends('template.app')

@section('title', 'Jadwal')

@section('content')
    <div class="row mt-5 py-3">
        <div class="col-lg-12">
            @if(request()->session()->has('success'))
                <div class="alert alert-success font-14 font-poppins">
                    {{ request()->session()->get('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <p class="font-signika text-dark">Daftar Jadwal</p>
                @if(auth()->user() && auth()->user()->role == 'admin')
                    <div>
                        <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-success font-14 font-poppins">Tambah Data</a>
                    </div>
                @endif
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
                                    <th class="font-poppins font-14">Hari</th>
                                    <th class="font-poppins font-14">Jam</th>
                                    @if(auth()->user() && auth()->user()->role == 'admin')
                                        <th class="font-poppins font-14">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $data)
                                    <tr>
                                        <td class="font-poppins font-14">{{ ucfirst($data->hari) }}</td>
                                        <td class="font-poppins font-14">{{ $data->jam->format('H:i') }}</td>
                                        @if(auth()->user() && auth()->user()->role == 'admin')
                                            <td>
                                                <form action="{{ route('jadwal.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('jadwal.edit', $data->id) }}" class="btn btn-sm btn-warning font-poppins font-14">Edit</a>

                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $jadwal->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
