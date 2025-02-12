@extends('dashboard.master')

@section('title', 'Pelanggaran')
@section('message', 'Daftar Pelanggaran')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pelanggaran')
@section('create', route('pelanggaran.create'))

@section('main')
    @include('table1')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        new gridjs.Grid({
            columns: [
                { name: "No", formatter: (_, row) => row.index + 1 },
                "Tanggal",
                "Jenis",
                "Keterangan",
                "Nama Siswa",
                "Bukti",
                "Sanksi",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <a href="/user/${row.cells[1].data}/edit" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="deleteData('${row.cells[1].data}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    `)
                }
            ],
            server: {
                url: '/pelanggaran/data',
                then: data => data.map(pelanggaran => [
                    pelanggaran.tanggal,
                    pelanggaran.jenis,
                    pelanggaran.keterangan,
                    pelanggaran.siswa.map(s => s.nama_lengkap).join(', '),
                    pelanggaran.bukti ?
                    `<a href="/storage/${pelanggaran.bukti}" target="_blank">Lihat</a>` : '-',
                    pelanggaran.sanksi,
                ])
            },
            pagination: {enabled: true, limit: 10},
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
