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
     * Get filtered movies.
     *
     * @param array<string, string> $filters
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function filteredMovies(array $filters): Collection
    {
        $rank = $filters['rank'];
        $page = $filters['page'];

        $response = $this->tmdbClient->get("/movie/{$rank}", [
            'page' => $page,
        ]);

        return $this->formatMovies($response['results']);
    }

    /**
     * Get a movie details.
     *
     * @param string $id
     * @return array<string, mixed>
     */
    public function details(string $id): array
    {
        return $this->tmdbClient->get(
            "movie/{$id}",
            [
                'append_to_response' => 'credits,videos,images,similar,reviews,recommendations,watch/providers',
            ],
        );
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
                return [$values => $this->genres->get($values)];
            })->implode(', ');

            $image = $movie['poster_path'] ?
                'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] :
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
