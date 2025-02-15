@extends('dashboard.master')
@section('title', 'Upload Dokumentasi Prestasi')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'Upload Dokumentasi Prestasi')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Upload Dokumentasi Prestasi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('prestasi.upload', $prestasi) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="prestasi_id">prestasi</label>
                                    <input type="text" name="prestasi_id" id="prestasi_id" value="{{ $prestasi->deskripsi }} ({{ $prestasi->tanggal }})" readonly class="form-control @error('prestasi_id') is-invalid @enderror" placeholder="Pilih prestasi">
                                </div>

                                <div class="mb-3">
                                    <label for="file">Foto Dokumentasi</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file[]" multiple>
                                    @error('file')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-2">
                                    @if ($prestasi->dokumentasi->isNotEmpty())
                                        @foreach ($prestasi->dokumentasi as $foto)
                                            <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto Dokumentasi" width="150">
                                        @endforeach
                                    @else
                                        <p class="text-muted">Tidak ada dokumentasi</p>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    <a href="{{ route('prestasi.index') }}" class="btn btn-danger">Cancel</a>
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
    function pilihKegiatan(id, deskripsi, tanggal) {
        event.preventDefault();
        document.getElementById('prestasi_id').value = id;
        document.getElementById('deskripsi_prestasi').value = deskripsi + ' (' + tanggal + ')';
    }
</script>
@endsection -->