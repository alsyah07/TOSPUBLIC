<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $primaryKey = "ID";
    protected $keyType = "string";
    protected $connection = "mysql2";
    protected $fillable = [];
    protected $table = "user_login";
    public $timestamps = false;
}
