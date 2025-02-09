@extends('dashboard.master')
@section('title', 'Prestasi')
@section('message', 'Prestasi')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Prestasi')
{{-- @section('link', route('prestasi.create')) --}}

@section('main')
    {{-- @include('404') --}}

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Prestasi Siswa</h4>
                            </div>                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="mt-4 mt-xl-0">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form groups</h5>
                                            <form>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-firstname-input">First Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter First Name" id="formrow-firstname-input">
                                                </div>
    
                                                <div class="row">                                                            
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">Email</label>
                                                            <input type="email" class="form-control" placeholder="Enter Email" id="formrow-email-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-password-input">Password</label>
                                                            <input type="password" class="form-control" placeholder="Enter password" id="formrow-password-input">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="formrow-customCheck">
                                                    <label class="form-check-label" for="formrow-customCheck">Check me out</label>
                                                </div>
                                                
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
@endsection
@section('script')
    <script src="{{ asset('assets/libs/gridjs/gridjs.umd.js') }}"></script>

    <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
@endsection