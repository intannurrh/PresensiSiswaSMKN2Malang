<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\RekapKehadiran;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Presensi;
use App\Models\Attendance;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;

Route::post('/check-login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/', function () {return view('layout.user_select');});
Route::get('/login', function () {return view('layout.login');});


Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/profile', [OrtuController::class, 'profile'])->name('ortu.profile');
});

Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/presensi', [SiswaController::class, 'formAbsen'])->name('siswa.presensi'); // ganti ke formAbsen
    Route::post('/presensi', [SiswaController::class, 'presensi'])->name('siswa.presensi.submit');
    Route::get('/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
});

Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
    Route::delete('/presensi/{id}', [GuruController::class, 'destroy'])->name('destroy'); // Sesuaikan di blade;
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('laporan');
    Route::get('/datasiswa', [GuruController::class, 'dataAnakKelasSaya'])->name('datasiswa');
    Route::get('/download-csv', [GuruController::class, 'downloadCSV'])->name('downloadCSV');
    Route::get('/laporan/download', [GuruController::class, 'downloadLaporanExcel'])->name('downloadLaporan');
});
Route::get('/guru/profile', [GuruController::class, 'profile'])->name('guru.profile');

