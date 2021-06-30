@extends('template.app')

@section('title', 'Absen')

@section('content')
    <div class="row mt-5 py-3">
        <div class="col-lg-12">
            @if(request()->session()->has('success'))
                <div class="alert alert-success font-14 font-poppins">
                    {{ request()->session()->get('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <p class="font-signika text-dark">Daftar Absen</p>
                @if(auth()->user() && auth()->user()->role == 'guru')
                    <div>
                        <a href="{{ route('absen.create') }}" class="btn btn-sm btn-success font-14 font-poppins">Tambah Data</a>
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
                                    <th class="font-poppins font-14">Jadwal</th>
                                    <th class="font-poppins font-14">Pertemuan Ke</th>
                                    <th class="font-poppins font-14">Total Absen</th>
                                    <th class="font-poppins font-14">guru</th>
                                    <th class="font-poppins font-14">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absen as $data)
                                    <tr>
                                        <td class="font-poppins font-14">{{ ucfirst($data->jadwal->hari).' '.$data->jadwal->jam->format('H:i') }}</td>
                                        <td class="font-poppins font-14">{{ $data->pertemuan_ke }}</td>
                                        <td class="font-poppins font-14">{{ $data->absen_siswa_count }}</td>
                                        <td class="font-poppins font-14">{{ $data->guru }}</td>
                                        <td>
                                            <form action="{{ route('absen.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('absen.show', $data->id) }}" class="btn btn-sm btn-outline-success font-poppins font-14">Detail</a>
                                                @if(auth()->user() && auth()->user()->role == 'guru')
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $absen->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
