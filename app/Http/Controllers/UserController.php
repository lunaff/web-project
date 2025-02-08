<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index'); // Pastikan view ada di resources/views/dashboard/dashboard.blade.php
    }
}
