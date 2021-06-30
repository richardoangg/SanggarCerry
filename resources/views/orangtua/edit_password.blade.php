@extends('template.app')

@section('title', 'Orangtua')

@push('styles')
    <style>
        .wrap-content {
            margin-bottom: 120px;
        }
    </style>
@endpush

@section('content')
    <div class="row mt-5 py-3 justify-content-center wrap-content">
        <div class="col-lg-5">
            <p class="font-signika text-dark">Ganti Password orangtua</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('orangtua.update-password', $orangtua->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="password" class="font-poppins font-14">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control font-poppins font-14 @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="font-poppins font-14">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control font-poppins font-14" id="password_confirmation" name="password_confirmation" required>
                         </div>
                        <div class="form-group">
                            <a href="{{ route('orangtua.index') }}" class="btn btn-sm btn-light">Kembali</a>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
