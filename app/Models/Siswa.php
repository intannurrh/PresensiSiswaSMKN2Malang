<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Nama tabel jika tidak standar (Laravel default: plural dari model)
    protected $table = 'siswa';

    // Primary key yang digunakan
    protected $primaryKey = 'id_siswa';

    // Jika primary key bukan auto-increment atau tipe lain, sesuaikan
    public $incrementing = true;  // kalau auto increment, default true
    protected $keyType = 'int';   // tipe primary key

    // Jika timestamp tidak ada di tabel, disable
    public $timestamps = false;

    // Mass assignable attributes
    protected $fillable = [
        'id_user',
        'id_guru',
        'nama',
        'nis',
        'kelas',
        'jurusan',
    ];

    // Relasi ke user (asumsi ada model User)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke guru (asumsi ada model Guru)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    // Jika ingin relasi ke kehadiran (jika ada model Kehadiran)
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'siswa_id', 'siswa_id');
    }


    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Get the related OrangTua model for the Siswa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    /*******  74f23d5e-cea9-4447-bd81-879833601e63  *******/
    public function orangTua()
    {
        return $this->hasOne(\App\Models\OrangTua::class, 'id_siswa', 'id_siswa');
    }


}