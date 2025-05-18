<?php

namespace App\Exports;

use App\Models\Presensi;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class PresensiExport implements FromCollection
{
    protected $id_guru;
    protected $tanggal;

    public function __construct($id_guru, $tanggal)
    {
        $this->id_guru = $id_guru;
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        // Ambil data presensi sesuai id_guru dan tanggal (jika ada)
        $query = Presensi::with('siswa')
            ->whereHas('siswa', function ($q) {
                $q->where('id_guru', $this->id_guru);
            });

        if ($this->tanggal) {
            $query->whereDate('tanggal', $this->tanggal);
        }

        $presensis = $query->get();

        // Format data untuk Excel
        $data = $presensis->map(function ($presensi) {
            return [
                'Nama Siswa' => $presensi->siswa->nama_siswa,
                'NIS' => $presensi->siswa->nis,
                'Kelas' => $presensi->siswa->kelas,
                'Jurusan' => $presensi->siswa->jurusan,
                'Status' => $presensi->status,
                'Tanggal' => $presensi->tanggal,
                'Jam' => $presensi->jam,
            ];
        });

        return new Collection($data);
    }
}
