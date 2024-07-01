@extends('layouts.main', ['title' => $tvShow['name']])

@section('content')
    <div class="w-full container mx-auto flex flex-col gap-8 sm:px-8 px-2">
        <section class="flex flex-col md:flex-row items-center pt-8">
            <img alt="{{ $tvShow['name'] }}" src="{{ 'https://image.tmdb.org/t/p/original/' . $tvShow['poster_path'] }}"
                class="w-full max-w-[30rem] rounded-md" />
            <div class="flex flex-col md:ml-8 mt-4 md:mt-0 gap-3">
                <div class="flex sm:flex-row flex-col justify-between items-center sm:gap-0 gap-4">
                    <a href={{ $tvShow['homepage'] }} target="_blank"
                        class="text-4xl font-semibold w-auto max-w-fit underline hover:text-blue-400 transition duration-200">
                        {{ $tvShow['name'] }}
                    </a>
                    @livewire('add-to-watchlist', ['media' => $tvShow, 'type' => \App\Models\MediaType::TV_SHOW_TYPE_ID], key($tvShow['id']))
                </div>
                <div class="flex items-center text-gray-400 text-sm gap-1.5">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                        <path
                            d="M17.56 21 a1 1 0 0 1-.46-.11 L12 18.22 l-5.1 2.67 a1 1 0 0 1-1.45-1.06 l1-5.63 l-4.12-4 a1 1 0 0 1-.25-1 a1 1 0 0 1 .81-.68 l5.7-.83 l2.51-5.13 a1 1 0 0 1 1.8 0 l2.54 5.12 l5.7.83 a1 1 0 0 1 .81.68 a1 1 0 0 1-.25 1 l-4.12 4 l1 5.63 a1 1 0 0 1-.4 1 a1 1 0 0 1-.62.18z " />
                    </svg>
                    <span>{{ number_format($tvShow['vote_average'], 1) }} ({{ $tvShow['vote_count'] }} votes)</span>
                    <span>|</span>
                    @if (isset($tvShow['first_air_date']))
                        <span>{{ \Carbon\Carbon::parse($tvShow['first_air_date'])->format('d M, Y') }}</span>
                    @else
                        <span>No release date provided.</span>
                    @endif
                    <span>|</span>
                    <span>{{ collect($tvShow['genres'])->pluck('name')->implode(', ') }}</span>
                </div>
                <div>
                    @if ($tvShow['in_production'])
                        <p class="text-gray-400 flex gap-1 items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="w-4 h-4" viewBox="0 0 50 50"
                                fill="currentColor">
                                <path
                                    d="M 25 2 C 12.309295 2 2 12.309295 2 25 C 2 37.690705 12.309295 48 25 48 C 37.690705 48 48 37.690705 48 25 C 48 12.309295 37.690705 2 25 2 z M 25 4 C 36.609824 4 46 13.390176 46 25 C 46 36.609824 36.609824 46 25 46 C 13.390176 46 4 36.609824 4 25 C 4 13.390176 13.390176 4 25 4 z M 25 11 A 3 3 0 0 0 22 14 A 3 3 0 0 0 25 17 A 3 3 0 0 0 28 14 A 3 3 0 0 0 25 11 z M 21 21 L 21 23 L 22 23 L 23 23 L 23 36 L 22 36 L 21 36 L 21 38 L 22 38 L 23 38 L 27 38 L 28 38 L 29 38 L 29 36 L 28 36 L 27 36 L 27 21 L 26 21 L 22 21 L 21 21 z">
                                </path>
                            </svg>
                            This TV Show is still in production.
                        </p>
                    @endif
                </div>
                <div>
                    <h4 class="text-white font-bold">Synopsis:</h4>
                    <p class="text-gray-300">{{ $tvShow['overview'] }} - {{ $tvShow['tagline'] }}</p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Crew:</h4>
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4">
                        @foreach (collect($tvShow['credits']['crew'])->sortByDesc('popularity')->take(4) as $crew)
                            <div>
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold">Created by:</h4>
                    <p class="text-sm text-gray-400">
                        {{ collect($tvShow['created_by'])->pluck('name')->implode(', ') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Spoken languages:</h4>
                    <p class="text-sm text-gray-400">
                        {{ collect($tvShow['spoken_languages'])->pluck('english_name')->implode(', ') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Production Companies:</h4>
                    <p class="text-sm text-gray-400">
                        {{ collect($tvShow['production_companies'])->pluck('name')->implode(', ') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Episodes:</h4>
                    <p class="text-sm text-gray-400">
                        {{ $tvShow['number_of_episodes'] }} episodes, {{ $tvShow['number_of_seasons'] }} seasons
                    </p>
                </div>
                <div class="flex md:flex-row flex-col gap-2">
                    @include('components.trailer', ['videos' => $tvShow['videos']['results']])
                    @include('components.watch-providers', ['providers' => $providers])
                </div>
            </div>
        </section>
        <section class="border-t border-gray-800 pt-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Most Recent Episodes
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div class="flex flex-col gap-2">
                    <img src="{{ 'https://image.tmdb.org/t/p/original/' . $tvShow['last_episode_to_air']['still_path'] }}"
                        alt="Last episode image"
                        class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full">
                    <div class="mt-2 flex flex-col gap-1">
                        <h3 class="text-lg font-semibold hover:text-gray-300">
                            {{ $tvShow['last_episode_to_air']['name'] }}
                        </h3>
                        <p class="text-sm flex gap-1">
                            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                <path
                                    d="M17.56 21 a1 1 0 0 1-.46-.11 L12 18.22 l-5.1 2.67 a1 1 0 0 1-1.45-1.06 l1-5.63 l-4.12-4 a1 1 0 0 1-.25-1 a1 1 0 0 1 .81-.68 l5.7-.83 l2.51-5.13 a1 1 0 0 1 1.8 0 l2.54 5.12 l5.7.83 a1 1 0 0 1 .81.68 a1 1 0 0 1-.25 1 l-4.12 4 l1 5.63 a1 1 0 0 1-.4 1 a1 1 0 0 1-.62.18z " />
                            </svg>
                            {{ number_format($tvShow['last_episode_to_air']['vote_average'], 1) }}
                        </p>
                        <p class="text-sm text-gray-400">{{ $tvShow['last_episode_to_air']['air_date'] }}</p>
                        <p class="text-sm">{{ $tvShow['last_episode_to_air']['overview'] }}</p>
                        <p class="text-sm">Runtime: {{ $tvShow['last_episode_to_air']['runtime'] }} minutes</p>
                        <p class="text-sm">
                            Episode {{ $tvShow['last_episode_to_air']['episode_number'] }} Season
                            {{ $tvShow['last_episode_to_air']['season_number'] }}
                        </p>
                    </div>
                </div>

                @if (isset($tvShow['next_episode_to_air']))
                    <div class="flex flex-col gap-2">
                        <img src="{{ 'https://image.tmdb.org/t/p/original/' . $tvShow['next_episode_to_air']['still_path'] }}"
                            alt="Next episode image"
                            class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full">
                        <div class="mt-2 flex flex-col gap-1">
                            <h3 class="text-lg font-semibold hover:text-gray-300">
                                {{ $tvShow['next_episode_to_air']['name'] }}
                            </h3>
                            <p class="text-sm flex gap-1">
                                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                    <path
                                        d="M17.56 21 a1 1 0 0 1-.46-.11 L12 18.22 l-5.1 2.67 a1 1 0 0 1-1.45-1.06 l1-5.63 l-4.12-4 a1 1 0 0 1-.25-1 a1 1 0 0 1 .81-.68 l5.7-.83 l2.51-5.13 a1 1 0 0 1 1.8 0 l2.54 5.12 l5.7.83 a1 1 0 0 1 .81.68 a1 1 0 0 1-.25 1 l-4.12 4 l1 5.63 a1 1 0 0 1-.4 1 a1 1 0 0 1-.62.18z " />
                                </svg>
                                {{ number_format($tvShow['next_episode_to_air']['vote_average'], 1) }}
                            </p>
                            <p class="text-sm text-gray-400">{{ $tvShow['next_episode_to_air']['air_date'] }}</p>
                            <p class="text-sm">{{ $tvShow['next_episode_to_air']['overview'] }}</p>
                            <p class="text-sm">Runtime:
                                {{ $tvShow['next_episode_to_air']['runtime'] ? $tvShow['next_episode_to_air']['runtime'] . ' minutes' : '-' }}
                            </p>
                            <p class="text-sm">
                                Episode {{ $tvShow['next_episode_to_air']['episode_number'] }} Season
                                {{ $tvShow['next_episode_to_air']['season_number'] }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <section class="border-t border-gray-800 pt-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Seasons
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                @foreach ($tvShow['seasons'] as $season)
                    <div class="flex flex-col gap-2">
                        <img src="{{ 'https://image.tmdb.org/t/p/original/' . $season['poster_path'] }}"
                            alt="{{ $season['name'] }} poster"
                            class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full h-full max-h-[40rem]">
                        <div class="mt-2 flex flex-col gap-1">
                            <h3 class="text-lg font-semibold hover:text-gray-300">
                                {{ $season['name'] }}
                            </h3>
                            <p class="text-sm flex gap-1">
                                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                    <path
                                        d="M17.56 21 a1 1 0 0 1-.46-.11 L12 18.22 l-5.1 2.67 a1 1 0 0 1-1.45-1.06 l1-5.63 l-4.12-4 a1 1 0 0 1-.25-1 a1 1 0 0 1 .81-.68 l5.7-.83 l2.51-5.13 a1 1 0 0 1 1.8 0 l2.54 5.12 l5.7.83 a1 1 0 0 1 .81.68 a1 1 0 0 1-.25 1 l-4.12 4 l1 5.63 a1 1 0 0 1-.4 1 a1 1 0 0 1-.62.18z " />
                                </svg>
                                {{ number_format($season['vote_average'], 1) }}
                            </p>
                            <p class="text-sm text-gray-400">{{ $season['air_date'] }}</p>
                            <p class="text-sm">{{ $season['overview'] }}</p>
                            <p class="text-sm">Episodes: {{ $season['episode_count'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="border-t border-b border-gray-800 py-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($tvShow['credits']['cast'])->sortByDesc('popularity')->take(10) as $cast)
                    <x-actor-card :cast="$cast" />
                @endforeach
            </div>
        </section>
        <section x-data="{ isOpen: false, image: '' }">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Images from {{ $tvShow['name'] }}
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">
                @foreach ($tvShow['images']['backdrops'] as $images)
                    @if ($loop->index < 10)
                        <div class="mt-8">
                            <a @click.prevent="
                                isOpen = true
                                image='{{ 'https://image.tmdb.org/t/p/original/' . $images['file_path'] }}'
                            "
                                href="#">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $images['file_path'] }}"
                                    alt="Imagens do filme"
                                    class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full">
                            </a>
                        </div>
                    @endif
                @endforeach
                <div style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center justify-center shadow-lg" x-show="isOpen">
                    <div class="bg-gray-900 rounded" @click.away="isOpen = false">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300 transition duration-200">&times;</button>
                        </div>
                        <div class="p-8">
                            <img :src="image" alt="poster" class="max-w-[50vw] rounded">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Reviews
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @if (count($tvShow['reviews']['results']) > 0)
                    @foreach (collect($tvShow['reviews']['results'])->take(5) as $review)
                        <x-review-card :review="$review" />
                    @endforeach
                @else
                    <p class="text-lg text-gray-400">
                        No one review found.
                    </p>
                @endif
            </div>
        </section>
        <section class="py-4 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Similar movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @if (count($similars) > 0)
                    @foreach ($similars as $similar)
                        <div class="flex justify-center">
                            <x-tv-show-card :tvShow="$similar" />
                        </div>
                    @endforeach
                @else
                    <p class="text-lg text-gray-400">
                        No one similar movie was found.
                    </p>
                @endif
            </div>
        </section>
        <section class="py-4 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Recommendations
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @if (count($recommendations) > 0)
                    @foreach ($recommendations as $recommendation)
                        <div class="flex justify-center">
                            <x-tv-show-card :tvShow="$recommendation" />
                        </div>
                    @endforeach
                @else
                    <p class="text-lg text-gray-400">
                        No one recommended movie was found.
                    </p>
                @endif
            </div>
        </section>
    </div>
@endsection
