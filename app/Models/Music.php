<?php

namespace App\Models;

use App\Casts\ObjectIDCast;
use App\Models\Sharing\SharingMusic;
use MongoDB\Laravel\Relations\HasMany;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\EmbedsMany;

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
        "owner_id"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id", "_id");
    }

    public function sharedWith(): HasMany
    {
        return $this->hasMany(SharingMusic::class, "music");
    }

    public function genres(): EmbedsMany
    {
        return $this->embedsMany(MusicGenre::class);
    }

    protected function casts(): array
    {
        return [
            "_id" => ObjectIDCast::class,
            "name" => 'string',
            "tone" => 'string',
            "composer" => 'string',
            "interpreter" => 'string',
            "genres" => 'array',
            "play_settings" => 'array',
            "raw_content" => 'string',
            "owner_id" => ObjectIDCast::class,
        ];
    }
}
