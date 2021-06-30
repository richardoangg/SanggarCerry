@extends('template.app')

@section('title', 'Login')

@section('content')
    <div class="row mt-5 py-3 justify-content-center" style="margin-bottom: 270px">
        <div class="col-lg-5">
            @if(request()->session()->has('error'))
                <div class="alert alert-danger font-14 font-poppins">
                    {{ request()->session()->get('error') }}
                </div>
            @endif
            <p class="font-14 font-signika">Login dengan akun anda</p>
            <div class="card shadow-sm border-0"">
                <div class="card-body py-4">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm font-14 font-poppins" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm font-14 font-poppins" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success font-poppins">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
