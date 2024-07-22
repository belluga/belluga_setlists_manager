<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Composer;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Artist extends Model
{

    use HasSlug, AsSource;

    protected $fillable = [
        "name",
        "slug",
        "avatar_url",
        "bio",
        "birth",
        "death",
        "country",
        "state",
        "city",
        "creator_id"
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function composed(): BelongsToMany
    {
        return $this->belongsToMany(Music::class)
            ->as('composer')
            ->withPivot('type');
    }

    public function interpreted(): BelongsToMany
    {
        return $this->belongsToMany(Music::class)
            ->as('interpreter')
            ->withPivot('type');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
