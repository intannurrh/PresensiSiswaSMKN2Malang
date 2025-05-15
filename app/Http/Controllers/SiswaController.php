<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = session('get_data');
        $kehadiran = DB::table('siswa')
            ->join('kehadiran', 'kehadiran.id_siswa', 'siswa.id_siswa')
            ->where('id_user', $data->id_user)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        return view('siswa.dashboard', compact('kehadiran', 'pengumuman'));
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