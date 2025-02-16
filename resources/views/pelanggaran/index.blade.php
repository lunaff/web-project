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
        const editUrlBase = "{{ route('pelanggaran.edit', ['pelanggaran' => '__pelanggaran_id__']) }}";
        const deleteUrlBase = "{{ route('pelanggaran.destroy', ['pelanggaran' => '__pelanggaran_id__']) }}";
        
        new gridjs.Grid({
            columns: [
                // { name: "No", formatter: (_, row) => row.index + 1 },
                "Tanggal",
                "Jenis",
                "Keterangan",
                "Nama Siswa",
                "Bukti",
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
