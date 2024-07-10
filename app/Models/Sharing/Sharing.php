<?php

namespace App\Models\Sharing;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MongoDB\Laravel\Eloquent\Model;

abstract class Sharing extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'share_relation';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shared_with(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    abstract public function object(): BelongsTo;
}
