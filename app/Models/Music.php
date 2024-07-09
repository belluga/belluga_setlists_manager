<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\BelongsToMany;

class Music extends Model
{

    protected $connection = "mongodb";

    protected $collection = "musics";

    protected $fillable = [
        "name",
        "tone",
        "composer",
        "interpreter",
        "genres",
        "play_settings",
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner");
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "shared_with");
    }
}
