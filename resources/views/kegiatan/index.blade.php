@extends('dashboard.master')
@section('title', 'Kegiatan')
@section('message', 'Kegiatan')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kegiatan')
{{-- @section('link', route('prestasi.create')) --}}

@section('main')
    {{-- @include('404') --}}
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>

    <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection