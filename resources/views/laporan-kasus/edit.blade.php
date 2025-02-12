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
                                    @method('PUT') <!-- Method untuk update -->

                                    <!-- Input Tanggal -->
                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $laporanKasus->tanggal) }}">
                                        @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Input Nama Siswa dengan Modal -->
                                    <div class="mb-3">
                                        <label for="kdsiswa">Nama Siswa</label>
                                        <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa', $laporanKasus->kdsiswa) }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" placeholder="Nama Siswa" id="nama_siswa" name="nama_siswa" aria-label="nama_siswa" value="{{ old('nama_siswa', $laporanKasus->siswa->nama_lengkap) }}" aria-describedby="cari" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalSiswa">
                                                    Cari Siswa
                                                </button>
                                            </div>
                                        </div>
                                        @error('kdsiswa') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Input Kasus -->
                                    <div class="mb-3">
                                        <label for="kasus">Kasus</label>
                                        <textarea rows="5" class="form-control @error('kasus') is-invalid @enderror" id="kasus" name="kasus">{{ old('kasus', $laporanKasus->kasus) }}</textarea>
                                        @error('kasus') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Input Bukti -->
                                    <div class="mb-3">
                                        <label for="bukti" class="form-label">Bukti</label>
                                        <input type="file" id="bukti" name="bukti" class="form-control" placeholder="Bukti" aria-label="Bukti">
                                        @if($laporanKasus->bukti)
                                            <a href="{{ asset('storage/' . $laporanKasus->bukti) }}" target="_blank">Lihat Bukti</a>
                                        @endif
                                    </div>

                                    <!-- Input Tindak Lanjut -->
                                    <div class="mb-3">
                                        <label for="tindak_lanjut">Tindak Lanjut</label>
                                        <input type="text" class="form-control @error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut" placeholder="Tindak Lanjut" name="tindak_lanjut" value="{{ old('tindak_lanjut', $laporanKasus->tindak_lanjut) }}">
                                        @error('tindak_lanjut') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Dropdown Status -->
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                            <option value="" selected hidden>Pilih Status</option>
                                            <option value="penanganan_walas" @if(old('status', $laporanKasus->status) == 'penanganan_walas') selected @endif>Penanganan Walas</option>
                                            <option value="penanganan_kesiswaan" @if(old('status', $laporanKasus->status) == 'penanganan_kesiswaan') selected @endif>Penanganan Kesiswaan</option>
                                            <option value="selesai" @if(old('status', $laporanKasus->status) == 'selesai') selected @endif>Selesai</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Input Dampingan BK -->
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

                                    <!-- Input Semester -->
                                    <div class="mb-3">
                                        <label for="semester">Semester</label>
                                        <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester">
                                            <option value="" selected hidden>Pilih Semester</option>
                                            <option value="Ganjil" @if(old('semester', $laporanKasus->semester) == 'Ganjil') selected @endif>Ganjil</option>
                                            <option value="Genap" @if(old('semester', $laporanKasus->semester) == 'Genap') selected @endif>Genap</option>
                                        </select>
                                        @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Input Tahun Ajaran -->
                                    <div class="mb-3">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="yyyy/yyyy" name="tahun_ajaran" value="{{ old('tahun_ajaran', $laporanKasus->tahun_ajaran) }}">
                                        @error('tahun_ajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Modal Siswa -->
                                    @include('laporan-kasus.modal-siswa') <!-- Pisahkan modal ke file terpisah -->

                                    <!-- Tombol Simpan dan Batal -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('laporan-kasus.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>

                                <!-- Form Delete -->
                                <form id="deleteForm" action="{{ route('laporan-kasus.destroy', $laporanKasus->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Delete Confirmation -->
    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>

    <!-- Script untuk Modal Siswa -->
    <script>
        function pilihSiswa(id, nama) {
            document.getElementById('kdsiswa').value = id;
            document.getElementById('nama_siswa').value = nama;
            $('#modalSiswa').modal('hide'); // Tutup modal setelah memilih
        }
    </script>
@endsection
