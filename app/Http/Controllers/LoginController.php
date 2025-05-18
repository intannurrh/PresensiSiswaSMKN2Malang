<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function showProfil()
    {
        $data = session('get_data');
        if (!$data) {
            return redirect()->route('login')->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        return view('siswa.profil', compact('data'));
    }
    public function login(Request $request)
    {
        $nomorPengenal = $request->nomor_pengenal;
        $password = $request->password;

        $user = DB::table('tb_user')
            ->where('nomor_pengenal', $nomorPengenal)
            ->where('password', $password)
            ->select('id_user', 'fullname', 'role', 'nomor_pengenal') // Pastikan ambil id_user
            ->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['login' => 'Nomor pengenal atau password salah.']);
        }

        // Login untuk siswa
        if ($user->role === 'siswa') {
            $siswa = DB::table('siswa')
                ->leftJoin('guru', 'siswa.id_guru', '=', 'guru.id_guru')
                ->leftJoin('orang_tua', 'siswa.id_siswa', '=', 'orang_tua.id_siswa')
                ->where('siswa.id_user', $user->id_user)
                ->select(
                    'siswa.nis',
                    'siswa.id_user',
                    'siswa.nama',
                    'guru.nama as wali_kelas',
                    'orang_tua.nama as nama_ortu',
                    'siswa.kelas',
                    'siswa.jurusan',
                    'siswa.id_siswa'
                )
                ->first();

            if (!$siswa) {
                return redirect()->route('login')->withErrors(['login' => 'Data siswa tidak ditemukan.']);
            }

            session([
                'get_data' => $siswa,
                'role' => 'siswa'
            ]);

            return redirect()->route('siswa.dashboard');
        }

        // Login untuk orang tua
        if ($user->role === 'orangtua') {
            $orangTua = DB::table('orang_tua')
                ->join('siswa', 'orang_tua.id_siswa', '=', 'siswa.id_siswa')
                ->where('orang_tua.id_user', $user->id_user)
                ->select(
                    'orang_tua.id_orangtua',
                    'orang_tua.id_user',
                    'orang_tua.nama as nama_orangtua',
                    'siswa.id_siswa',
                    'siswa.nama as nama_siswa',
                    'siswa.kelas',
                    'siswa.jurusan'
                )
                ->first();

            if (!$orangTua) {
                return redirect()->route('login')->withErrors(['login' => 'Data orang tua tidak ditemukan.']);
            }

            session([
                'get_data' => $orangTua,
                'role' => 'ortu'
            ]);

            return redirect()->route('ortu.dashboard');
        }

        // Tambahkan login untuk guru jika dibutuhkan
        return redirect()->route('login')->withErrors(['login' => 'Role tidak dikenali.']);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}