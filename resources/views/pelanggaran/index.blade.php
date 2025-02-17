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
        const editUrlBase = "{{ route('pelanggaran.edit', ['pelanggaran' => '__pelanggaran_id__']) }}";
        const deleteUrlBase = "{{ route('pelanggaran.destroy', ['pelanggaran' => '__pelanggaran_id__']) }}";
        
        new gridjs.Grid({
            columns: [
                // { name: "No", formatter: (_, row) => row.index + 1 },
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
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__pelanggaran_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="${deleteUrlBase.replace('__pelanggaran_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    `)
                }
            ],
            server: {
                url: '/pelanggaran/data',
                then: data => data.map(item => [
                    // item.no,
                    item.tanggal,
                    item.jenis,
                    item.keterangan,
                    item.nama_siswa,
                    item.bukti,
                    item.sanksi,
                    item.id
                ])
            },
            pagination: {enabled: true, limit: 10},
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
