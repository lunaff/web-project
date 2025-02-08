<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KompetensiKeahlianController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

// Route untuk login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route untuk halaman dashboard
// Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('dashboard', [DashboardController::class, 'index']);
Route::resource('dashboard', DashboardController::class);
Route::resource('user', UserController::class);
Route::resource('guru', GuruController::class);
Route::resource('kompetensi-keahlian', KompetensiKeahlianController::class);
Route::resource('kelas', KelasController::class);
Route::resource('siswa', SiswaController::class);

// Route default yang mengarah ke dashboard setelah login
// Route::get('/', function () {
//     return redirect('/dashboard');
// })->middleware('auth');
