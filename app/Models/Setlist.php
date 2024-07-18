<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Setlist extends Model
{

    use HasSlug;

    protected $fillable = [
        "name",
        "description",
        "shared_with",
        "owner"
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class, "owner");
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(Music::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
