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
        const editUrlBase = "{{ route('laporan-kasus.edit', ['laporan_kasus' => '__laporan_kasus_id__']) }}";
        const deleteUrl = "{{ route('laporan-kasus.destroy', ['laporan_kasus' => '__laporan_kasus_id__']) }}";

        new gridjs.Grid({
            columns: [
                {
                    name: "No",
                    formatter: (_, row) => `${row.cells[0].data}.`
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
                {
                    name: "Dampingan BK",
                    formatter: (cell) => cell ? 'Ya' : 'Tidak'
                },
                "Semester",
                "Tahun Ajaran",
                {
                    name: "Status",
                    formatter: (cell) => {
                        let badgeClass = '';
                        if (cell === 'penanganan_walas') {
                            badgeClass = 'badge bg-warning';
                            cell = 'Penanganan Walas';
                        } else if (cell === 'penanganan_kesiswaan') {
                            badgeClass = 'badge bg-danger';
                            cell = 'Penanganan Kesiswaan';
                        } else if (cell === 'selesai') {
                            badgeClass = 'badge bg-success';
                            cell = 'Selesai';
                        }
                        return gridjs.html(`<span class="${badgeClass}">${cell}</span>`);
                    }
                },
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__laporan_kasus_id__', row.cells[10].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__laporan_kasus_id__', row.cells[10].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this laporan kasus?');">
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
                url: '/laporan-kasus/show',
                then: data => data.map(item => [
                    item.no,
                    item.tanggal,
                    item.nama_siswa,
                    item.kasus,
                    item.bukti,
                    item.tindak_lanjut,
                    item.dampingan_bk,
                    item.semester,
                    item.tahun_ajaran,
                    item.status,
                    item.id
                ])
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
