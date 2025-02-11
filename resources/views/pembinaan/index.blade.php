@extends('dashboard.master')
@section('title', 'Pembinaan')
@section('message', 'Pembinaan')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Pembinaan')
@section('create', route('pembinaan.create'))

@section('main')
    @include('table')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script>
        new gridjs.Grid({
            columns: [
                "No",
                "Kasus",
                "Guru",
                "Tanggal Mulai",
                "Tanggal Selesai",
                "Durasi",
                "Status",
                "Note",
                "Option",
            ],
            server: {
                url: '/pembinaan/data',
                then: data => {
                    return data.map(pembinaan => [
                        pembinaan.no,
                        pembinaan.kasus,
                        pembinaan.guru,
                        pembinaan.tanggal_mulai,
                        pembinaan.tanggal_selesai,
                        pembinaan.durasi + " hari",
                        gridjs.html(`<span class="badge bg-${pembinaan.status === 'Kasus Selesai' ? 'success' : 'warning'}">${pembinaan.status}</span>`),
                        pembinaan.note,
                    ]);
                }
            },
            pagination: true,
            search: true,
            sort: true,
        }).render(document.getElementById("gridjs"));
    </script>
@endsection
