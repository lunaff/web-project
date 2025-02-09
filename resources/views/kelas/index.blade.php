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
        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                'Kelas',
                'Wali Kelas',
                'Kompetensi Keahlian',
                'Tahun Ajaran',
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
                    ]);
                }
            },
            pagination: true, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection