<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
