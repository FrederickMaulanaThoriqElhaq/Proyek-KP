@extends('dashboard.layouts.main')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
<style>
    .process-step {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .process-step:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .process-step i {
        color: #3498db;
        font-size: 3rem;
    }

    .process-arrow i {
        color: #e74c3c;
        font-size: 2rem;
    }

    .process-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-top: 10px;
        color: #333;
    }

    .process-desc {
        font-size: 0.95rem;
        color: #777;
    }

    .container-fluid {
        padding: 40px 0;
    }
</style>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        @if (session('sukses'))
            <div class="flash-data" data-flashdata="{{ session('sukses') }}"></div>
        @endif
        @if (auth()->user()->is_admin)
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalAdmins }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalUsers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>User Menunggu Persetujuan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalApproveUsers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pengaduan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduan }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Masuk</h4>
                            </div>
                            <div class="card-body">
                                {{ $countPengaduanMasuk }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Di Proses</h4>
                            </div>
                            <div class="card-body">
                                {{ $countPengaduanProses }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Selesai</h4>
                            </div>
                            <div class="card-body">
                                {{ $countPengaduanSelesai }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Di Tolak</h4>
                            </div>
                            <div class="card-body">
                                {{ $countPengaduanTolak }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else

        <div class="container-fluid">
        <h2 class="text-center my-1">Alur Pelaporan</h2>
            <div class="row justify-content-center text-center">
                <!-- Pemohon -->
                <div class="col-md-2 process-step">
                    <i class="fas fa-user-circle"></i>
                    <h4 class="process-title">Buat Pengaduan</h4>
                    <p class="process-desc">Buatlah Pengaduan dan Tambahkan Foto Persyaratan</p>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- Petugas Front Office -->
                <div class="col-md-2 process-step">
                    <i class="fas fa-user-tie"></i>
                    <h4 class="process-title">Petugas Menerima Pengaduan</h4>
                    <p class="process-desc">Petugas Akan Melihat Pengaduan Anda</p>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- PPIP -->
                <div class="col-md-2 process-step">
                    <i class="fas fa-clipboard-list"></i>
                    <h4 class="process-title">Verifikasi dan Proses</h4>
                    <p class="process-desc">Proses Dilaksanakan Saat Berkas Anda Valid, Atau Pengaduan Ditolak Jika Berkas Tidak Valid</p>
                </div>
                <div class="col-md-1 d-flex align-items-center justify-content-center process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <!-- PPID -->
                <div class="col-md-2 process-step">
                    <i class="fas fa-check-circle"></i>
                    <h4 class="process-title">Pengaduan Selesai</h4>
                    <p class="process-desc">Datanglah Ke Polres Saat Pengaduan Anda Selesai Diproses untuk mengambil File Pengaduan</p>
                </div>
            </div>
        </div>

        <div class="container">
            <h2 class="text-center my-4">Syarat Kehilangan</h2>

            <div class="row">
                <!-- Kehilangan KTP -->
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan KTP</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Kartu Keluarga</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kehilangan Buku Tabungan/ATM -->
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-university fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Buku Tabungan/ATM</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Buku Tabungan</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan dari Bank</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kehilangan SIM -->
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-badge fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan SIM</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto SIM</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Rekomendasi Kehilangan SIM</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan BPJS</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto BPJS</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan STNK</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto BPKB</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan dari Bank (Jika Digadai)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Ijasah/STTB</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Ijazah/STTB</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan dari Sekolah atau Dinas Pendidikan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Bukti Gadai</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Pengantar dari Pegadaian</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Resi Pengambilan BPKB</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto STNK</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan NPWP</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto NPWP</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto No. NPWP Dari Kantor Pajak</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Akte Kelahiran</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Akte Kelahiran</li>
                                <li><i class="fas fa-check-circle text-success"></i> Apabila tidak ada dapat dimintakan No. Akte ke Dukcapil</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Buku Nikah</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Pengantar KUA</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Kroya BANK</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Foto Copy Sertifikat Tanah yang dijaminkan</li>
                                <li><i class="fas fa-check-circle text-success"></i> Surat Pengantar dari Bank yang menerbitkan Kroya</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan Kartu Tanda Mahasiswa & Kartu Rencana Study</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan Aktif Kuliah dari Kampus</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">Kehilangan SIM Card Seluler</h5>
                            <ul>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto KTP/Kartu Keluarga</li>
                                <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan Dari Provider</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                            <div class="card-body text-center">
                                <i class="fas fa-id-card fa-3x mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title">Kehilangan Surat Pembelian Emas</h5>
                                <ul>
                                    <li><i class="fas fa-check-circle text-success"></i> Scan/Foto Surat Keterangan Pembelian Dari Toko Emas</li>
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
            
        <h2 class="text-center my-4">Proses Pengaduan Anda</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Pengaduan Anda</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduanSendiri }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Di Proses</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduanSendiriDiproses }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Selesai</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduanSendiriSelesai }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pengaduan Anda Ditolak</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPengaduanSendiriDitolak }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->user_ktp === null && Auth::user()->is_admin !== 1)
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h3>Selamat Datang!
                                <br>Silakan Melengkapi Data Terlebih Dahulu Agar Bisa Melakukan Pengaduan
                            </h3>
                            <a href="{{ route('lengkapi.data') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-plus"></i>
                                Lengkapi Data</a>
                        </center>
                    </div>
                </div>
            </div>
        @endif

    </section>

@endsection
