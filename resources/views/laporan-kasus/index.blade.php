@extends('dashboard.master')

@section('title', 'Laporan Kasus')
@section('message', 'Daftar Laporan Kasus')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
    <style>
        .table-container {
            position: relative;
            margin: 20px;
        }

        #gridjs {
            z-index: 1;
            /* Menurunkan z-index Grid.js supaya tombol di atasnya */
        }
    </style>
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Laporan Kasus')
@section('create', route('laporan-kasus.create'))

@section('main')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="container">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Data @yield('page')</h3>
                            <div class="group">
                                <a href="@yield('create')" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <!-- Grid.js Tabel -->
                            <div id="gridjs"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        new gridjs.Grid({
            columns: [{
                    name: "No",
                    formatter: (_, row) => `${row.cells[0].data}.` // Nomor dengan tanda titik
                },
                "Tanggal",
                "Nama Siswa",
                "Kasus",
                {
                    name: "Bukti",
                    formatter: (cell) => cell ? gridjs.html(
                        `<a href="/storage/${cell}" target="_blank">Lihat</a>`) : '-'
                },
                "Tindak Lanjut",
                "Status",
                {
                    name: "Dampingan BK",
                    formatter: (cell) => cell ? 'Ya' : 'Tidak'
                },
                "Semester",
                "Tahun Ajaran",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
        <div>
            <a href="/laporan-kasus/${row.cells[1].data}/edit" class="btn btn-sm btn-primary">
                <i class="fa fa-edit"></i>
            </a>
            <button class="btn btn-sm btn-danger" onclick="deleteData('${row.cells[1].data}')">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    `)
                }
            ],
            server: {
                url: '/laporan-kasus/show', // Endpoint untuk mengambil data
                then: data => data.map(item => [
                    item.no, // Nomor urut
                    // item.id, // ID untuk action
                    item.tanggal,
                    item.nama_siswa,
                    item.kasus,
                    item.bukti,
                    item.tindak_lanjut,
                    item.status,
                    item.dampingan_bk,
                    item.semester,
                    item.tahun_ajaran
                ])
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"))
    </script>
@endsection
