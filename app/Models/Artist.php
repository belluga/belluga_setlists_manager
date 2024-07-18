<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Artist extends Model
{

    use HasSlug;

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
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
