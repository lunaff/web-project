<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-dark-sm.png" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="28">
            </span>
        </a>

        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo-light-sm.png" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Dashboard</li>

                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i class="bx bx-home-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('calendar.index') }}">
                        <i class="bx bx-calendar icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar">Calendar</span>
                    </a>
                </li>

                @if(in_array(Auth::user()->level, ['admin', 'operator']))

                <li class="menu-title" data-key="t-master">Data Master</li>

                <li class="{{ request()->routeIs('user.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('user.index') }}">
                        <i class="bx bx-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-user">User</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('guru.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('guru.index') }}">
                        <i class="bx bxs-graduation icon nav-icon"></i>
                        <span class="menu-item" data-key="t-guru">Guru</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('kompetensi-keahlian.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('kompetensi-keahlian.index') }}">
                        <i class="bx bxs-school icon nav-icon"></i>
                        <span class="menu-item" data-key="t-kompetensi-keahlian">Kompetensi Keahlian</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('kelas.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('kelas.index') }}">
                        <i class="bx bxs-chalkboard icon nav-icon"></i>
                        <span class="menu-item" data-key="t-kelas">Kelas</span>
                    </a>
                </li>

                <!-- <li class="{{ request()->routeIs('siswa.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('siswa.index') }}">
                        <i class="bx bx-user-pin icon nav-icon"></i>
                        <span class="menu-item" data-key="t-siswa">Siswa</span>
                    </a>
                </li> -->

                <li class="{{ request()->routeIs('siswa.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-user-pin icon nav-icon"></i>
                        <span class="menu-item" data-key="t-siswa">Siswa</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('siswa.index') }}" data-key="t-siswa-list">List Siswa</a></li>
                        <li><a href="{{ route('siswa.registrasi.mutasi') }}" data-key="t-registrasi-mutasi">Registrasi & Mutasi</a></li>
                    </ul>
                </li>

                @endif

                <li class="menu-title" data-key="t-kesiswaan">Kesiswaan</li>

                <li class="{{ request()->routeIs('prestasi.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('prestasi.index') }}">
                        <i class="bx bx-trophy icon nav-icon"></i>
                        <span class="menu-item" data-key="t-prestasi">Prestasi</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('kegiatan.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('kegiatan.index') }}">
                        <i class="bx bx-calendar-event icon nav-icon"></i>
                        <span class="menu-item" data-key="t-kegiatan">Kegiatan Sekolah</span>
                    </a>
                </li>

                @if(Auth::user()->level != 'osis')

                <li class="{{ request()->routeIs('laporan-kasus.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('laporan-kasus.index') }}">
                        <i class="bx bx-file-find icon nav-icon"></i>
                        <span class="menu-item" data-key="t-lap-kasus">Laporan Kasus</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('pelanggaran.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('pelanggaran.index') }}">
                        <i class="bx bx-error-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-pelanggaran">Pelanggaran</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('pembinaan.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('pembinaan.index') }}">
                        <i class="bx bx-book-bookmark icon nav-icon"></i>
                        <span class="menu-item" data-key="t-pembinaan">Pembinaan</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('kunjungan-rumah.*') ? 'mm-active' : '' }}"    >
                    <a href="{{ route('kunjungan-rumah.index') }}">
                        <i class="bx bx-home icon nav-icon"></i>
                        <span class="menu-item" data-key="t-kunjungan-rumah">Kunjungan Rumah</span>
                    </a>
                </li>

                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<header class="ishorizontal-topbar">
    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            </nav>
        </div>
    </div>
</header>