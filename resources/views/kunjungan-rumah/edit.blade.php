@extends('dashboard.master')
@section('title', 'Edit Kunjungan Rumah')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'Edit Kunjungan Rumah')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Edit Kunjungan Rumah</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kunjungan-rumah.update', $kunjunganRumah->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="idKasus" class="form-label">Kasus</label>
                                    <input type="hidden" name="idKasus" id="idKasus" value="{{ $kunjunganRumah->idKasus }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="namaKasus" name="namaKasus" placeholder="Pilih Kasus" value="{{ optional($kunjunganRumah->laporanKasus)->kasus ?? '' }} - {{ optional($kunjunganRumah->laporanKasus->siswa)->nama_lengkap ?? '' }}" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalKasus">Cari Data Kasus</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $kunjunganRumah->tanggal }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="solusi" class="form-label">Solusi</label>
                                    <textarea name="solusi" id="solusi" class="form-control">{{ $kunjunganRumah->solusi }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="surat" class="form-label">Surat (Opsional)</label>
                                    <input type="file" name="surat" id="surat" class="form-control" accept=".pdf,.doc,.docx">
                                    @if ($kunjunganRumah->surat)
                                        <p>File saat ini: <a href="{{ asset('storage/' . $kunjunganRumah->surat) }}" target="_blank">Lihat Surat</a></p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="dokumentasi" class="form-label">Dokumentasi (Opsional)</label>
                                    <input type="file" name="dokumentasi" id="dokumentasi" class="form-control" accept="image/*">
                                    @if ($kunjunganRumah->dokumentasi)
                                        <p>Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $kunjunganRumah->dokumentasi) }}" alt="Dokumentasi" width="150">
                                    @endif
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
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="pilihKasus('{{ $kasus->id }}', '{{ $kasus->kasus }} - {{ $kasus->siswa->nama_lengkap }}')" data-bs-dismiss="modal">
                                                                    Pilih
                                                                </button>
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
