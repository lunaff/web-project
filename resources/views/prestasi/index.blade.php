@extends('dashboard.master')
@section('title', 'Prestasi')
@section('message', 'Prestasi')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Prestasi')
{{-- @section('link', route('prestasi.create')) --}}

@section('main')
    {{-- @include('404') --}}

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Prestasi Siswa</h4>
                                <a href="{{ route('prestasi.create') }}" class="btn btn-primary">Tambah Prestasi</a>
                            </div>                            
                            <div class="card-body">
                                <table class="table table-striped table-hover text-center"
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Deskripsi</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal Dokumentasi</th>
                                            <th>Foto</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestasi as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ ucfirst($item->jenis) }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>{{ $item->siswa_id }} - {{ optional($item->siswa_id)->nama ?? 'Tidak Diketahui' }}</td>
                                                <td>{{ $item->tanggal_dokumentasi ?? '-' }}</td>
                                                <td>
                                                    @if ($item->foto)
                                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Dokumentasi" width="80">
                                                    @else
                                                        Tidak Ada Foto
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('prestasi.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <form action="{{ route('prestasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>

    <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection