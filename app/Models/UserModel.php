<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserModel extends Model
{
    use HasFactory;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    public function orangtua()
    {
        return $this->hasOne(OrangTua::class, 'id_user', 'id_user');
    }
}