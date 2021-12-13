<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table = "user_subscriptions";
    protected $connection = "mysql2";
}
