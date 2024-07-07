<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Music extends Model
{

    protected $connection = "mongodb";

    protected $collection = "musics";
}
