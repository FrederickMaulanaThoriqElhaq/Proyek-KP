@extends('dashboard.layouts.main')
@section('title', 'Daftar Pengaduan')

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
            <h1>Daftar Pengaduan</h1>
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
                                        <th>Barang Yang Hilang</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Jam Pelaporan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduan as $a)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $a->barang_hilang}}</td>
                                            <td>{{ $a->created_at->format('d M Y') }}</td>
                                            <td>{{ $a->created_at->format('H:i') }}</td>
                                            <td>
                                                @if ($a->status === 'masuk')
                                                    <div class="badge badge-info">
                                                        {{ $a->status === 'masuk' ? 'Pengaduan Masuk' : $a->status }}</div>
                                                @endif
                                                @if ($a->status === 'proses')
                                                    <div class="badge badge-warning">
                                                        {{ $a->status === 'proses' ? 'Pengaduan Di Proses' : $a->status }}
                                                    </div>
                                                @endif
                                                @if ($a->status === 'selesai')
                                                    <div class="badge badge-success">
                                                        {{ $a->status === 'selesai' ? 'Pengaduan Selesai' : $a->status }}
                                                    </div>
                                                @endif
                                                @if ($a->status === 'tolak')
                                                    <div class="badge badge-danger">
                                                        {{ $a->status === 'tolak' ? 'Pengaduan Di Tolak' : $a->status }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pengaduan.show', ['id' => $a->id]) }}"
                                                    class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                        class="fas fa-eye"></i>
                                                    Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
