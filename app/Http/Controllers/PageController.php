<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login() {
        return view('login');
    }

    public function dashboardSiswa() {
        return view('dashboard-siswa');
    }
    public function dashboardGuru() {
        return view('dashboard-guru');
    }

    public function dashboardOrtu() {
        return view('dashboard-ortu');
    }

    public function guru() {
        return view('guru');
    }

    public function rekapPresensi() {
        return view('rekap-presensi');
    }

    public function dataSiswa() {
        return view('data-siswa');
    }

    public function editData() {
        return view('edit-data');
    }

    public function siswa() {
        return view('siswa');
    }

    public function pendaftaranData() {
        return view('pendaftaran-data');
    }

    public function detailSiswa() {
        return view('detail-siswa');
    }
}
