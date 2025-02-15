@extends('dashboard.master')
@section('title', 'Kegiatan')

@section('nav')
@include('dashboard.header')
@include('dashboard.nav')
@endsection

@section('page', 'Kegiatan')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Dokumentasi Kegiatan</h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-4">
                                <h5 class="font-size-13 mb-2">{{ $kegiatan->nama }} ({{ $kegiatan->tanggal }})</h5>
                                <div class="bg-light-subtle p-3 text-center">
                                    <div class="row align-items-center" style="min-height: 6rem;">
                                        @foreach ($kegiatan->dokumentasi as $foto)
                                        <div class="col-sm-4">
                                            <div class="grid-example mt-2 mt-sm-0">
                                                <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto Kegiatan" class="img-fluid" width="150">
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