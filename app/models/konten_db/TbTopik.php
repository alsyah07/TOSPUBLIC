<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class TbTopik extends Model
{
    protected $primaryKey   = 'idtop';
    protected $table        = "tb_topik";
    public $timestamps      = false;
}
