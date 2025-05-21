<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Validasi input sederhana
        $request->validate([
            'nomor_pengenal' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        $nomorPengenal = $request->nomor_pengenal;
        $password = $request->password;
        $role = $request->role;

        // Cek user berdasarkan nomor pengenal dan role
        $user = DB::table('tb_user')
            ->where('nomor_pengenal', $nomorPengenal)
            ->where('role', $role)
            ->select('id_user', 'fullname', 'role', 'nomor_pengenal', 'password') // Ambil password dari DB
            ->first();

        // Kalau belum pakai hashing password, gunakan perbandingan langsung (tidak disarankan)
        // Jika sudah hashing, gunakan Hash::check()
        if (!$user || $user->password !== $password) {
            return redirect()->route('login')
                ->withErrors(['login' => 'Nomor pengenal atau password salah.'])
                ->withInput($request->except('password'));
        }

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
                return redirect()->route('login')
                    ->withErrors(['login' => 'Data siswa tidak ditemukan.'])
                    ->withInput($request->except('password'));
            }

            session([
                'get_data' => $siswa,
                'role' => 'siswa',
            ]);

            return redirect()->route('siswa.dashboard');
        }

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
                return redirect()->route('login')
                    ->withErrors(['login' => 'Data orang tua tidak ditemukan.'])
                    ->withInput($request->except('password'));
            }

            // ⬇ Tambahkan eksplisit id_siswa agar aman
            session([
                'get_data' => (object)[
                    'id_user' => $orangTua->id_user,
                    'role' => 'orangtua',
                    'id_siswa' => $orangTua->id_siswa,
                    'nama_orangtua' => $orangTua->nama_orangtua,
                    'nama_siswa' => $orangTua->nama_siswa,
                    'kelas' => $orangTua->kelas,
                    'jurusan' => $orangTua->jurusan,
                ],
                'role' => 'ortu',
            ]);

            return redirect()->route('ortu.dashboard');
        }

        // Jika role guru atau role lain bisa ditambah di sini
        // Contoh cek role guru:
        if ($user->role === 'guru') {
            // Ambil data guru sesuai kebutuhan, session, redirect dst.
            $guru = DB::table('guru')
                ->where('id_user', $user->id_user)
                ->first();

            if (!$guru) {
                return redirect()->route('login')
                    ->withErrors(['login' => 'Data guru tidak ditemukan.'])
                    ->withInput($request->except('password'));
            }

            session([
                'get_data' => $guru,
                'role' => 'guru',
            ]);

            return redirect()->route('guru.dashboard');
        }

        return redirect()->route('login')
            ->withErrors(['login' => 'Role tidak dikenali.'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
