@extends('dashboard.master')
@section('title', 'Pelanggaran')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pelanggaran')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Add New Data Pelanggaran</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pelanggaran.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                        @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="jenis">Jenis</label>
                                        <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                            <option value="" selected hidden>Pilih Jenis Pelanggaran</option>
                                            <option value="terlambat" @if(old('jenis')=='terlambat' ) selected @endif>Terlambat</option>
                                            <option value="perilaku" @if(old('jenis')=='perilaku' ) selected @endif>Perilaku</option>
                                            <option value="penampilan" @if(old('jenis')=='penampilan' ) selected @endif>Penampilan</option>
                                            <option value="asusila" @if(old('jenis')=='asusila' ) selected @endif>Asusila</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea rows="5" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                        @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="bukti" class="form-label">Bukti</label>
                                        <input type="file" id="bukti" name="bukti" class="form-control"
                                            placeholder="Bukti" aria-label="Bukti">
                                    </div>

                                    <div class="mb-3">
                                        <label for="sanksi">Sanksi</label>
                                        <input type="text" class="form-control @error('sanksi') is-invalid @enderror" id="sanksi" placeholder="Sanksi" name="sanksi" value="{{ old('sanksi') }}">
                                        @error('sanksi') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('pelanggaran.index') }}" class="btn btn-danger">Batal</a>
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
