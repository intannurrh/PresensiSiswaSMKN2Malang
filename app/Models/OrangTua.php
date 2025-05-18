<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrangTua extends Model
{
    protected $table = 'orang_tua';
    protected $primaryKey = 'id_orangtua';
    public $timestamps = false;

    protected $fillable = ['id_user', 'id_siswa', 'nama'];



    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

}