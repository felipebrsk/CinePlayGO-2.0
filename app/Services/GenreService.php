<?php

namespace App\Services;

use App\Client\TmdbClient;
use Illuminate\Support\Collection;

class GenreService
{
    /**
     * The tmdb client.
     *
     * @var \App\Client\TmdbClient
     */
    private $tmdbClient;

    /**
     * Create a new class instance.
     *
     * @param \App\Client\TmdbClient $tmdbClient
     * @return void
     */
    public function __construct(TmdbClient $tmdbClient)
    {
        $this->tmdbClient = $tmdbClient;
    }

    /**
     * Get all movie genre list.
     *
     * @return \Illuminate\Support\Collection<array-key, mixed>
     */
    public function movieGenres(): Collection
    {
        return collect($this->tmdbClient->get('genre/movie/list')['genres'])->mapWithKeys(function (array $genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    /**
     * Get all tv show genre list.
     *
     * @return \Illuminate\Support\Collection<array-key, mixed>
     */
    public function tvShowGenres(): Collection
    {
        return collect($this->tmdbClient->get('genre/tv/list')['genres'])->mapWithKeys(function (array $genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
}
