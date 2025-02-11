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
@section('create', route('prestasi.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        new gridjs.Grid({
            columns: [
                "Tanggal",
                "Jenis Prestasi",
                "Deskripsi",
                "Siswa/i",
                "Tanggal Dokumentasi",
                {
                    name: "Dokumentasi",
                    formatter: (cell) => {
                        return cell ? gridjs.html(`<img src="{{ asset('storage') }}/${cell}" alt="Foto Prestasi" width="100">`) : 'Tidak ada gambar';
                    }
                },
                "Option",
            ],
            server: {
                url: '/prestasi/data',
                then: data => {
                    return data.map(prestasi => [
                        prestasi.tanggal,
                        prestasi.jenis,
                        prestasi.deskripsi,
                        prestasi.siswa_id,
                        prestasi.tanggal_dokumentasi,
                        prestasi.foto,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
