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
        const editUrlBase = "{{ route('siswa.edit', ['siswa' => '__siswa_id__']) }}";
        const deleteUrl = "{{ route('siswa.destroy', ['siswa' => '__siswa_id__']) }}";

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "NIS",
                {
                    name: "Nama Lengkap",
                    formatter: (cell, row) => {
                        const nis = row.cells[0].data; // Ambil NIS dari kolom pertama
                        const nama = cell; // Ambil nama siswa dari kolom ini
                        return gridjs.html(
                            `<a href="/track-record/${nis}" data-bs-toggle="tooltip" title="Ketuk untuk melihat profil siswa">${nama}</a>`
                        );
                    }
                },
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
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__siswa_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__siswa_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this siswa?');">
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
