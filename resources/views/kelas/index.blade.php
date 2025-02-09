@extends('dashboard.master')
@section('title', 'Kelas')
@section('message', 'Kelas')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Kelas')
@section('link', route('kelas.create'))

@section('main')
    @include('404')
@endsection