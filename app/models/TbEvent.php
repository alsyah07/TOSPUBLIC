<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TbEvent extends Model
{
    protected $primaryKey  = 'id_event';
    protected $table       = 'tb_event';
    protected $connection  = 'mysql2';
}
