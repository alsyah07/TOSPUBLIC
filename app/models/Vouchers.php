<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    protected $table = "vouchers";
    protected $connection = "mysql2";
    public $timestamps = false;
}
