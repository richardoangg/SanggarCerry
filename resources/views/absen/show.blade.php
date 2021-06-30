@extends('template.app')

@section('title', 'Absen')

@push('styles')
    <style>
        .wrap-content {
            margin-bottom: 120px;
        }
    </style>
@endpush

@section('content')
    <div class="row mt-5 py-3 wrap-content">
        @if(request()->session()->has('success'))
            <div class="col-lg-12">
                <div class="alert alert-success font-14 font-poppins">
                    {{ request()->session()->get('success') }}
                </div>
            </div>
        @endif
        <div class="col-lg-5">
            <p class="font-signika text-dark">Detail Absen</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-2 flex-wrap">
                            <span class="font-14 font-poppins font-weight-500">Jadwal</span>
                            <span class="font-14 font-poppins">{{ ucfirst($absen->jadwal->hari).' '.$absen->jadwal->jam->format('H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-2 flex-wrap">
                            <span class="font-14 font-poppins font-weight-500">Pertemuan Ke</span>
                            <span class="font-14 font-poppins">{{ $absen->pertemuan_ke }}</span>
                        </li>
                    </ul>
                    <div class="wrap-btn mt-4">
                        <form action="{{ route('absen.destroy', $absen->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a href="{{ route('absen.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            @if(auth()->user() && auth()->user()->role == 'guru')

                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <p class="font-signika text-dark">Absensi Siswa</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="font-poppins font-14">Nama</th>
                                    <th class="font-poppins font-14">Status</th>
                                    @if(auth()->user() && auth()->user()->role == 'guru')
                                        <th class="font-poppins font-14">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($absen_siswa as $data)
                                    <tr>
                                        <td class="font-poppins font-14">{{ $data->siswa->nama }}</td>
                                        <td class="font-poppins font-14">{{ ucfirst($data->status) }}</td>
                                        @if(auth()->user() && auth()->user()->role == 'guru')
                                            <td>
                                                <form action="{{ route('absen-siswa.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('absen-siswa.edit', $data->id) }}" class="btn btn-sm btn-warning font-poppins font-14">Edit</a>

                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $absen_siswa->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
