<?php

namespace App\Services;

use App\Client\TmdbClient;
use Illuminate\Support\{Carbon, Collection};

class TvShowService
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
        $this->genres = $genreService->tvShowGenres();
    }

    /**
     * Get filtered tv shows.
     *
     * @param array<string, string> $filters
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function filteredTvShows(array $filters): Collection
    {
        $rank = $filters['rank'];
        $page = $filters['page'];

        $response = $this->tmdbClient->get("/tv/{$rank}", [
            'page' => $page,
        ]);

        return $this->formatTvShows($response['results']);
    }

    /**
     * Get a tv show details.
     *
     * @param string $id
     * @return array<string, mixed>
     */
    public function details(string $id): array
    {
        return $this->tmdbClient->get(
            "tv/{$id}",
            [
                'append_to_response' => 'credits,videos,images,similar,reviews,recommendations,watch/providers',
            ],
        );
    }

    /**
     * Format tv shows with genres.
     *
     * @param array<string, mixed> $tvShows
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatTvShows(array $tvShows): Collection
    {
        return collect($tvShows)->map(function (array $tvShow) {
            $genresFormat = collect($tvShow['genre_ids'])->mapWithKeys(function (int $values) {
                return [$values => $this->genres->get($values)];
            })->implode(', ');

            $image = $tvShow['poster_path'] ?
                'https://image.tmdb.org/t/p/original' . $tvShow['poster_path'] :
                'https://placehold.co/400x600';

            return collect($tvShow)->merge([
                'title' => $tvShow['name'],
                'vote_average' => number_format($tvShow['vote_average'], 1),
                'poster_path' => $image,
                'release_date' => Carbon::parse($tvShow['first_air_date'])->format('d M, Y'),
                'genres' => $genresFormat,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'adult',
            ]);
        });
    }
}
