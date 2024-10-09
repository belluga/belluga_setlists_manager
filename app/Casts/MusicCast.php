<?php

namespace App\Casts;

use App\Models\Music;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MusicCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Music::fromJson($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Music::fromJson($value);
    }
}
