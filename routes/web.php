<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/dashboard-guru', function () {
    return view('dashboard-guru');
});

Route::get('/dashboard-ortu', function () {
    return view('dashboard-ortu');
});

Route::get('/dashboard-siswa', function () {
    return view('dashboard-siswa');
});

Route::get('/data-siswa', function () {
    return view('data-siswa');
});

Route::get('/detail-siswa', function () {
    return view('detail-siswa');
});

Route::get('/edit-data', function () {
    return view('edit-data');
});

Route::get('/guru', function () {
    return view('guru');
});*/


Route::get('/login', [PageController::class, 'login']);
Route::get('/dashboard-siswa', [PageController::class, 'dashboardSiswa']);
Route::get('/dashboard-ortu', [PageController::class, 'dashboardOrtu']);
Route::get('/dashboard-guru', [PageController::class, 'dashboardGuru']);
Route::get('/guru', [PageController::class, 'guru']);
Route::get('/rekap-presensi', [PageController::class, 'rekapPresensi']);
Route::get('/data-siswa', [PageController::class, 'dataSiswa']);
Route::get('/edit-data', [PageController::class, 'editData']);
Route::get('/siswa', [PageController::class, 'siswa']);
Route::get('/pendaftaran-data', [PageController::class, 'pendaftaranData']);
Route::get('/detail-siswa', [PageController::class, 'detailSiswa']);


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/data-siswa', [DashboardController::class, 'dataSiswa'])->name('data-siswa');
Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan');


Route::get('/data-siswa', [SiswaController::class, 'index'])->name('data.siswa');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');
