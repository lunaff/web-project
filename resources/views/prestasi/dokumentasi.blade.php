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
                            <h4 class="card-title mb-0">Dokumentasi Prestasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-4">
                                <h5 class="font-size-13 mb-2">
                                    @if (!empty(trim($prestasi->siswa->nama_lengkap)) && !empty(trim($prestasi->deskripsi)))
                                        {{ $prestasi->siswa->nama_lengkap }} - {{ $prestasi->deskripsi }}
                                    @elseif (!empty(trim($prestasi->siswa->nama_lengkap)))
                                        {{ $prestasi->siswa->nama_lengkap }}
                                    @elseif (!empty(trim($prestasi->deskripsi)))
                                        {{ $prestasi->deskripsi }}
                                    @endif
                                    - {{ $prestasi->tanggal }}
                                </h5>
                                <div class="bg-light-subtle p-3 text-center">
                                    <div class="row align-items-center" style="min-height: 6rem;">
                                        @foreach ($prestasi->dokumentasi as $foto)
                                        <div class="col-sm-4">
                                            <div class="grid-example mt-2 mt-sm-0">
                                                <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto Prestasi" class="img-fluid" width="150">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection