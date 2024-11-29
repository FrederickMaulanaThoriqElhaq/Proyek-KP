@extends('dashboard.layouts.main')
@section('title', 'Buat Pengaduan')

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
            <h1>Buat Pengaduan</h1>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <form action="/daftar-pengaduan-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Barang Yang Hilang</label>
                                <input type="text" id="barang" name="barang" class="form-control"
                                    value="{{ old('barang') }}" required>
                                @error('Barang Yang Hilang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal Hilang</label>
                                <input type="date" id="tgl-hilang" name="tgl-hilang" class="form-control"
                                    value="{{ old('tgl-hilang') }}" required>
                                @error('tgl-hilang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Waktu Hilang</label>
                                <input type="time" id="waktu-hilang" name="waktu-hilang" class="form-control"
                                    value="{{ old('waktu-hilang') }}" required>
                                @error('waktu-hilang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Lokasi Hilang</label>
                                <input type="text" id="lokasi-hilang" name="lokasi-hilang" class="form-control"
                                    value="{{ old('lokasi-hilang') }}" required>
                                @error('Lokasi Hilang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Rincian Kejadian</label>
                                <input type="text" id="kronologi" name="kronologi" class="form-control"
                                    value="{{ old('kronologi') }}" required>
                                @error('Kronologi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Masukan Bukti</label>
                                <div class="custom-file">
                                    <input type="file" name="bukti[]" class="custom-file-input" id="images"
                                        multiple="multiple" required>
                                    <label class="custom-file-label">Choose File</label>
                                </div>
                                <div class="form-text text-muted"> Anda dapat mengunggah lebih dari 1 foto. Batas ukuran per
                                    foto adalah 2MB.</div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="card">
                                        <div class="imgPreview"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Ajukan Pengaduan</button>
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
