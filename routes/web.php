<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\RekapKehadiran;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Presensi;
use App\Models\Attendance;
use App\Http\Controllers\GuruController;

Route::get('/', function () {
    return view('guru.datasiswa');
});

Route::get('/2', function () {
    return view('guru.laporan');
});
Route::prefix('ortu')->group(function () {
    Route::get('/dashboard', [OrtuController::class, 'dashboard'])->name('ortu.dashboard');
    Route::get('/rekap', [OrtuController::class, 'rekap'])->name('ortu.rekap');
    Route::get('/pengumuman', [OrtuController::class, 'pengumuman'])->name('ortu.pengumuman');
    Route::get('/data-orang-tua', [OrtuController::class, 'getData']);
});
Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/rekap', [SiswaController::class, 'rekap'])->name('siswa.rekap');
    Route::get('/pengumuman', [SiswaController::class, 'pengumuman'])->name('siswa.pengumuman');
});
Route::get('/user-select', function () {
    return view('layout.user_select');
});

Route::get('/login', function () {
    return view('layout.login');
});


Route::get('/dashboard-guru', function () {
    return view('guru.dashboard');
});

Route::post('/check-login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
    Route::delete('/presensi/{id}', [GuruController::class, 'destroy'])->name('destroy'); // Sesuaikan di blade;
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('laporan');
    Route::get('/datasiswa', [GuruController::class, 'dataAnakKelasSaya'])->name('datasiswa');
    Route::get('/download-csv', [GuruController::class, 'downloadCSV'])->name('downloadCSV');
});
Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');

Route::get('/login', function () {
    return view('layout.login');
})->name('login');

Route::prefix('guru')->name('guru.')->middleware('auth:guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
    Route::get('/datasiswa', [GuruController::class, 'dataAnakKelasSaya'])->name('datasiswa');
});
