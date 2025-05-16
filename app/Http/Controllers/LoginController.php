<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showProfil()
    {
        $data = session('get_data');  // Ambil dari session
        if (!$data) {
            return redirect()->route('login')->withErrors(['error' => 'Data tidak ditemukan.']);
        }
        return view('siswa.profil', compact('data'));
    }



    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah data user berhasil diambil
            $siswa = DB::table('siswa')
                ->leftJoin('guru', 'siswa.id_guru', '=', 'guru.id_guru')
                ->where('siswa.nis', $user->nis)
                ->select(
                    'siswa.nis',
                    'siswa.nama',
                    'siswa.nama_ortu',
                    'guru.nama as wali_kelas',
                    'siswa.kelas',
                    'siswa.jurusan'
                )
                ->first();

            // Debug hasil query
            dd($siswa);

            session(['get_data' => $siswa]);
            return redirect()->route('siswa.dashboard');
        } else {
            return back()->withErrors(['login' => 'NIS atau password salah']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}