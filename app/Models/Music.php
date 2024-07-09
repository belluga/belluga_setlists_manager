<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Music extends Model
{

    protected $table = "musics";

    protected $fillable = [
        "name",
        "tone",
        "composer",
        "interpreter",
        "genres",
        "play_settings",
        "raw_content",
        "shared_with",
        "owner"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner");
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "shared_with");
    }

    public function genres(): HasMany
    {
        return $this->hasMany(MusicGenre::class);
    }
}
