@extends('dashboard.master')
@section('title', 'Kompetensi Keahlian')
@section('message', 'Kompetensi Keahlian')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kompetensi Keahlian')
@section('create', route('kompetensi-keahlian.create'))
@section('import', route('kompetensi-keahlian.import'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        const editUrlBase = "{{ route('kompetensi-keahlian.edit', ['kompetensi_keahlian' => '__kompetensi_id__']) }}";
        const deleteUrl = "{{ route('kompetensi-keahlian.destroy', ['kompetensi_keahlian' => '__kompetensi_id__']) }}";

        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                'Kompetensi Keahlian',
                'Kepala Kompetensi Keahlian',
                'Tahun Ajaran',
                {
                    name: "Actions",
                    formatter: (cell, row) => gridjs.html(`
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="${editUrlBase.replace('__kompetensi_id__', row.cells[3].data)}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="${deleteUrl.replace('__kompetensi_id__', row.cells[3].data)}" method="POST" onsubmit="return confirm('Are you sure you want to delete this kompetensi keahlian?');">
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
                url: '/kompetensi-keahlian/data', // The URL to fetch user data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(kompetensi => [
                        kompetensi.kompetensi_keahlian,
                        kompetensi.guru_nip,
                        kompetensi.tahun_ajaran,
                        kompetensi.id
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