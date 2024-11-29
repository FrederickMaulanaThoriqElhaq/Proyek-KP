@extends('dashboard.layouts.main')
@section('title', 'Edit Pengaduan')

@push('style')
    <style>
        .img-thumbnail {
            max-width: 300px;
            max-height: 300px;
            width: auto;
            height: auto;
        }
    </style>
@endpush

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengaduan</h1>
        </div>

        <div class="row">
            <div class="col-12">
            <div class="card">
    <form action="/daftar-pengaduan-user/{{ $pengaduan->id }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Barang Hilang</label>
                <input type="text" id="barang" name="barang" class="form-control" required
                     value="{{ old('barang', $pengaduan->barang_hilang) }}">
                @error('barang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Hilang</label>
                <input type="date" id="tgl-hilang" name="tgl-hilang" class="form-control" required
                    value="{{ old('tgl-hilang', $pengaduan->tgl_hilang) }}">
                @error('tgl-hilang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Waktu Hilang</label>
                <input type="time" id="waktu-hilang" name="waktu-hilang" class="form-control" required
                    value="{{ old('waktu-hilang', $pengaduan->waktu_hilang) }}">
                @error('waktu-hilang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Lokasi Hilang</label>
                <input type="text" id="lokasi-hilang" name="lokasi-hilang" class="form-control" required
                    value="{{ old('lokasi-hilang', $pengaduan->lokasi_hilang) }}">
                @error('lokasi-hilang')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Kronologi</label>
                <textarea class="form-control" id="kronologi" name="kronologi" required>{{ old('kronologi', $pengaduan->kronologi) }}</textarea>
                @error('kronologi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="images">Masukkan Gambar Baru</label>
                <div class="custom-file">
                    <input type="file" name="bukti[]" class="custom-file-input" id="images" multiple>
                    <label class="custom-file-label" for="images">Pilih File</label>
                </div>
                <div class="form-text text-muted">Anda dapat mengunggah lebih dari 1 gambar. Batas ukuran per gambar adalah 2MB.</div>
                @error('bukti.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="card">
                        <div class="imgPreview"></div>
                    </div>
                </div>
            </div>

            @if ($pengaduan->bukti->count() > 0)
                <div class="form-group">
                    <label for="old-images">Gambar Bukti Lama</label>
                    <div class="row">
                        @foreach ($pengaduan->bukti as $bukti)
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <img src="{{ url('storage/' . $bukti->bukti) }}" class="card-img">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="delete_old_images" class="custom-control-input"
                        id="delete-old-images">
                    <label class="custom-control-label" for="delete-old-images">Centang Jika Ingin Menghapus Gambar Lama</label>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Ubah Pengaduan</button>
        </div>
    </form>
</div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    var row = $('<div class="row imgPreview"></div>'); // Create a new row

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var img = $('<img class="card-img" alt="Image Preview">');
                            img.attr('src', event.target.result);

                            var card = $('<div class="col-md-4 mb-2"></div>');
                            card.append(img);
                            row.append(card);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }

                    $(imgPreviewPlaceholder).html(row); // Replace the existing previews with the new row
                }
            };

            $('#images').on('change', function() {
                multiImgPreview(this, '.imgPreview');
            });
        });
    </script>
@endpush