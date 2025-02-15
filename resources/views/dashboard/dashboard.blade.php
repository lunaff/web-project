@extends('dashboard.master')
@section('title', 'Dashboard')
@section('message', 'Welcome Back!')
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection
@section('page', 'Dashboard')
@section('main')
    @include('dashboard.main')
@endsection
@section('script')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection