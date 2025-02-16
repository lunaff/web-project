@extends('dashboard.master')

@section('title', 'Pelanggaran')
@section('message', 'Daftar Pelanggaran')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
<style>
    .table-container {
        position: relative;
        margin: 20px;
    }
    #gridjs {
        z-index: 1;
    }
</style>
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pelanggaran')
@section('create', route('pelanggaran.create'))

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
    columns: [
        "No",
        "Tanggal",
        "Jenis",
        "Keterangan",
        "Nama Siswa",
        {
            name: "Bukti",
            formatter: (cell) => cell ? gridjs.html(`<a href="${cell}" target="_blank">Lihat</a>`) : '-'
        },
        "Sanksi",
        {
            name: "Actions",
            formatter: (cell, row) => gridjs.html(`
                <div style="display: flex; gap: 10px;">
                    <a href="/pelanggaran/${row.cells[7].data}/edit" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="/pelanggaran/${row.cells[7].data}" method="POST" onsubmit="return confirm('Are you sure want to delete this pelanggaran?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            `)
        }
    ],
    server: {
        url: '/pelanggaran/show',
        then: data => data.map(item => [
            item.no,
            item.tanggal,
            item.jenis,
            item.keterangan,
            item.nama_siswa,
            item.bukti,
            item.sanksi,
            item.id
        ])
    },
    pagination: true,
    search: true,
    sort: true,
}).render(document.getElementById("gridjs"));
</script>
@endsection
