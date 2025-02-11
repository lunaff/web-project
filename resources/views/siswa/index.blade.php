@extends('dashboard.master')
@section('title', 'Siswa')
@section('message', 'Siswa')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Siswa')
@section('create', route('siswa.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "NIS",
                "Nama Lengkap",
                "Kelas",
                "Kompetensi Keahlian",
                "Tempat Lahir",
                "Tanggal Lahir",
                "Alamat",
                "Agama",
                "No Telp",
                "Email",
                "NISN",
                "Tahun Masuk",
                "Nama Ayah",
                "Nama Ibu",
                "Alamat Orang Tua",
                "No Orang Tua",
                "Nama Sekolah Asal",
                "Alamat Sekolah",
                "Tahun Lulus",
                "Riwayat Penyakit",
                "Alergi",
                "Prestasi Akademik",
                "Prestasi Non Akademik",
                "Ekstrakurikuler",
                "Biografi",
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
                url: '/siswa/data', // The URL to fetch siswa data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(siswa => [
                        siswa.nis,
                        siswa.nama_lengkap,
                        siswa.kdkelas,
                        siswa.kdkompetensi,
                        siswa.tempat_lahir,
                        siswa.tanggal_lahir,
                        siswa.alamat,
                        siswa.agama,
                        siswa.no_hp,
                        siswa.email,
                        siswa.nisn,
                        siswa.tahun_masuk,
                        siswa.nama_ayah,
                        siswa.nama_ibu,
                        siswa.alamat_ortu,
                        siswa.no_ortu,
                        siswa.nama_sekolah_asal,
                        siswa.alamat_sekolah,
                        siswa.tahun_lulus,
                        siswa.riwayat_penyakit,
                        siswa.alergi,
                        siswa.prestasi_akademik,
                        siswa.prestasi_non_akademik,
                        siswa.ekstrakurikuler,
                        siswa.biografi,
                        null
                    ]);
                }
            },
            pagination: {
                limit: 20
            }, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection