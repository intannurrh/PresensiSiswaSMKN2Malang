<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\PresensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\RedirectResponse;



class GuruController extends Controller
{
    public function downloadLaporanExcel(Request $request)
    {
        // Pastikan pengguna sudah login
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil data guru berdasarkan id_user
        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Ambil parameter tanggal (opsional)
        $tanggal = $request->input('tanggal');

        // Unduh file Excel
        return Excel::download(new PresensiExport($guru->id_guru, $tanggal), 'rekapan_kehadiran.xlsx');
    }
    public function dashboard()
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $presensis = Presensi::with('siswa')
            ->whereDate('tanggal', now()->toDateString())
            ->whereHas('siswa', function ($query) use ($guru) {
                $query->where('id_guru', $guru->id_guru);
            })
            ->get();

        return view('guru.dashboard', compact('presensis'));
    }


    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Data berhasil dihapus');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Menampilkan halaman daftar siswa yang diampu guru yang sedang login.
     *
     * @return \Illuminate\Http\Response
     */
    /*******  fa889a01-ba41-4520-9a03-6e1476693a06  *******/



    public function laporan(Request $request)
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru = Guru::where('id_user', $get_data->id_user)->first();
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        // Ambil parameter tanggal (opsional)
        $tanggal = $request->input('tanggal');

        // Query presensi berdasarkan guru dan opsional tanggal
        $query = Presensi::with('siswa')
            ->whereHas('siswa', function ($q) use ($guru) {
                $q->where('id_guru', $guru->id_guru);
            });

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $presensis = $query->orderBy('tanggal', 'desc')->get();

        return view('guru.laporan', compact('presensis', 'tanggal'));
    }

    public function dataAnakKelasSaya()
    {
        $get_data = session('get_data');
        if (!$get_data) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $guru =Guru::where('id_user', $get_data->id_user)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $siswa = Siswa::with('orangTua')
            ->where('id_guru', $guru->id_guru)
            ->get();

        return view('guru.datasiswa', compact('siswa'));
    }

    public function profile()
    {
        $user = session('get_data'); // ambil data user login dari session

        // Cari data guru berdasarkan id_user
        $guru = Guru::where('id_user', $user->id_user)->first();

        return view('guru.profile', compact('guru'));
    }

}
