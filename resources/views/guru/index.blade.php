@extends('dashboard.master')
@section('title', 'Guru')
@section('message', 'Guru')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Guru')

@section('main')
    @include('404')
@endsection