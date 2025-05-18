<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard(Request $request)
{
    $data = session('get_data');

    if (!$data) {
        return redirect('/login')->with('error', 'Session tidak ditemukan, silakan login lagi.');
    }

    $siswa = DB::table('siswa')->where('id_user', $data->id_user)->first();

    if (!$siswa) {
        return redirect('/login')->with('error', 'Data siswa tidak ditemukan.');
    }

    $presensis = DB::table('presensis')
        ->where('siswa_id', $siswa->id_siswa)
        ->orderBy('tanggal', 'desc')
        ->limit(5)
        ->get();

    $pengumuman = DB::table('pengumuman')
        ->orderBy('tanggal', 'desc')
        ->limit(3)
        ->get();

    // DI SINI: Menambahkan $siswa ke dalam compact
    return view('siswa.dashboard', compact('presensis', 'pengumuman', 'siswa'));
}


    public function rekap()
    {
        $user = Auth::user();

        $rekap = DB::table('presensis')
            ->where('siswa_id', $user->id_siswa)
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