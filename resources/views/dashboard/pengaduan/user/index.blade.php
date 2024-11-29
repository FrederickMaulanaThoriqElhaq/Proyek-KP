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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduan as $a)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $a->barang_hilang }}</td>
                                            @if ($a->status === 'masuk')
                                                <td>
                                                    <div class="badge badge-info">
                                                        {{ $a->status === 'masuk' ? 'Pengaduan Masuk' : $a->status }}</div>
                                                </td>
                                                <td>
                                                    <a href="/daftar-pengaduan-user/{{ $a->id }}"
                                                        class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                            class="fas fa-eye"></i> Lihat</a>
                                                    <a href="/daftar-pengaduan-user/{{ $a->id }}/edit"
                                                        class="btn btn-primary
                                                        btn-action mr-1"
                                                        data-toggle="tooltip"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                    <form action="/daftar-pengaduan-user/{{ $a->id }}" method="POST"
                                                        id="delete-form-{{ $a->id }}" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mr-1 btn-action del">
                                                            <i class="fas fa-trash"></i> Batalkan
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                            @if ($a->status === 'proses')
                                                <td>
                                                    <div class="badge badge-warning">
                                                        {{ $a->status === 'proses' ? 'Pengaduan Di Proses' : $a->status }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/daftar-pengaduan-user/{{ $a->id }}"
                                                        class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                            class="fas fa-eye"></i> Lihat</a>
                                                </td>
                                            @endif
                                            @if ($a->status === 'selesai')
                                                <td>
                                                    <div class="badge badge-success">
                                                        {{ $a->status === 'selesai' ? 'Pengaduan Selesai' : $a->status }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/daftar-pengaduan-user/{{ $a->id }}"
                                                        class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                            class="fas fa-eye"></i> Lihat</a>
                                                </td>
                                            @endif
                                            @if ($a->status === 'tolak')
                                                <td>
                                                    <div class="badge badge-danger">
                                                        {{ $a->status === 'tolak' ? 'Pengaduan Di Tolak' : $a->status }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/daftar-pengaduan-user/{{ $a->id }}"
                                                        class="btn btn-warning btn-action mr-1" data-toggle="tooltip"><i
                                                            class="fas fa-eye"></i> Lihat</a>
                                                </td>
                                            @endif
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
    <script>
        $('.del').on('click', function(e) {
            e.preventDefault();

            const formId = $(this).closest('form').attr('id');

            swal({
                title: 'Batalkan Pengaduan',
                text: 'Apakah Anda Yakin Ingin Membatalkan Pengaduan ini ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#' + formId).submit(); // Submit the form if confirmed
                } else {
                    swal('Pengaduan Tidak Dibatalkan');
                }
            });
        });
    </script>
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
