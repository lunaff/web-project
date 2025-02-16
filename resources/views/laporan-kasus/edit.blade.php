@extends('dashboard.master')
@section('title', 'Edit Laporan Kasus')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Edit Laporan Kasus')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Edit Data Laporan Kasus</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('laporan-kasus.update', $laporanKasus->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $laporanKasus->tanggal) }}">
                                        @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kdsiswa">Nama Siswa</label>
                                        <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa', $laporanKasus->kdsiswa) }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" placeholder="Nama Siswa" id="nama_siswa" name="nama_siswa" aria-label="nama_siswa" value="{{ old('nama_siswa', $laporanKasus->siswa->nama_lengkap) }}" aria-describedby="cari" readonly>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalSiswa">
                                                    Cari Siswa
                                                </a>
                                            </div>
                                        </div>
                                        @error('kdsiswa') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kasus">Kasus</label>
                                        <textarea rows="5" class="form-control @error('kasus') is-invalid @enderror" id="kasus" name="kasus">{{ old('kasus', $laporanKasus->kasus) }}</textarea>
                                        @error('kasus') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="bukti" class="form-label">Bukti (opsional)</label>
                                        <input type="file" id="bukti" name="bukti" class="form-control">
                                        @if($laporanKasus->bukti)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $laporanKasus->bukti) }}" target="_blank">Lihat Bukti</a>
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="checkbox" name="hapus_bukti" id="hapusBukti" value="1">
                                                    <label class="form-check-label" for="hapusBukti">Hapus Bukti</label>
                                                </div>
                                            </div>
                                        @endif
                                        @error('bukti') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tindak_lanjut">Tindak Lanjut</label>
                                        <input type="text" class="form-control @error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut" placeholder="Tindak Lanjut" name="tindak_lanjut" value="{{ old('tindak_lanjut', $laporanKasus->tindak_lanjut) }}">
                                        @error('tindak_lanjut') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Dampingan BK</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="dampingan_bk" id="dampingan_bk_ya" value="1" @if(old('dampingan_bk', $laporanKasus->dampingan_bk) == 1) checked @endif>
                                                    <label class="form-check-label" for="dampingan_bk_ya">Ya</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="dampingan_bk" id="dampingan_bk_tidak" value="0" @if(old('dampingan_bk', $laporanKasus->dampingan_bk) == 0) checked @endif>
                                                    <label class="form-check-label" for="dampingan_bk_tidak">Tidak</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semester">Semester</label>
                                        <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester">
                                            <option value="" selected hidden>Pilih Semester</option>
                                            <option value="Ganjil" @if(old('semester', $laporanKasus->semester) == 'Ganjil') selected @endif>Ganjil</option>
                                            <option value="Genap" @if(old('semester', $laporanKasus->semester) == 'Genap') selected @endif>Genap</option>
                                        </select>
                                        @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="yyyy/yyyy" name="tahun_ajaran" value="{{ old('tahun_ajaran', $laporanKasus->tahun_ajaran) }}">
                                        @error('tahun_ajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status_kasus" name="status">
                                            <option value="" selected hidden>Pilih Status</option>
                                            <option value="penanganan_walas" @if(old('status', $laporanKasus->status) == 'penanganan_walas') selected @endif>Penanganan Walas</option>
                                            <option value="penanganan_kesiswaan" @if(old('status', $laporanKasus->status) == 'penanganan_kesiswaan') selected @endif>Penanganan Kesiswaan</option>
                                            <option value="selesai" @if(old('status', $laporanKasus->status) == 'selesai') selected @endif>Selesai</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Modal Siswa -->
                                    <div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="modalSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalSiswaLabel">Pilih Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIS</th>
                                                                <th>Nama</th>
                                                                <th>Kelas</th>
                                                                <th>Jurusan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa as $key => $s)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $s->nis }}</td>
                                                                    <td>{{ $s->nama_lengkap }}</td>
                                                                    <td>{{ $s->fkelas->nama_kelas ?? '-' }}</td>
                                                                    <td>{{ $s->fkompetensi->nama_jurusan ?? '-' }}</td>
                                                                    <td>
                                                                        <a href="#" class="btn btn-primary btn-xs" onclick="pilih1('{{ $s->id }}', '{{ $s->nama_lengkap }}')" data-bs-toggle="modal">
                                                                            Pilih
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('laporan-kasus.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function pilih1(id, nama) {
            document.getElementById('kdsiswa').value = id;
            document.getElementById('nama_siswa').value = nama;
            // $('#staticBackdrop1').modal('hide');
        }
    </script>
@endsection
