<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class TbKelas extends Model
{
    protected $primaryKey   = 'idkelas';
    protected $table        = "tb_kelas";
    public $timestamps      = false;
}
