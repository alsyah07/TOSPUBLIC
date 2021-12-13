<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TbMasterSoal extends Model
{
    protected $table = "master_soal";
    protected $primaryKey = "ids";
    protected $keyType = "string";
    protected $connection = "mysql2";
}
