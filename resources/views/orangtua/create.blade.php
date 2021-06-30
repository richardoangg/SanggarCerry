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
            <p class="font-signika text-dark">Tambah Orangtua</p>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @include('orangtua.partials._form')
                </div>
            </div>
        </div>
    </div>
@endsection
