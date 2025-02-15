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

@section('main')
    @include('table2')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('prestasi.form', ['prestasi' => '__prestasi_id__']) }}";
        const docUrlBase = "{{ route('prestasi.dokumentasi', ['prestasi' => '__prestasi_id__']) }}";

        new gridjs.Grid({
            columns: [
                { name: "ID", hidden: true }, 
                "Tanggal",
                "Jenis Prestasi",
                "Deskripsi",
                "Siswa/i",
                "Tanggal Dokumentasi",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <div style="display: flex; gap: 10px;">
                            <a href="${editUrlBase.replace('__prestasi_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                <i class="fas fa-upload"></i>
                            </a>
                            <a href="${docUrlBase.replace('__prestasi_id__', row.cells[0].data)}" class="btn btn-sm btn-info">
                                <i class="fas fa-images"></i>
                            </a>
                        </div>
                    `)
                },
            ],
            server: {
                url: '/prestasi/data',
                then: data => {
                    return data.map(prestasi => [
                        prestasi.id,
                        prestasi.tanggal,
                        prestasi.jenis,
                        prestasi.deskripsi,
                        prestasi.siswa_id,
                        prestasi.tanggal_dokumentasi,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
