@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    {{-- <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Daftar</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('pendaftaran') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                        required>
                </div>

                <div class="form-group">    
                    <label for="alamat">Alamat Sesuai KTP</label>
                    <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input id="NIK" type="number" class="form-control" name="nik" value="{{ old('nik') }}"
                        required>
                </div>
                @error('nik')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                        required>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="no_hp">No Handphone ( Aktiv )</label>
                    <input id="no_hp" type="number" class="form-control" name="no_hp" value="{{ old('no_hp') }}"
                        required>
                </div>
                @error('no_hp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        required>
                    <small id="password_confirmation_error" class="text-danger d-none">Password dan
                        konfirmasi password harus sama</small>
                </div>

                <label for="image-preview">Foto Identitas</label>
                <div class="form-group row mb-4">
                    <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Pilih Foto</label>
                            <input type="file" name="user_ktp" id="image-upload" required />
                        </div>
                        @error('user_ktp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        DAFTAR
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
                        <span class="fab fa-github"></span> GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Kembali Ke Halaman Login?<a href="{{ route('login') }}"> Klik Disini</a>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
