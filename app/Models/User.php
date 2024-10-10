<?php

namespace App\Models;

use App\Casts\ObjectIDCast;
use App\Models\Sharing\SharingMusic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

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

    public function musics(): HasMany
    {
        return $this->hasMany(Music::class, "_id", "owner_id");
    }


    public function musics_shared_with_me(): HasMany
    {
        return $this->hasMany(SharingMusic::class, "shared_with");
    }

    protected function casts(): array
    {
        return [
            '_id' => ObjectIDCast::class,
            'email_verified_at' => 'datetime',
            'updated_at' => 'datetime',
            'created_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
