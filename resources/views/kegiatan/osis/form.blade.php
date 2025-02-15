@extends('dashboard.master')
@section('title', 'Upload Dokumentasi Kegiatan')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'Upload Dokumentasi Kegiatan')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Upload Dokumentasi Kegiatan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kegiatan.upload', $kegiatan) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="kegiatan_id">Kegiatan</label>
                                    <input type="text" name="kegiatan_id" id="kegiatan_id" value="{{ $kegiatan->nama }} ({{ $kegiatan->tanggal }})" readonly class="form-control @error('kegiatan_id') is-invalid @enderror" placeholder="Pilih Kegiatan">
                                </div>

                                <div class="mb-3">
                                    <label for="file">Foto Dokumentasi</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file[]" multiple>
                                    @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    @if ($kegiatan->dokumentasi->isNotEmpty())
                                        @foreach ($kegiatan->dokumentasi as $foto)
                                            <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto Dokumentasi" width="150">
                                        @endforeach
                                    @else
                                        <p class="text-muted">Tidak ada dokumentasi</p>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    <a href="{{ route('osis-kegiatan.index') }}" class="btn btn-danger">Cancel</a>
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

<!-- @section('script')
<script>
    function pilihKegiatan(id, nama, tanggal) {
        event.preventDefault();
        // Mengisi input dengan nama kegiatan dan tanggal
        document.getElementById('kegiatan_id').value = id;
        document.getElementById('nama_kegiatan').value = nama + ' (' + tanggal + ')';
    }
</script>
@endsection -->