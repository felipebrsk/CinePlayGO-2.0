<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'picture',
        'password',
        'username',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the watchlists for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watchlists(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }

    /**
     * The titles that belong to the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function titles(): BelongsToMany
    {
        return $this->belongsToMany(Title::class, 'user_titles')->withPivot('acquired_at')->withTimestamps();
    }

    /**
     * Get all of the titleProgresses for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function titleProgresses(): HasMany
    {
        return $this->hasMany(UserTitleProgress::class);
    }
}
