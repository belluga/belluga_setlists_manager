<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MusicGenre extends Model
{
    protected $fillable = [
        "name",
    ];

    public function parent(): HasOne {
        return $this->hasOne(MusicGenre::class);
    }

    public function music(): BelongsToMany
    {
        return $this->belongsToMany(Music::class);
    }
}
