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

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                'Kompetensi Keahlian',
                'Kepala Kompetensi Keahlian',
                'Tahun Ajaran',
            ],
            server: {
                url: '/kompetensi-keahlian/data', // The URL to fetch user data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(kompetensi => [
                        kompetensi.kompetensi_keahlian,
                        kompetensi.guru_nip,
                        kompetensi.tahun_ajaran,
                    ]);
                }
            },
            pagination: true, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection