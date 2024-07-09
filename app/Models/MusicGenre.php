<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MusicGenre extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        "parent",
        "name",
    ];
}
