<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $primaryKey   = "ID";
    protected $table = "user_login";
    public $timestamps = false;
}
