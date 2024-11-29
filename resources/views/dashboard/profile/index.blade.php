@extends('dashboard.layouts.main')

@section('title', 'Profle User')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>PROFILE</h1>
        </div>
        @if (session('sukses'))
            <div class="flash-data" data-flashdata="{{ session('sukses') }}"></div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    @if (Auth::user()->user_image)
                                        <img alt="image" src="{{ url('storage/' . Auth::user()->user_image) }}"
                                            class="rounded-circle w-75">
                                    @else
                                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}"
                                            class="rounded-circle w-75">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <p class="mb-2"><strong>Nama:</strong><br>{{ $user->name }}</p>
                                    <hr>
                                    <p class="mb-2"><strong>Username:</strong><br>{{ $user->username }}</p>
                                    <hr>
                                    <p class="mb-2"><strong>Email:</strong><br>{{ $user->email }}</p>
                                    <hr>
                                    <p class="mb-2"><strong>No Handphone</strong><br>{{ $user->no_hp }}</p>
                                    <hr>
                                    <p class="mb-2"><strong>Akun Di Buat
                                            Pada</strong><br>{{ $user->created_at->format('j F Y') }}</p>
                                    <hr>
                                    <a href="{{ route('edit.profile', Auth::user()->id) }}" class="btn btn-warning ml-auto">
                                        <i class="fas fa-edit"></i>Edit Profile
                                    </a>
                                    <a href="{{ route('Ubah.Password', Auth::user()->id) }}" class="btn btn-danger ml-auto">
                                        <i class="fas fa-edit"></i>Ubah Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
