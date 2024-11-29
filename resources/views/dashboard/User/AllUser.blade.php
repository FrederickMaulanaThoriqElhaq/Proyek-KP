@extends('dashboard.layouts.main')

@section('title', 'Semua Anggota')

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
            <h1>Semua Anggota</h1>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $approvedUserCount = 0;
                                    @endphp
                                    @foreach ($user as $a)
                                        @if ($a->status === 'approve')
                                            <tr>
                                                <td>{{ ++$approvedUserCount }}</td>
                                                <td class="user-name">{{ $a->name }}</td>
                                                <td>{{ $a->username }}</td>
                                                <td class="user-status" data-status="{{ $a->status }}">
                                                    <div class="badge badge-success">
                                                        {{ $a->status === 'approve' ? 'aktif' : $a->status }}</div>
                                                </td>
                                                <td>
                                                    <a href="/anggota/{{ $a->id }}"
                                                        class="btn btn-warning btn-action mr-1" data-toggle="tooltip"
                                                        title="Lihat"><i class="fas fa-eye"></i></a>
                                                    @if (Auth::user()->id !== $a->id)
                                                        <a href="/anggota/{{ $a->id }}/edit"
                                                            class="btn btn-primary
                                                        btn-action mr-1"
                                                            data-toggle="tooltip" title="Edit"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <form action="/anggota/{{ $a->id }}" method="POST"
                                                            id="delete-form-{{ $a->id }}" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger mr-1 btn-action del">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
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
    </section>
@endsection

@push('scripts')
    <script>
        $('.del').on('click', function(e) {
            e.preventDefault();

            const formId = $(this).closest('form').attr('id');
            const userName = $(this).closest('tr').find('.user-name').text(); // Mengambil nama user dari tabel

            const userStatus = $(this).closest('tr').find('.user-status').data(
                'status'); // Mengambil status user dari data attribute

            if (userStatus === 'approve') {
                swal({
                        title: 'Hapus User',
                        text: 'Apakah Anda Yakin Ingin Menghapus User ' + userName + '?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#' + formId).submit(); // Mengirimkan formulir jika dikonfirmasi
                        } else {
                            swal('Data Tidak Jadi Di Hapus');
                        }
                    });
            } else {
                swal('Hapus Tidak Diizinkan: User Belum Diapprove');
            }
        });
    </script>
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
