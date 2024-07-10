<?php

namespace App\Models\Sharing;

use App\Models\Music;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharingMusic extends Sharing
{
    protected $fillable = [
        "music_id",
        "shared_with",
        "owner",
        "permissions",
    ];

    public function object(): BelongsTo
    {
        return $this->belongsTo(Music::class, 'music');
    }
}
