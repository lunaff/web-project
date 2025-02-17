@extends('dashboard.master')
@section('title', 'Kunjungan Rumah')
@section('message', 'Kunjungan Rumah')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kunjungan Rumah')
@section('create', route('kunjungan-rumah.create'))

@section('main')
    @include('table1')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('kunjungan-rumah.edit', ['kunjungan_rumah' => '__kunjungan_rumah_id__']) }}";
        const deleteUrlBase = "{{ route('kunjungan-rumah.destroy', ['kunjungan_rumah' => '__kunjungan_rumah_id__']) }}";

        new gridjs.Grid({
            columns: [
                { name: "ID", hidden: true },
                "Tanggal",
                "Nama Siswa",
                "Kasus",
                "Solusi",
                "Surat",
                {
                    name: "Dokumentasi",
                    formatter: (cell) => {
                        return cell ? gridjs.html(`<img src="{{ asset('storage') }}/${cell}" alt="Dokumentasi" width="100">`) : 'Tidak ada gambar';
                    }
                },
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <div style="display: flex; gap: 10px;">
                            <a href="${editUrlBase.replace('__kunjungan_rumah_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="${deleteUrlBase.replace('__kunjungan_rumah_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                url: '/kunjungan-rumah/data',
                then: data => {
                    return data.map(kunjungan => [
                        kunjungan.id,
                        kunjungan.tanggal,
                        kunjungan.nama_siswa,
                        kunjungan.kasus,
                        kunjungan.solusi,
                        kunjungan.surat,
                        kunjungan.dokumentasi
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
