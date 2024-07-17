<?php

namespace App\Models;

use App\Models\Sharing\ShareObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setlist extends Model
{

    protected $fillable = [
        "name",
        "description",
        "shared_with",
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
}
