<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany};

class Title extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'price',
    ];

    /**
     * Get the acquired attribute.
     *
     * @return bool
     */
    public function getAcquiredAttribute(): bool
    {
        return Auth::user()->titles->contains('id', $this->id);
    }

    /**
     * The users that belong to the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_titles')->withPivot('acquired_at')->withTimestamps();
    }

    /**
     * Get all of the requirements for the Title
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(TitleRequirement::class);
    }
}
