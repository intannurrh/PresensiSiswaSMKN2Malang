<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrtuController extends Controller
{
    public function dashboard()
    {
        return view('ortu.dashboard');
    }

    // public function rekap() {
    //     return view('ortu.rekap'); // nanti bikin ortu/rekap.blade.php
    // }


    public function rekap()
    {
        // Data dummy untuk testing, ganti nanti dengan data dari database
        $ortu = [
            ['tanggal' => '2025-05-01', 'status' => 'Hadir'],
            ['tanggal' => '2025-05-02', 'status' => 'Izin'],
            ['tanggal' => '2025-05-03', 'status' => 'Alpha'],
        ];

        return view('ortu.rekap', compact('ortu'));
    }

    public function pengumuman()
    {
        $pengumuman = DB::table('pengumuman')->orderBy('tanggal', 'desc')->get();
        return view('ortu.pengumuman', compact('pengumuman'));
    }



}
