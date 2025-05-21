<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;
use Carbon\Carbon;
use App\Models\Pengumuman;

class OrtuController extends Controller
{
    public function dashboard()
    {
        $data = session('get_data');

        if (!$data || $data->role !== 'orangtua') {
            return redirect('login?role=orangtua')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $presensis = DB::table('presensis')
            ->join('orang_tua', 'presensis.siswa_id', '=', 'orang_tua.id_siswa')
            ->where('orang_tua.id_user', $data->id_user)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        // Ambil data orang tua supaya bisa ditampilkan nama ortu di dashboard
        $ortu = DB::table('orang_tua')
            ->where('id_user', $data->id_user)
            ->first();

        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();

        return view('ortu.dashboard', compact('presensis', 'pengumuman', 'ortu'));
    }


    public function profile()
    {
        $data = session('get_data');

        if (!$data || $data->role !== 'orangtua') {
            return redirect('login?role=orangtua')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $orangTua = DB::table('orang_tua')
            ->join('siswa', 'orang_tua.id_siswa', '=', 'siswa.id_siswa')
            ->where('orang_tua.id_user', $data->id_user)
            ->first(); // Ganti 'orang_tua' dengan nama tabel orang_tua')

        return view('ortu.profile', ['orangtua' => $orangTua]);
    }

    public function rekap()
    {
        $data = session('get_data');

        if (!$data || session('role') !== 'ortu') {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $rekap = DB::table('presensis')
            ->where('siswa_id', $data->id_siswa)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('ortu.rekap', compact('rekap'));
    }

    public function pengumuman()
    {
        $data = session('get_data');

        if (!$data || session('role') !== 'ortu') {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $pengumuman = DB::table('pengumuman')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('ortu.pengumuman', compact('pengumuman'));
    }
    public function presensiForm()
    {
        $data = session('get_data');

        if (!$data || $data->role !== 'orangtua') {
            return redirect('login?role=orangtua')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $siswa = DB::table('siswa')
            ->join('orang_tua', 'siswa.id_siswa', '=', 'orang_tua.id_siswa')
            ->where('orang_tua.id_user', $data->id_user)
            ->first();

        return view('ortu.presensi', compact('siswa'));
    }


    public function kirimPresensi(Request $request)
    {
        $data = session('get_data');

        // Ambil ID siswa dari session atau dari DB jika tidak ada
        $siswaId = $data->id_siswa ?? DB::table('orang_tua')
            ->where('id_user', (int)$data->id_user)
            ->value('id_siswa');

        if (!$siswaId) {
            return redirect()->back()->withErrors(['error' => 'Data siswa tidak ditemukan.']);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah sudah ada presensi izin untuk siswa dan tanggal yang sama
        $existingPresensi = DB::table('presensis')
            ->where('siswa_id', $siswaId)
            ->where('tanggal', $request->tanggal)
            ->whereIn('status', ['Izin', 'Terlambat', 'Hadir'])
            ->first();

        if ($existingPresensi) {
            return redirect()->back()->withErrors(['error' => 'Presensi izin untuk tanggal ini sudah dikirim, tidak bisa mengisi lebih dari 1 kali']);
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/fotos');
            $fotoPath = str_replace('public/', '', $fotoPath);
        } else {
            $fotoPath = null;
        }

        // Simpan data presensi
        DB::table('presensis')->insert([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'foto' => $fotoPath,
            'status' => 'Izin',
            'siswa_id' => $siswaId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil dikirim!');
    }
}
