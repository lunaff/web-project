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

@section('main')
    @include('table2')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('kegiatan.form', ['kegiatan' => '__kegiatan_id__']) }}";
        const docUrlBase = "{{ route('kegiatan.dokumentasi', ['kegiatan' => '__kegiatan_id__']) }}";

        new gridjs.Grid({
            columns: [
                { name: "ID", hidden: true }, 
                "Tanggal",
                "Nama",
                "Penyelenggara",
                // {
                //     name: "Dokumentasi",
                //     formatter: (cell) => {
                //         return cell ? gridjs.html(`<img src="{{ asset('storage') }}/${cell}" alt="Foto Kegiatan" width="100">`) : 'Tidak ada gambar';
                //     }
                // },
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <div style="display: flex; gap: 10px;">
                            <a href="${editUrlBase.replace('__kegiatan_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                <i class="fas fa-upload"></i>
                            </a>
                            <a href="${docUrlBase.replace('__kegiatan_id__', row.cells[0].data)}" class="btn btn-sm btn-info">
                                <i class="fas fa-images"></i>
                            </a>
                        </div>
                    `)
                },
            ],
            server: {
                url: '/kegiatan/data',
                then: data => {
                    return data.map(kegiatan => [
                        kegiatan.id,
                        kegiatan.tanggal,
                        kegiatan.nama,
                        kegiatan.penyelenggara,
                        // kegiatan.dokumentasi,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
