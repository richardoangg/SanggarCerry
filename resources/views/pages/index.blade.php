@extends('template.app')

@section('title', 'Beranda')

@section('content')
    <div class="row mt-5 py-3">
        @if(auth()->user())
            <div class="col-lg-12">
                <div class="alert alert-success font-poppins font-14">Halo {{ auth()->user()->nama }}, anda login sebagai {{ ucfirst(auth()->user()->role) }}</div>
            </div>
        @endif
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="font-signika mb-3 text-success">{{ $date['hari'] }}</h5>
                            <p class="text-dark font-14 mb-0 font-weight-300 font-poppins">{{ $date['tanggal'] }}</p>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-body">
                            <p class="text-dark font-14 mb-3 font-weight-300 font-poppins">Absen Keseluruhan</p>
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                    <p class="font-14 font-poppins mb-2">Izin</p>
                                    <h5 class="font-poppins mb-1 text-success font-signika">{{ $count['izin'] }}</h5>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <p class="font-14 font-poppins mb-2">Sakit</p>
                                    <h5 class="font-poppins mb-1 text-success font-signika">{{ $count['sakit'] }}</h5>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <p class="font-14 font-poppins mb-2">Alpa</p>
                                    <h5 class="font-poppins mb-1 text-success font-signika">{{ $count['alpa'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-body">
                            <p class="text-dark font-14 mb-3 font-weight-300 font-poppins">Siswa</p>
                            <h3 class="font-poppins mb-1 text-success font-signika">{{ $count['siswa'] }}</h3>
                        </div>
                    </div>
                    <div class="card shadow-sm border-0 mt-3">
                        <div class="card-body">
                            <p class="text-dark font-14 mb-3 font-weight-300 font-poppins">Guru</p>
                            <h3 class="font-poppins mb-1 text-success font-signika">{{ $count['guru'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row">
                @if(auth()->user())
                <div class="col-lg-12">
                    <p class="font-signika text-dark">Absen Terbaru @if($absen) ({{ ucfirst($absen->jadwal->hari).' '.$absen->jadwal->jam->format('H:i').' pertemuan ke '.$absen->pertemuan_ke }}) @endif</p>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="font-poppins font-14">Nama</th>
                                            <th class="font-poppins font-14">Status</th>
                                        </tr>
                                    </thead>

                                    @if($absen_siswa)
                                        <tbody>
                                            @foreach($absen_siswa as $a)
                                                <tr>
                                                    <td class="font-poppins font-14">{{ $a->siswa->nama }}</td>
                                                    <td class="font-poppins font-14">{{ ucfirst($a->status) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('absen.index') }}" class="btn btn-outline-success font-poppins font-14">Lihat Semuanya</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-lg-12 mt-4">
                    <p class="font-signika text-dark">Pengumuman Terbaru</p>
                    @if(count($pengumuman) > 0)
                        <div class="row">
                            @foreach($pengumuman as $data)
                                <div class="col-lg-12 mb-2">
                                    <div class="card shadow-sm border-0">
                                        <a href="{{ route('pengumuman.show', $data->id) }}" class="wrap-pengumuman">
                                            <div class="card-body">
                                                <h4 class="font-signika text-success">{{ $data->judul }}</h4>
                                                <p class="text-muted font-poppins font-14">{{ $data->created_at->translatedFormat('d F Y') }}</p>

                                                <p class="font-14 font-poppins">{{ strlen($data->deskripsi) > 270 ? substr($data->deskripsi, 0, 270).' ...' : $data->deskripsi }}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted font-14 font-poppins font-weight-300">Belum ada</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
