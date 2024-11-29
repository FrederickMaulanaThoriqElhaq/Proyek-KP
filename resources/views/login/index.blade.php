@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Login</h4>
        </div>


        <div class="card-body">
            @if (session()->has('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sukses') }}
                </div>
            @endif
            @if (session()->has('gagal'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('gagal') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('tolak'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('tolak') }}
                </div>
            @endif
            @if (session()->has('logout'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('logout') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') border-danger @enderror"
                        name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-danger text-small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    @error('password')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-center mt-4 mb-3">
                <div class="text-job text-muted">Login With Social</div>
            </div>
            <div class="row sm-gutters">
                <div class="col-6">
                    <a href="/auth/google" class="btn btn-block btn-social btn-google">
                        <i class="fab fa-google"></i> Google
                    </a>
                </div>
                <div class="col-6">
                    <a href="/auth/github" class="btn btn-block btn-social btn-github">
                        <span class="fab fa-github"></span> Github
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-muted mt-5 text-center">
        Belum Punya Akun? <a href="{{ Route('daftar') }}">Daftar Disini</a>
    </div>
@endsection

@push('scripts')
@endpush
