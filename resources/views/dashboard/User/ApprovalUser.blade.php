@extends('dashboard.layouts.main')
@section('title', 'Verifikasi User')

@push('style')
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@section('main')
    @if (session('sukses'))
        <div class="flash-data" data-flashdata="{{ session('sukses') }}"></div>
    @endif

    <section class="section">
        <div class="section-header">
            <h1>Verifikasi User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/approval">Verifikasi</a></div>
                <div class="breadcrumb-item">Users</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Nama Pengguna</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                        <th>Status</th>
                                        <th>File Ktp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $pendingUserCount = 0;
                                    @endphp
                                    @foreach ($user as $a)
                                        @if ($a->status === 'pending')
                                            <tr>
                                                <td>{{ ++$pendingUserCount }}</td>
                                                <td>{{ $a->name }}</td>
                                                <td>
                                                    @if ($a->username === null)
                                                        <div class="badge badge-info">Kosong</div>
                                                    @else
                                                        {{ $a->username }}
                                                    @endif

                                                </td>

                                                <td>{{ $a->email }}</td>

                                                <td>
                                                    @if ($a->no_hp === null)
                                                        <div class="badge badge-info">Kosong</div>
                                                    @else
                                                        {{ $a->no_hp }}
                                                    @endif
                                                </td>


                                                <td>
                                                    <div class="badge badge-warning">
                                                        {{ $a->status }}</div>
                                                </td>

                                                <td>
                                                    @if ($a->user_ktp === null)
                                                        <div class="badge badge-info">Belum Upload</div>
                                                    @else
                                                        <a href="{{ url('storage/' . $a->user_ktp) }}"
                                                            target="_blank">Lihat</a>
                                                    @endif
                                                </td>

                                                <td>
                                                    <form action="{{ route('users.approval', $a) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success me-2">Terima</button>
                                                    </form>
                                                    <form action="{{ route('users.reverif', $a) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-info me-2">Verif
                                                            Ulang</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
