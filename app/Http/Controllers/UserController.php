<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View; // Import View


class UserController extends Controller
{
    // ... (method showUserSelectForm, showLoginForm jika ada) ...

    /**
     * Menangani percobaan autentikasi masuk.
     * (Method ini sama seperti sebelumnya, sudah menangani redirect ke dashboard yang sesuai)
     */
    public function login(Request $request)
    {
        $get_data = UserModel::where('username', $request->username)->first();
        if ($get_data) {
            return redirect('/dashboard-guru');
        } else {
            return redirect()->back()->with('error', 'Login gagal! Username atau password salah.');
        }
    }

    public function showGuruDashboard(): View|RedirectResponse // Bisa return View atau RedirectResponse
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Arahkan ke login jika belum login
        }

        // Periksa role user yang sedang login
        $user = Auth::UserModel();
        if ($user->role !== 'guru') {
            // Jika bukan guru, logout atau arahkan ke halaman lain
            Auth::logout(); // Contoh: logout saja
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak. Anda bukan guru.']);
            // Atau bisa juga: return abort(403, 'Unauthorized action.');
        }

        // Jika user adalah guru, tampilkan view dashboard
        return view('guru.dashboard'); // Pastikan view ini ada
    }


    /**
     * Menangani proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.select');
    }
    /**
     * Tampilkan dashboard siswa (berdasarkan nama).
     */
    public function showSiswaDashboard(string $nama): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'siswa' || $user->name !== $nama) {
            Auth::logout();
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak.']);
        }

        return view('siswa.dashboard', compact('nama'));
    }
    public function showOrtuDashboard(string $nama): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if ($user->role !== 'ortu' || $user->name !== $nama) {
            Auth::logout();
            return redirect()->route('user.select')->withErrors(['msg' => 'Akses ditolak.']);
        }

        return view('ortu.dashboard', compact('nama'));
    }

}
