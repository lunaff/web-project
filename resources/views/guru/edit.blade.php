@extends('dashboard.master')
@section('title', 'Guru')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Guru')

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Edit Data Guru</h4>
                            </div>                            
                            <div class="card-body">
                                <form action="{{ route('guru.update', $guru) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" name="nip" value="{{ old('nip', $guru->nip) }}">
                                        @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_guru">Nama Guru</label>
                                        <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" id="nama_guru" placeholder="Nama Guru" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}">
                                        @error('nama_guru') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="notelp">No Telepon</label>
                                        <input type="text" class="form-control @error('notelp') is-invalid @enderror" id="notelp" placeholder="No. Telepon" name="notelp" value="{{ old('notelp', $guru->notelp) }}">
                                        @error('notelp') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label>Jenis Kelamin</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" id="jkL" value="L" 
                                                    @if(old('jk', $guru->jk) == 'L') checked @endif>
                                                    <label class="form-check-label" for="jkL">Laki-laki</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jk" id="jkP" value="P" 
                                                    @if(old('jk', $guru->jk) == 'P') checked @endif>
                                                    <label class="form-check-label" for="jkP">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea rows="5" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ old('alamat', $guru->alamat) }}</textarea>
                                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="agama">Agama</label>
                                        <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama">
                                            <option value="Islam" @if(old('agama', $guru->agama)=='Islam' ) selected @endif>Islam</option>
                                            <option value="Hindu" @if(old('agama', $guru->agama)=='Hindu' ) selected @endif>Hindu</option>
                                            <option value="Buddha" @if(old('agama', $guru->agama)=='Buddha' ) selected @endif>Budha</option>
                                            <option value="Katolik" @if(old('agama', $guru->agama)=='Katolik' ) selected @endif>Katolik</option>
                                            <option value="Protestan" @if(old('agama', $guru->agama)=='Protestan' ) selected @endif>Protestan</option>
                                            <option value="Lainnya" @if(old('agama', $guru->agama)=='Lainnya' ) selected @endif>Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}">
                                        @error('tempat_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}">
                                        @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('guru.index') }}" class="btn btn-danger">Batal</a>
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