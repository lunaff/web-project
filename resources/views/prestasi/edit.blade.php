@extends('dashboard.master')
@section('title', 'Edit Prestasi')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Edit Prestasi')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Edit Data Prestasi</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('prestasi.update', $prestasi->id) }}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $prestasi->tanggal) }}">
                                        @error('tanggal')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis">Jenis Prestasi</label>
                                        <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                            <option value="akademik" {{ old('jenis', $prestasi->jenis) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                            <option value="non-akademik" {{ old('jenis', $prestasi->jenis) == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                        </select>
                                        @error('jenis')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="siswa_id">Siswa/i</label>
                                        <input type="hidden" name="siswa_id" id="siswa_id" value="{{ old('siswa_id', $prestasi->siswa_id) }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Pilih Siswa" value="{{ old('nama_lengkap', $prestasi->siswa->nama_lengkap ?? '') }}" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                                    Cari Siswa/i
                                                </button>
                                            </div>
                                        </div>
                                        @error('siswa_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label for="tanggal_dokumentasi">Tanggal Dokumentasi</label>
                                        <input type="date" class="form-control @error('tanggal_dokumentasi') is-invalid @enderror" id="tanggal_dokumentasi" name="tanggal_dokumentasi" value="{{ old('tanggal_dokumentasi', $prestasi->tanggal_dokumentasi) }}">
                                        @error('tanggal_dokumentasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto">Foto Dokumentasi</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                        @error('foto')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @if($prestasi->foto)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="Foto Prestasi" width="150">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('prestasi.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel1">Pilih Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <table id="siswaTable" class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>NIS</th>
                                                                <th>Nama Lengkap</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($siswa as $data => $d)
                                                            <tr>
                                                                <td>{{ $data + 1 }}</td>
                                                                <td>{{ $d->nis }}</td>
                                                                <td>{{ $d->nama_lengkap }}</td>
                                                                <td>
                                                                    <a href="#" class="btn btn-sm btn-primary" onclick="pilihSiswa('{{ $d->id }}', '{{ $d->nama_lengkap }}')" data-bs-dismiss="modal">Pilih</a>
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
@endsection


@section('script')
    <script>
        $('#siswaTable').DataTable({
            "responsive": true,
        });

        function pilihSiswa(id, nama_lengkap) {
            document.getElementById('siswa_id').value = id; // Simpan NIS di input hidden
            document.getElementById('nama_lengkap').value = nama_lengkap; // Tampilkan Nama di input teks
        }
    </script>
@endsection