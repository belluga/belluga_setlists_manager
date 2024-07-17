<?php

namespace App\Models;

use App\Models\Sharing\ShareObject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Music extends Model
{

    protected $fillable = [
        "name",
        "tone",
        "composer",
        "interpreter",
        "genres",
        "play_settings",
        "raw_content",
        "owner"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner");
    }

    public function sharedWith(): HasMany
    {
        return $this->hasMany(ShareObject::class, "object_id");
    }

    public function genres(): HasMany
    {
        return $this->embedsMany(MusicGenre::class);
    }
}
