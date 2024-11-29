@extends('dashboard.layouts.main')

@section('title', 'Ubah Password')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Ubah Passsword</h1>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <form action="{{ route('UbahPassword.User', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                            <i class="fa fa-eye-slash" id="toggle-password"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                            <i class="fa fa-eye-slash" id="toggle-password-confirmation"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger text-small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            togglePasswordVisibility('password', 'toggle-password');
        });

        document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
            togglePasswordVisibility('password_confirmation', 'toggle-password-confirmation');
        });

        function togglePasswordVisibility(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fa fa-eye';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fa fa-eye-slash';
            }
        }
    </script>
@endpush
