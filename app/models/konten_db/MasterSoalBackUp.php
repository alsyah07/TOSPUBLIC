<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class MasterSoalBackUp extends Model
{
    protected $primaryKey = "ids";
    protected $table = "master_soal_backup";
    public $timestamps = false;
}
