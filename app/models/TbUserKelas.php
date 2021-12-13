<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TbUserKelas extends Model
{
    protected $table = "tb_user_kelas";
    protected $connection = "mysql2";
    protected $fillable = [
        'id',
        'id_kelas',
        'id_user',
    ];
}
