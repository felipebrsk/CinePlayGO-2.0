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
     * Get an actor details.
     *
     * @param string $id
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function details(string $id): Collection
    {
        return $this->formatDetails(
            $this->tmdbClient->get(
                "person/{$id}",
                [
                    'append_to_response' => 'combined_credits,external_ids,latest',
                ],
            )
        );
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

    /**
     * Format the actor details.
     *
     * @param array<string, mixed> $person
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatDetails(array $person): Collection
    {
        $image = $person['profile_path'] ?
            'https://image.tmdb.org/t/p/w500' . $person['profile_path'] :
            'https://placehold.co/400x600';

        $knownFor = $this->formatKnownFor(
            collect($person['combined_credits']['cast'])
                ->where('character', '!=', '')
                ->sortByDesc('popularity')
                ->take(5)
                ->toArray(),
        );

        $socials = $this->formatSocials($person['external_ids']);

        $casts = $this->formatCasts($person['combined_credits']['cast']);

        $crews = $this->formatCrews($person['combined_credits']['crew']);

        return collect($person)->merge([
            'profile_path' => $image,
            'known_for' => $knownFor,
            'casts' => $casts,
            'crews' => $crews,
            'socials' => $socials,
            'age' => Carbon::parse($person['birthday'])->age,
        ])->only([
            'biography',
            'birthday',
            'deathday',
            'name',
            'place_of_birth',
            'profile_path',
            'known_for',
            'casts',
            'crews',
            'socials',
            'homepage',
            'age',
        ]);
    }

    /**
     * Format crews for person.
     *
     * @param array<string, mixed> $crews
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatCrews(array $crews): Collection
    {
        return collect($crews)->map(function (array $crew) {
            if (isset($crew['release_date'])) {
                $date = Carbon::parse($crew['release_date'])->format('d M, Y');
            } elseif (isset($crew['first_air_date'])) {
                $date = Carbon::parse($crew['first_air_date'])->format('d M, Y');
            } else {
                $date = 'Future';
            }

            $name = $crew['media_type'] === 'tv' ? $crew['name'] : $crew['title'];

            return [
                'id' => $crew['id'],
                'name' => $name,
                'media_type' => $crew['media_type'],
                'job' => $crew['job'],
                'date' => $date,
            ];
        });
    }

    /**
     * Format casts for person.
     *
     * @param array<string, mixed> $casts
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatCasts(array $casts): Collection
    {
        return collect($casts)->map(function (array $cast) {
            if ($cast['media_type'] === 'tv') {
                $name = $cast['name'];
                $link = route('tv-shows.show', $cast['id']);
            } elseif ($cast['media_type'] === 'movie') {
                $name = $cast['title'];
                $link = route('movies.show', $cast['id']);
            } else {
                $name = 'Untitled';
                $link = '#';
            }

            if (isset($cast['release_date'])) {
                $date = Carbon::parse($cast['release_date'])->format('d M, Y');
            } elseif (isset($cast['first_air_date'])) {
                $date = Carbon::parse($cast['first_air_date'])->format('d M, Y');
            } else {
                $date = 'Future';
            }

            return [
                'id' => $cast['id'],
                'name' => $name,
                'link' => $link,
                'vote_average' => number_format($cast['vote_average'], 1),
                'media_type' => $cast['media_type'],
                'character' => $cast['character'],
                'date' => $date,
            ];
        });
    }

    /**
     * Format known for persons.
     *
     * @param array<string, mixed> $knownFor
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatKnownFor(array $knownFor): Collection
    {
        return collect($knownFor)->map(function (array $item) {
            $image = $item['poster_path'] ?
                'https://image.tmdb.org/t/p/original' . $item['poster_path'] :
                'https://placehold.co/400x600';

            if ($item['media_type'] === 'tv') {
                $name = $item['name'];
                $link = route('tv-shows.show', $item['id']);
            } elseif ($item['media_type'] === 'movie') {
                $name = $item['title'];
                $link = route('movies.show', $item['id']);
            } else {
                $name = 'Untitled';
                $link = '#';
            }

            if (isset($item['release_date'])) {
                $date = Carbon::parse($item['release_date'])->format('d M, Y');
            } elseif (isset($item['first_air_date'])) {
                $date = Carbon::parse($item['first_air_date'])->format('d M, Y');
            } else {
                $date = 'Future';
            }

            return collect($item)->merge([
                'name' => $name,
                'link' => $link,
                'image' => $image,
                'release_date' => $date,
                'vote_average' => number_format($item['vote_average'], 1),
            ]);
        });
    }

    /**
     * Format the social links.
     *
     * @param array<string, mixed> $socials
     * @return \Illuminate\Support\Collection<string, never>
     */
    public function formatSocials(array $socials): Collection
    {
        return collect($socials)->merge([
            'twitter' => $socials['twitter_id'] ? 'https://twitter.com/' . $socials['twitter_id'] : null,
            'facebook' => $socials['facebook_id'] ? 'https://facebook.com/' . $socials['facebook_id'] : null,
            'instagram' => $socials['instagram_id'] ? 'https://instagram.com/' . $socials['instagram_id'] : null,
            'tiktok' => $socials['tiktok_id'] ? 'https://tiktok.com/@' . $socials['instagram_id'] : null,
        ])->only([
            'tiktok',
            'twitter',
            'facebook',
            'instagram',
        ]);
    }
}
