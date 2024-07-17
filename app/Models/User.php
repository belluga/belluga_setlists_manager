<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(Music::class);
    }

    public function setlists(): BelongsToMany
    {
        return $this->belongsToMany(Setlist::class);
    }

    public function artists(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'updated_at' => 'datetime',
            'created_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
