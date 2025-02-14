@extends('dashboard.master')
@section('title', 'Kunjungan Rumah')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'Kunjungan Rumah')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Add Data Kunjungan Rumah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kunjungan-rumah.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="idKasus" id="idKasus">
                                <div class="mb-3">
                                    <label for="namaKasus" class="form-label">Kasus</label>
                                    <div class="input-group">
                                        <input type="text" id="namaKasus" class="form-control" placeholder="Pilih Kasus" readonly required>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKasus">Cari Data Kasus</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="solusi" class="form-label">Solusi</label>
                                    <textarea name="solusi" id="solusi" class="form-control"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="surat" class="form-label">Surat (Opsional)</label>
                                    <input type="file" name="surat" id="surat" class="form-control" accept=".pdf,.doc,.docx">
                                </div>

                                <div class="mb-3">
                                    <label for="dokumentasi" class="form-label">Dokumentasi (Opsional)</label>
                                    <input type="file" name="dokumentasi" id="dokumentasi" class="form-control" accept="image/*">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('kunjungan-rumah.index') }}" class="btn btn-danger">Batal</a>

                                <div class="modal fade" id="modalKasus" tabindex="-1" aria-labelledby="modalKasusLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalKasusLabel">Pilih Kasus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered" id="tableKasus">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kasus</th>
                                                            <th>Siswa</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($laporanKasus as $index => $kasus)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $kasus->kasus }}</td>
                                                            <td>{{ $kasus->siswa->nama_lengkap }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-sm" onclick="pilihSiswa('{{ $kasus->id }}', '{{ $kasus->nama_lengkap }}')" data-bs-dismiss="modal">
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
    function pilihKasus(id, namaKasus) {
        event.preventDefault();
        document.getElementById('idKasus').value = id;
        document.getElementById('namaKasus').value = namaKasus;
    }
</script>
@endsection
