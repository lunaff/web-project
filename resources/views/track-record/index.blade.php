@extends('dashboard.master')
@section('title', 'Profile')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Profile')
@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="user-profile-img">
                                    <img src="{{ asset('assets/images/pattern-bg.jpg') }}"
                                        class="profile-img profile-foreground-img rounded-top" style="height: 120px;"
                                        alt="">
                                    <div class="overlay-content rounded-top">
                                        <div>
                                            <div class="user-nav p-3">
                                                <div class="d-flex justify-content-end">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end user-profile-img -->

                                <div class="p-4 pt-0">
                                    <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                            class="avatar-xl rounded-circle img-thumbnail">

                                        <div class="mt-3">
                                            <h5 class="mb-1">{{ $siswa->nama_lengkap }}</h5>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-3 border-bottom pb-3">
                                        <table
                                            class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="fw-bold">NISN :</th>
                                                    <td class="text-muted">{{ $siswa->nisn }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">NIS :</th>
                                                    <td class="text-muted">{{ $siswa->nis }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Nama Siswa :</th>
                                                    <td class="text-muted">{{ $siswa->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Kompetensi Keahlian :</th>
                                                    <td class="text-muted">{{ $siswa->fkompetensi->kompetensi_keahlian ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Kelas :</th>
                                                    <td class="text-muted">{{ $siswa->fkelas->kelas ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Tempat, Tanggal Lahir :</th>
                                                    <td class="text-muted">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Alamat :</th>
                                                    <td class="text-muted">{{ $siswa->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Agama :</th>
                                                    <td class="text-muted">{{ $siswa->agama }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Kewarganegaraan :</th>
                                                    <td class="text-muted">{{ $siswa->kewarganegaraan }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">No. HP :</th>
                                                    <td class="text-muted">{{ $siswa->no_hp }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Email :</th>
                                                    <td class="text-muted">{{ $siswa->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Nama Ayah :</th>
                                                    <td class="text-muted">{{ $siswa->nama_ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Nama Ibu :</th>
                                                    <td class="text-muted">{{ $siswa->nama_ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">No. HP Orang Tua :</th>
                                                    <td class="text-muted">{{ $siswa->no_ortu }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Nama Sekolah Asal :</th>
                                                    <td class="text-muted">{{ $siswa->nama_sekolah_asal }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-9">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#prestasi" role="tab">
                                            <span>Prestasi</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pelanggaran" role="tab">
                                            <span>Pelanggaran</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#laporan-kasus" role="tab">
                                            <span>Laporan Kasus</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#pembinaan" role="tab">
                                            <span>Pembinaan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Tab Prestasi -->
                            <div class="tab-pane active" id="prestasi" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-4">
                                            @if ($siswa->prestasi->isNotEmpty())
                                                <h5 class="font-size-16 mb-4">Prestasi</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Tanggal</th>
                                                                <th scope="col">Jenis</th>
                                                                <th scope="col">Tingkat</th>
                                                                <th scope="col">Deskripsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa->prestasi as $index => $prestasi)
                                                                <tr>
                                                                    <th scope="row">{{ $index + 1 }}</th>
                                                                    <td>{{ $prestasi->tanggal }}</td>
                                                                    <td>{{ $prestasi->jenis }}</td>
                                                                    <td>{{ $prestasi->tingkat }}</td>
                                                                    <td>{{ $prestasi->deskripsi }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted">Tidak ada data prestasi.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pelanggaran -->
                            <div class="tab-pane" id="pelanggaran" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-4">
                                            @if ($siswa->pelanggaran->isNotEmpty())
                                                <h5 class="font-size-16 mb-4">Pelanggaran</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Tanggal</th>
                                                                <th scope="col">Jenis</th>
                                                                <th scope="col">Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa->pelanggaran as $index => $pelanggaran)
                                                                <tr>
                                                                    <th scope="row">{{ $index + 1 }}</th>
                                                                    <td>{{ $pelanggaran->tanggal }}</td>
                                                                    <td>{{ $pelanggaran->jenis }}</td>
                                                                    <td>{{ $pelanggaran->keterangan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted">Tidak ada data pelanggaran.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Laporan Kasus -->
                            <div class="tab-pane" id="laporan-kasus" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-4">
                                            @if ($siswa->laporanKasus->isNotEmpty())
                                                <h5 class="font-size-16 mb-4">Laporan Kasus</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Tanggal</th>
                                                                <th scope="col">Kasus</th>
                                                                <th scope="col">Tindak Lanjut</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa->laporanKasus as $index => $kasus)
                                                                <tr>
                                                                    <th scope="row">{{ $index + 1 }}</th>
                                                                    <td>{{ $kasus->tanggal }}</td>
                                                                    <td>{{ $kasus->kasus }}</td>
                                                                    <td>{{ $kasus->tindak_lanjut }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted">Tidak ada data laporan kasus.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Pembinaan -->
                            <div class="tab-pane" id="pembinaan" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-4">
                                            @if ($siswa->laporanKasus->isNotEmpty())
                                                <h5 class="font-size-16 mb-4">Pembinaan</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-hover mb-1">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Tanggal Mulai</th>
                                                                <th scope="col">Tanggal Selesai</th>
                                                                <th scope="col">Durasi</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa->laporanKasus as $kasus)
                                                                @if ($kasus->pembinaan->isNotEmpty())
                                                                    @foreach ($kasus->pembinaan as $index => $pembinaan)
                                                                        <tr>
                                                                            <th scope="row">{{ $index + 1 }}</th>
                                                                            <td>{{ $pembinaan->tanggal_mulai }}</td>
                                                                            <td>{{ $pembinaan->tanggal_selesai }}</td>
                                                                            <td>{{ $pembinaan->hitungDurasi() }} hari</td>
                                                                            <td>{{ $pembinaan->status }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="5" class="text-center">Tidak ada
                                                                            data pembinaan untuk laporan kasus ini.</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-muted">Tidak ada data laporan kasus.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
