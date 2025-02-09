<?php

use App\Models\Prestasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KompetensiKeahlianController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KegiatanController;


Route::get('/login', function () {
    return redirect('/dashboard.dashboard');
})->middleware('auth');

// Route untuk login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::resource('dashboard', DashboardController::class);
Route::resource('user', UserController::class);
Route::resource('guru', GuruController::class);
Route::resource('kompetensi-keahlian', KompetensiKeahlianController::class);
Route::resource('kelas', KelasController::class);
Route::resource('siswa', SiswaController::class);
Route::resource('prestasi', PrestasiController::class);
Route::resource('kegiatan', KegiatanController::class);

