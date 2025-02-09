@extends('dashboard.master')
@section('title', 'Kompetensi Keahlian')
@section('message', 'Kompetensi Keahlian')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kompetensi Keahlian')
@section('link', route('kompetensi-keahlian.create'))

@section('main')
    @include('404')
@endsection