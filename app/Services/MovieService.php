<?php

namespace App\Services;

use App\Client\TmdbClient;
use Illuminate\Support\{Carbon, Collection};

class MovieService
{
    /**
     * The tmdb client.
     *
     * @var \App\Client\TmdbClient
     */
    private $tmdbClient;

    /**
     * The genres.
     *
     * @var \Illuminate\Support\Collection<array-key, string>
     */
    private $genres;

    /**
     * Create a new class instance.
     *
     * @param \App\Client\TmdbClient $tmdbClient
     * @param \App\Services\GenreService $genreService
     * @return void
     */
    public function __construct(
        TmdbClient $tmdbClient,
        GenreService $genreService,
    ) {
        $this->tmdbClient = $tmdbClient;
        $this->genres = $genreService->movieGenres();
    }

    /**
     * Get now playing movies.
     *
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function nowPlaying(): Collection
    {
        $response = $this->tmdbClient->get('movie/now_playing');

        return $this->formatMovies($response['results']);
    }

    /**
     * Get popular movies.
     *
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function popular(): Collection
    {
        $response = $this->tmdbClient->get('movie/popular');

        return $this->formatMovies($response['results']);
    }

    /**
     * Format movies with genres.
     *
     * @param array<string, mixed> $movies
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatMovies(array $movies): Collection
    {
        return collect($movies)->map(function (array $movie) {
            $genresFormat = collect($movie['genre_ids'])->mapWithKeys(function (int $values) {
                return [$values = $this->genres->get($values)];
            })->implode(', ');

            $image = $movie['poster_path'] ?
                'https://image.tmdb.org/t/p/w342' . $movie['poster_path'] :
                'https://placehold.co/400x600';

            return collect($movie)->merge([
                'vote_average' => number_format($movie['vote_average'], 1),
                'poster_path' => $image,
                'release_date' => Carbon::parse($movie['release_date'])->format('d M, Y'),
                'genres' => $genresFormat,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'adult',
            ]);
        });
    }
}
