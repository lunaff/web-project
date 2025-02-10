@extends('dashboard.master')
@section('title', 'Tambah Prestasi')
@section('message', 'Tambah Prestasi')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Tambah Prestasi')

@section('main')
    <form action="{{ route('prestasi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal Prestasi</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
            @error('tanggal')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis">Jenis Prestasi</label>
            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                <option value="">-- Pilih Jenis --</option>
                <option value="akademik" {{ old('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                <option value="non akademik" {{ old('jenis') == 'non akademik' ? 'selected' : '' }}>Non Akademik</option>
            </select>
            @error('jenis')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Prestasi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="siswa_id">Nama Siswa</label>
            <input type="hidden" name="siswa_id" id="siswa_id" value="{{ old('siswa_id') }}">
            <div class="input-group">
                <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" placeholder="Pilih Siswa" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}" readonly>
                <div class="input-group-append">
                    <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalSiswa">
                        Cari Siswa
                    </a>
                </div>
            </div>
            @error('siswa_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_dokumentasi">Tanggal Dokumentasi</label>
            <input type="date" class="form-control @error('tanggal_dokumentasi') is-invalid @enderror" id="tanggal_dokumentasi" name="tanggal_dokumentasi" value="{{ old('tanggal_dokumentasi') }}">
            @error('tanggal_dokumentasi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto">Upload Foto</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
            @error('foto')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('prestasi.index') }}" class="btn btn-default">Batal</a>
        </div>
    </form>

    <!-- Modal Pilih Siswa -->
    <div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="modalSiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSiswaLabel">Pilih Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>NIS</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $key => $s)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihSiswa('{{ $s->id }}', '{{ $s->nama }}')">
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

    <script>
        function pilihSiswa(id, nama) {
            document.getElementById('siswa_id').value = id;
            document.getElementById('nama_siswa').value = nama;
            $('#modalSiswa').modal('hide');
        }
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection
