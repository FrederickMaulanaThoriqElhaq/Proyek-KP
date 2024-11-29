@extends('dashboard.layouts.main')
@section('title', 'Lihat Pengduan')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Lihat Data Pengaduan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p class="mb-2"><strong>Barang Yang Hilang :</strong><br> {{ $pengaduan->barang_hilang }}</p>
                    <hr>
                    <p class="mb-2"><strong>Rincian Kejadian :</strong><br> {{ $pengaduan->kronologi }}</p>
                    <hr>
                    <p class="mb-2"><strong>Status :</strong><br> {{ $pengaduan->status }}</p>
                    <hr>
                    <p class="mb-2"><strong>Nama Pengadu :</strong><br>{{ $pengaduan->user->name }}
                    </p>
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
                        <form action="{{ route('pengaduan.proses', $pengaduan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning mr-1 btn-action"><i
                                    class="fa-solid fa-paper-plane"></i> Proses</button>
                        </form>
                        <form action="{{ route('pengaduan.tolak', $pengaduan) }}" method="POST"
                            id="delete-form-{{ $pengaduan->id }}" class="d-inline">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-danger mr-1 btn-action del">
                                <i class="fas fa-trash"></i> Tolak Pengaduan
                            </button>
                        </form>
                    @endif

                    @if ($pengaduan->status === 'proses')
                        <hr class="mb-3">
                        <p class="mb-2"><strong>Action</strong></p>
                        <form action="{{ route('pengaduan.selesai', $pengaduan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success mr-1 btn-action"><i
                                    class="fa-solid fa-paper-plane"></i> Selesai</button>
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
                    title: 'Tolak Pengaduan',
                    text: 'Apakah Anda Yakin Ingin Menolak Pengaduan ini ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#' + formId).submit(); // Submit the form if confirmed
                    } else {
                        swal('Pengaduan Tidak Jadi Di Tolak');
                    }
                });
            } else {
                swal('Tidak Diizinkan: Pengaduan tidak memenuhi kondisi yang ditentukan');
            }
        });
    </script>
@endpush
