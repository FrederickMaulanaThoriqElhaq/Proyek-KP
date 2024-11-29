@extends('dashboard.layouts.main')
@section('title', 'Lihat Pengaduan')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Lihat Data Pengaduan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p class="mb-2"><strong>Barang Yang Hilang</strong><br> {{ $pengaduan->barang_hilang }}</p>
                    <hr>
                    <p class="mb-2"><strong>Tanggal Hilang</strong><br> {{ $pengaduan->tgl_hilang }}</p>
                    <hr>
                    <p class="mb-2"><strong>Waktu Hilang</strong><br> {{ $pengaduan->waktu_hilang }}</p>
                    <hr>
                    <p class="mb-2"><strong>Lokasi Hilang</strong><br> {{ $pengaduan->lokasi_hilang }}</p>
                    <hr>
                    <p class="mb-2"><strong>Rincian Kejadian:</strong><br> {{ $pengaduan->kronologi }}
                    <hr>
                    <p class="mb-2"><strong>Bukti:</strong></p>

                    <div class="row">
                        @foreach ($pengaduan->bukti as $b)
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <img src="{{ url('storage/' . $b->bukti) }}" class="card-img">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($pengaduan->status === 'masuk')
                        <hr class="mb-3">
                        <p class="mb-2"><strong>Action</strong></p>
                        <a href="/daftar-pengaduan-user/{{ $pengaduan->id }}/edit" class="btn btn-warning ml-auto"><i
                                class="fas fa-edit"></i> Edit</a>
                        <form action="/daftar-pengaduan-user/{{ $pengaduan->id }}" method="POST"
                            id="delete-form-{{ $pengaduan->id }}" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger mr-1 btn-action del">
                                <i class="fas fa-trash"></i> Batalkan Pengaduan
                            </button>
                        </form>
                    @endif

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
            const status = "{{ $pengaduan->status }}"; // Get the perihal value

            // Replace the following condition with your specific condition
            if (status === 'masuk') {
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
            } else {
                swal('Tidak Diizinkan: Pengaduan tidak memenuhi kondisi yang ditentukan');
            }
        });
    </script>
@endpush
