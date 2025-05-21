<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensis';
    protected $fillable = [
        'siswa_id',
        'status',
        'tanggal',     // jika digunakan
        'keterangan',    // ini juga dipakai di presensi pagi
        'jam_pulang',  // INI WAJIB agar bisa update dari controller
        'created_at'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id_siswa');
    }
}