<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\Presensi;
use App\Models\Pengumuman;


class Admin extends Controller
{
    private function cekAkses()
    {
        if (Session::get('role') !== 'superadmin') {
            abort(403, 'Akses Ditolak');
        }
    }

    public function dashboard()
    {
        $this->cekAkses();
        return view('superadmin.dashboard');
    }

    public function data($tipe)
    {
        $this->cekAkses();
        $data = match ($tipe) {
            'guru' => Guru::all(),
            'siswa' => Siswa::all(),
            'orangtua' => OrangTua::all(),
            'presensi' => Presensi::all(),
            'pengumuman' => Pengumuman::all(),
            default => abort(404)
        };

        return view('superadmin.data', compact('data', 'tipe'));
    }

    public function create($tipe)
    {
        $this->cekAkses();
        return view('superadmin.create', compact('tipe'));
    }

    public function store(Request $request, $tipe)
    {
        $this->cekAkses();

        $model = match ($tipe) {
            'guru' => new Guru,
            'siswa' => new Siswa,
            'orangtua' => new OrangTua,
            'kehadiran' => new Kehadiran,
            'pengumuman' => new Pengumuman,
            default => abort(404)
        };

        $model->fill($request->except('_token'));
        $model->save();

        return redirect()->route('superadmin.data', $tipe)->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($tipe, $id)
    {
        $this->cekAkses();
        $model = $this->findModel($tipe, $id);
        return view('superadmin.edit', compact('tipe', 'model'));
    }

    public function update(Request $request, $tipe, $id)
    {
        $this->cekAkses();
        $model = $this->findModel($tipe, $id);
        $model->update($request->except('_token', '_method'));
        return redirect()->route('superadmin.data', $tipe)->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($tipe, $id)
    {
        $this->cekAkses();
        $model = $this->findModel($tipe, $id);
        $model->delete();
        return redirect()->route('superadmin.data', $tipe)->with('success', 'Data berhasil dihapus.');
    }

    private function findModel($tipe, $id)
    {
        return match ($tipe) {
            'guru' => Guru::findOrFail($id),
            'siswa' => Siswa::findOrFail($id),
            'orangtua' => OrangTua::findOrFail($id),
            'kehadiran' => Kehadiran::findOrFail($id),
            'pengumuman' => Pengumuman::findOrFail($id),
            default => abort(404)
        };
    }
}
