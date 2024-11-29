@extends('dashboard.layouts.main')

@section('title', 'Edit User')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Tambah User Baru</h1>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <form action="/anggota" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" id="name" name="name" class="form-control">
                                @error('name')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username">
                                @error('username')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email">
                                @error('email')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone ( Aktiv )</label>
                                <input id="no_hp" type="number" class="form-control" name="no_hp">
                                @error('no_hp')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                @error('password')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>

                            <label for="image-preview">Foto KTP Wajib</label>
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Pilih Foto</label>
                                        <input type="file" name="user_image" id="image-upload" />
                                    </div>
                                    @error('user_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <label for="image-preview">Foto</label>
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Pilih Foto</label>
                                        <input type="file" name="user_image" id="image-upload" />
                                    </div>
                                    @error('user_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Tambah User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush
