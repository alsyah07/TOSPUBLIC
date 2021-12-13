<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class TbEvent extends Model
{
    protected $primaryKey  = 'id_event';
    protected $table       = 'tb_event';
    protected $keyType = "string";
    protected $connection  = 'mysql2';
}
