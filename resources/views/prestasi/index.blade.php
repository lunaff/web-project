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
@section('create', route('prestasi.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('prestasi.edit', ['prestasi' => '__prestasi_id__']) }}";
        const deleteUrlBase = "{{ route('prestasi.destroy', ['prestasi' => '__prestasi_id__']) }}";
    
        new gridjs.Grid({
            columns: [
                { name: "ID", hidden: true }, 
                "Tanggal",
                "Jenis Prestasi",
                "Deskripsi",
                "Siswa/i",
                "Tanggal Dokumentasi",
                {
                    name: "Dokumentasi",
                    formatter: (cell) => {
                        return cell ? gridjs.html(`<img src="{{ asset('storage') }}/${cell}" alt="Foto Prestasi" width="100">`) : 'Tidak ada gambar';
                    }
                },
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <div style="display: flex; gap: 10px;">
                            <a href="${editUrlBase.replace('__prestasi_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="${deleteUrlBase.replace('__prestasi_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
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
                        prestasi.foto,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
