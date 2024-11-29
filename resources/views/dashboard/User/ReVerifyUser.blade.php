@extends('dashboard.layouts.main')
@section('title', 'Verifikasi Ulang User')

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
            <h1>Verifikasi Ulang User</h1>
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
                                        @if ($a->status === 'verif-ulang')
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
                                                    @if ($a->status === 'verif-ulang')
                                                        <div class="badge badge-warning">
                                                            Verifikasi Ulang</div>
                                                    @endif
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
                                                    <form action="{{ route('verif.approval', $a) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-success me-2">Terima</button>
                                                    </form>
                                                    <form action="{{ route('verif.rejected', $a) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger me-2">Tolak</button>
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
