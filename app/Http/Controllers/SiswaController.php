<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    public function rekap()
    {
        $rekap = DB::table('presensi')
            ->where('siswa_id', auth()->user()->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.rekap', compact('rekap'));
    }

    public function pengumuman()
    {
        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.pengumuman', compact('pengumuman'));
    }
}
