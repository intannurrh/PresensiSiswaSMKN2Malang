<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{

    protected $table = 'guru'; // 👈 Ini penting

    protected $primaryKey = 'id_guru';
    public $timestamps = false;

    // Jika relasi ke siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'kelas')
            ->where('jurusan', $this->jurusan);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

}
