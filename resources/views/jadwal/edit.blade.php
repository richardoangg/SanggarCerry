@extends('template.app')

@section('title', 'Jadwal')

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
            @if(request()->session()->has('error'))
                <div class="alert alert-danger font-14 font-poppins">
                    {{ request()->session()->get('error') }}
                </div>
            @endif
            <p class="font-signika text-dark">Edit Jadwal</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @include('jadwal.partials._form')
                </div>
            </div>
        </div>
    </div>
@endsection