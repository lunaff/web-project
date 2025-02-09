@extends('dashboard.master')
@section('title', 'Guru')
@section('message', 'Guru')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Guru')
@section('link', route('guru.create'))

@section('main')
    @include('404')
@endsection