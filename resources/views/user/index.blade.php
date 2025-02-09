@extends('dashboard.master')
@section('title', 'User')
@section('message', 'User')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'User')
@section('create', route('user.create'))

@section('main')
    @include('table')
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        // Initialize Grid.js with dynamic data
        new gridjs.Grid({
            columns: [
                "Name",
                "Email",
                "Level",
                "Guru NIP",
                "Siswa NIS",
            ],
            server: {
                url: '/user/data', // The URL to fetch user data
                then: data => {
                    // Map the data from the response to Grid.js format
                    return data.map(user => [
                        user.name,
                        user.email,
                        user.level,
                        user.guru_nip,
                        user.siswa_nis,
                    ]);
                }
            },
            pagination: true, // Enable pagination
            search: true, // Enable search
            sort: true, // Enable sorting
        }).render(document.getElementById("gridjs"));
    </script>
@endsection