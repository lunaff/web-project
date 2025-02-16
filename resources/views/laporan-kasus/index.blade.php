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
    @include('table1')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('laporan-kasus.edit', ['laporan_kasu' => '__laporan_kasus_id__']) }}";
        const deleteUrl = "{{ route('laporan-kasus.destroy', ['laporan_kasu' => '__laporan_kasus_id__']) }}";

        new gridjs.Grid({
            columns: [
                // { name: "No", formatter: (_, row) => `${row.cells[0].data}.` },
                "Tanggal",
                "Nama Siswa",
                "Kasus",
                { name: "Bukti", formatter: (cell) => cell ? gridjs.html(`<a href="/storage/${cell}" target="_blank">Lihat</a>`) : '-' },
                "Tindak Lanjut",
                "Status",
                { name: "Dampingan BK", formatter: (cell) => cell ? 'Ya' : 'Tidak' },
                "Semester",
                "Tahun Ajaran",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__laporan_kasus_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__laporan_kasus_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this laporan kasus?');">
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
                    // item.no,
                    item.tanggal,
                    item.nama_siswa,
                    item.kasus,
                    item.bukti,
                    item.tindak_lanjut,
                    gridjs.html(`<span class="badge bg-${item.status === 'Selesai' ? 'success' : 'warning'}">${item.status}</span>`),
                    item.dampingan_bk,
                    item.semester,
                    item.tahun_ajaran
                ])
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
