@extends('dashboard.master')
@section('title', 'Guru')
@section('message', 'Guru')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Guru')
@section('create', route('guru.create'))
@section('import', route('guru.import'))

@section('main')
    @include('table')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('guru.edit', ['guru' => '__guru_id__']) }}";
        const deleteUrl = "{{ route('guru.destroy', ['guru' => '__guru_id__']) }}";

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "NIP",
                "Nama Guru",
                "No Telp",
                "Jenis Kelamin",
                "Alamat",
                "Agama",
                "Tempat Lahir",
                "Tanggal Lahir",
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__guru_id__', row.cells[0].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__guru_id__', row.cells[0].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this guru?');">
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
                url: '/guru/data', // The URL to fetch guru data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(guru => [
                        guru.nip,
                        guru.nama_guru,
                        guru.notelp,
                        guru.jk,
                        guru.alamat,
                        guru.agama,
                        guru.tempat_lahir,
                        guru.tanggal_lahir
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