@extends('dashboard.master')
@section('title', 'Dashboard')
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection
@section('page', 'Dashboard')
@section('main')
    @include('dashboard.main')
@endsection