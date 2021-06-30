@extends('template.app')

@section('title', 'Pengumuman')

@push('styles')
    <style>
        .wrap-content {
            margin-bottom: 120px;
        }
    </style>
@endpush

@section('content')
    <div class="row mt-5 py-3 wrap-content justify-content-center">
        <div class="col-lg-12">
            <p class="font-signika text-dark">Detail Pengumuman</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="font-signika text-success">{{ $pengumuman->judul }}</h4>
                    <p class="text-muted font-poppins font-14">{{ $pengumuman->created_at->translatedFormat('d F Y') }}</p>

                    <p class="font-14 font-poppins">{{ $pengumuman->deskripsi }}</p>
                    <div class="wrap-btn mt-4">
                        <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            @if(auth()->user() && auth()->user()->role == 'admin')

                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
