<?php

namespace App\Models\Sharing;

use App\Models\Setlist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharingSetlist extends Sharing
{
    protected $fillable = [
        "setlist_id",
        "shared_with",
        "owner",
        "permissions",
    ];

    public function object(): BelongsTo
    {
        return $this->belongsTo(Setlist::class);
    }
}
