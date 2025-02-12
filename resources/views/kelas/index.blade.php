@extends('dashboard.master')
@section('title', 'Kelas')
@section('message', 'Kelas')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kelas')
@section('create', route('kelas.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('kelas.edit', ['kela' => '__kelas_id__']) }}";
        const deleteUrl = "{{ route('kelas.destroy', ['kela' => '__kelas_id__']) }}";

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                'Kelas',
                'Wali Kelas',
                'Kompetensi Keahlian',
                'Tahun Ajaran',
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__kelas_id__', row.cells[4].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__kelas_id__', row.cells[4].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this kelas?');">
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
                url: '/kelas/data', // The URL to fetch user data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(kelas => [
                        kelas.kelas,
                        kelas.guru_nip,
                        kelas.kdkompetensi,
                        kelas.tahun_ajaran,
                        kelas.id
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