<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaType extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
    ];

    /**
     * The movie media type const id.
     *
     * @var int
     */
    public const MOVIE_TYPE_ID = 1;

    /**
     * The tv show media type const id.
     *
     * @var int
     */
    public const TV_SHOW_TYPE_ID = 2;

    /**
     * Get all of the watchlists for the MediaType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function watchlists(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }
}
