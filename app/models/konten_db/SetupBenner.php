<?php

namespace App\models\konten_db;

use Illuminate\Database\Eloquent\Model;

class SetupBenner extends Model
{
    protected $keyType = "string";
    protected $connection = 'mysql2';
    protected $table = 'setup_banner';
    public $timestamps = false;
}
