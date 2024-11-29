<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Pengaduan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Aduan</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }} ">
                <a href="/dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            @if (!auth()->user()->is_admin)
                @if ((Auth::user()->user_ktp != null) & (Auth::user()->status == 'approve'))
                    <li class="menu-header">Pengaduan Saya</li>
                    <li class="nav-item {{ Request::is('daftar-pengaduan-user') ? 'active' : '' }}">
                        <a href="/daftar-pengaduan-user" class="nav-link"><i class="fas fa-file"></i><span>Daftar
                                Pengaduan</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('daftar-pengaduan-user/create') ? 'active' : '' }}">
                        <a href="/daftar-pengaduan-user/create" class="nav-link"><i class="fas fa-plus"></i><span>Tambah
                                Pengaduan</span></a>
                    </li>
                @else
                    <li class="menu-header">Verifikasi Kelengkapan Data</li>
                    <li class="nav-item {{ Request::is('verifikasi-data') ? 'active' : '' }}">
                        <a href="/verifikasi-data" class="nav-link"><i class="fas fa-file"></i><span>Verifikasi
                                Data</span></a>
                    </li>
                @endif
            @endif

            @can('admin')
                <li class="menu-header">MANAGEMENT DATA</li>
                <li
                    class="nav-item dropdown {{ Request::is('anggota*', 'approval*', 'verifikasi-ulang*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-bars"></i><span>Daftar
                            Anggota</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('anggota*') ? 'active' : '' }}"><a class="nav-link" href="/anggota">Semua
                                Anggota</a></li>
                        <li class="{{ Request::is('approval*') ? 'active' : '' }}"><a class="nav-link"
                                href="/approval">Belum Terverifikasi</a></li>
                        <li class="{{ Request::is('verifikasi-ulang*') ? 'active' : '' }}"><a href="/verifikasi-ulang"
                                class="nav-link">Verifikasi Ulang</a></li>
                    </ul>
                </li>

                <li
                    class="nav-item dropdown {{ Request::is('daftar-pengaduan*', 'pengaduan-masuk*', 'pengaduan-diproses*', 'pengaduan-selesai*', 'pengaduan-ditolak*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-bars"></i><span>Daftar
                            Pengaduan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('daftar-pengaduan*') ? 'active' : '' }}"><a class="nav-link"
                                href="/daftar-pengaduan">Semua Pengaduan</a></li>
                        <li class="{{ Request::is('pengaduan-masuk*') ? 'active' : '' }}"><a class="nav-link"
                                href="/pengaduan-masuk">Pengaduan Masuk</a></li>
                        <li class="{{ Request::is('pengaduan-diproses*') ? 'active' : '' }}"><a href="/pengaduan-diproses"
                                class="nav-link">Pengaduan Di Proses</a></li>
                        <li class="{{ Request::is('pengaduan-selesai*') ? 'active' : '' }}"><a href="/pengaduan-selesai"
                                class="nav-link">Pengaduan Selesai</a></li>
                        <li class="{{ Request::is('pengaduan-ditolak*') ? 'active' : '' }}"><a href="/pengaduan-ditolak"
                                class="nav-link">Pengaduan Di Tolak</a></li>
                    </ul>
                </li>
            @endcan
        </ul>
    </aside>
</div>
