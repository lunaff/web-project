@extends('dashboard.master')
@section('title', 'Guru')
@section('message', 'Guru')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Guru')
@section('create', route('guru.create'))

@section('main')
    @include('table')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "NIP",
                "Nama Guru",
                "No Telp",
                "Jenis Kelamin",
                "Alamat",
                "Agama",
                "Tempat Lahir",
                "Tanggal Lahir",
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
                url: '/guru/data', // The URL to fetch guru data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(guru => [
                        guru.nip,
                        guru.nama_guru,
                        guru.notelp,
                        guru.jk,
                        guru.alamat,
                        guru.agama,
                        guru.tempat_lahir,
                        guru.tanggal_lahir,
                        null
                    ]);
                }
            },
            pagination: true, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection