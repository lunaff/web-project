@extends('dashboard.master')
@section('title', 'Siswa')
@section('message', 'Siswa')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Siswa')
@section('link', route('siswa.create'))

@section('main')
    @include('404')
@endsection