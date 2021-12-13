<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = "user_log";
    protected $connection = "mysql2";
}
