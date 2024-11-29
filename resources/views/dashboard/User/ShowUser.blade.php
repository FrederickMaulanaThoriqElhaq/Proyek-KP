@extends('dashboard.layouts.main')
@section('title', 'Data User')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Data User </h1>
            <h1 class="user-name">&nbsp;{{ $user->name }}</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">


                    <p class="mb-2"><strong>Username :</strong><br>{{ $user->username }}</p>
                    <hr>
                    <p class="mb-2 user-Status" data-status="{{ $user->status }}"><strong>Status
                            :</strong><br>{{ $user->status === 'approve' ? 'aktif' : $user->status }}</p>
                    <hr>
                    <p class="mb-2"><strong>NIK :</strong><br>{{ $user->nik }}</p>
                    <hr>
                    <p class="mb-2"><strong>Email :</strong><br>{{ $user->email }}</p>
                    <hr>
                    <p class="mb-2"><strong>No Telepon :</strong><br>{{ $user->no_hp }}</p>
                    <hr>
                    <p class="mb-2"><strong>Akun Di Buat Pada :</strong><br>{{ $user->created_at->format('j F Y') }}</p>
                    <hr>

                    <p class="mb-2"><strong>Foto User:</strong></p>
                    @if ($user->user_image)
                        <div class="mb-3 center">
                            <a href="{{ url('storage/' . $user->user_image) }}" target="_blank">Lihat</a>
                        </div>
                    @else
                        <div class="mb-3 center">
                            <p>User Belum Mengganti Foto.</p>
                        </div>
                    @endif
                    <hr>

                    <p class="mb-2"><strong>Identitas Verifikasi User : </strong></p>
                    @if ($user->user_ktp)
                        <div class="mb-3 center">
                            <a href="{{ Storage::url($user->user_ktp) }}" target="_blank">Lihat</a>
                        </div>
                    @else
                        <div class="mb-3 center">
                            <p>Data KTP tidak ditemukan.</p>
                        </div>
                    @endif


                    <hr class="mb-3">
                    <div class="d-flex justify-content-end">
                        <a href="/anggota/{{ $user->id }}/edit"
                            class="btn btn-warning btn-action mr-1"
                            data-toggle="tooltip" title="Edit">Edit</a>
                        <form action="/anggota/{{ $user->id }}" method="POST"
                            id="delete-form-{{ $user->id }}" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger mr-1 ml-2 btn-action del">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
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
            const userName = $('.user-name').text(); // Mengambil nama user dari elemen dengan kelas "user-name"

            const userStatus = $('.user-Status').data('status'); // Mengambil status user dari data attribute

            if (userStatus === 'approve') {
                swal({
                        title: 'Hapus User',
                        text: 'Apakah Anda Yakin Ingin Menghapus User' + userName + '?',
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
@endpush
