@extends('dashboard.master')
@section('title', 'Kegiatan')
@section('message', 'Kegiatan')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kegiatan')
@section('link', route('kegiatan.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        new gridjs.Grid({
            columns: [
                "Tanggal",
                "Nama",
                "Penyelenggara",
                "Dokumentasi",
                "Option",
            ],
            server: {
                url: '/kegiatan/data',
                then: data => {
                    return data.map(kegiatan => [
                        kegiatan.tanggal,
                        kegiatan.nama,
                        kegiatan.penyelenggara,
                        kegiatan.dokumentasi,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
