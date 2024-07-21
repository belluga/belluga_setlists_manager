<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Music extends Model
{
    use HasSlug, AsSource, Filterable, Attachable;

    protected $table = "musics";

    protected $fillable = [
        "name",
        "tone",
        "composer",
        "interpreter",
        "genres",
        "play_settings",
        "lyrics",
        "owner"
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner");
    }

    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function setlists(): BelongsToMany
    {
        return $this->belongsToMany(Setlist::class)->withTimestamps();
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
