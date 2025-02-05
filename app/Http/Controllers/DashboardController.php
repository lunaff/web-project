<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method untuk menampilkan halaman dashboard
    public function index()
    {
        return view('dashboard.dashboard'); // Pastikan view ada di resources/views/dashboard/dashboard.blade.php
    }
}
