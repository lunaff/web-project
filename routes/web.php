<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Route untuk login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk halaman dashboard
// Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('dashboard', [DashboardController::class, 'index']);

// Route default yang mengarah ke dashboard setelah login
// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');
