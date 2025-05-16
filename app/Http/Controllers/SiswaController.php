<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Siswa;

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
        $rekap = DB::table('presensis')
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

    public function profile()
    {
        $user = session('get_data');

        $siswa = Siswa::with(['guru', 'orangTua'])
            ->where('id_user', $user->id_user)
            ->first();

        return view('siswa.profile', compact('siswa'));
    }
}