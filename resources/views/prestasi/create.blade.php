@extends('dashboard.master')
@section('title', 'Prestasi')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Prestasi')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Add New Data Prestasi</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Tanggal" value="{{ old('tanggal') }}">
                                        @error('tanggal')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis">Jenis Prestasi</label>
                                        <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                            <option value="">Pilih jenis prestasi</option>
                                            <option value="akademik" {{ old('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                            <option value="non-akademik" {{ old('jenis') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                        </select>
                                        @error('jenis')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tingkat">Tingkat Prestasi</label>
                                        <select class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat">
                                            <option value="">Pilih tingkat prestasi</option>
                                            <option value="Kabupaten/Kota" {{ old('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                                            <option value="Provinsi" {{ old('tingkat') == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                                            <option value="Nasional" {{ old('tingkat') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                            <option value="Internasional" {{ old('tingkat') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                        </select>
                                        @error('tingkat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="siswa_id">Siswa/i</label>
                                        <input type="hidden" name="siswa_id" id="siswa_id" value="{{ old('siswa_id') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('siswa_id') is-invalid @enderror" placeholder="Nama Siswa" id="nama_lengkap" value="{{ old('nama_lengkap') }}" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCariSiswa">
                                                    Cari Siswa/i
                                                </button>
                                            </div>
                                        </div>
                                        @error('siswa_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="kelas-komp" style="display:none;">
                                        <label for="kelas">Kelas</label>
                                        <input type="text" class="form-control" id="kelas" name="kelas" readonly>
                                    </div>
                                    
                                    <div class="mb-3" id="kompetensi-komp" style="display:none;">
                                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                        <input type="text" class="form-control" id="kompetensi_keahlian" name="kompetensi_keahlian" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_dokumentasi">Tanggal Dokumentasi</label>
                                        <input type="date" class="form-control @error('tanggal_dokumentasi') is-invalid @enderror" id="tanggal_dokumentasi" name="tanggal_dokumentasi" value="{{ old('tanggal_dokumentasi') }}">
                                        @error('tanggal_dokumentasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="foto">Foto Dokumentasi</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                        @error('foto')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if(isset($prestasi) && $prestasi->foto)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="Foto Prestasi" width="150">
                                            </div>
                                        @endif
                                    </div> --}}

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('prestasi.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                    <!-- Modal Cari Siswa -->
                                    <div class="modal fade" id="modalCariSiswa" tabindex="-1" aria-labelledby="modalCariSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCariSiswaLabel">Pilih Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-striped" id="tableCariSiswa">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Nama Siswa/i</th>
                                                                <th>NIS</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($siswa as $key => $s)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $s->nama_lengkap }}</td>
                                                                <td>{{ $s->nis }}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary btn-sm" 
                                                                    onclick="pilihSiswa('{{ $s->id }}', '{{ $s->nama_lengkap }}', '{{ $s->kdkelas }}', '{{ $s->kdkompetensi }}')" 
                                                                    data-bs-dismiss="modal">
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        function pilihSiswa(id, nama_lengkap, kelas, kompetensi_keahlian) {
            // Set nilai siswa_id dan nama_lengkap
            document.getElementById('siswa_id').value = id;
            document.getElementById('nama_lengkap').value = nama_lengkap;

            // Set nilai kelas dan kompetensi keahlian
            document.getElementById('kelas').value = kelas;
            document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian;

            // Menampilkan field kelas dan kompetensi keahlian setelah memilih siswa
            document.getElementById('kelas-komp').style.display = 'block';
            document.getElementById('kompetensi-komp').style.display = 'block';
        }
    </script>
@endsection 