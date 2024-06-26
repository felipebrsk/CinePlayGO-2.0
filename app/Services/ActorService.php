<?php

namespace App\Services;

use App\Client\TmdbClient;
use Illuminate\Support\{Carbon, Collection};

class ActorService
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
    public function __construct(
        TmdbClient $tmdbClient,
    ) {
        $this->tmdbClient = $tmdbClient;
    }

    /**
     * Get filtered actors.
     *
     * @param array<string, string> $filters
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function filteredActors(array $filters): Collection
    {
        $page = $filters['page'];

        $response = $this->tmdbClient->get('person/popular', [
            'page' => $page,
        ]);

        return $this->formatPersons($response['results']);
    }

    /**
     * Format persons.
     *
     * @param array<string, mixed> $persons
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatPersons(array $persons): Collection
    {
        return collect($persons)->map(function (array $person) {
            $image = $person['profile_path'] ?
                'https://image.tmdb.org/t/p/w500' . $person['profile_path'] :
                'https://placehold.co/400x600';

            $knownFor = collect($person['known_for'])->map(function (array $item) {
                return $item['media_type'] === 'tv' ? $item['name'] : $item['title'];
            });

            return collect($person)->merge([
                'profile_path' => $image,
                'known_for' => $knownFor,
            ]);
        });
    }
}

// $knownFor = collect($person['known_for'])->map(function (array $item) {
//     $image = $item['poster_path'] ?
//         'https://image.tmdb.org/t/p/original' . $item['poster_path'] :
//         'https://placehold.co/400x600';

//     $date = $item['media_type'] === 'movie' ?
//         Carbon::parse($item['release_date'])->format('d M, Y') :
//         Carbon::parse($item['first_air_date'])->format('d M, Y');

//     return collect($item)->merge([
//         'image' => $image,
//         'release_date' => $date,
//         'vote_average' => number_format($item['vote_average'], 1),
//     ]);
// });
