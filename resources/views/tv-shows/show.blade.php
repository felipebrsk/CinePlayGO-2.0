@extends('layouts.main')

@section('content')
    <div class="w-full container mx-auto flex flex-col gap-8 sm:px-8 px-2">
        <section class="flex flex-col md:flex-row items-center pt-8">
            <img alt="{{ $tvShow['name'] }}" src="{{ 'https://image.tmdb.org/t/p/w780/' . $tvShow['poster_path'] }}"
                class="w-full max-w-[30rem] rounded-md" />
            <div class="flex flex-col md:ml-8 mt-4 md:mt-0 gap-6">
                <a href={{ $tvShow['homepage'] }} target="_blank">
                    <h2 class="text-4xl font-semibold">{{ $tvShow['name'] }}</h2>
                </a>
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
                <div x-data="{ trailerOpen: false }" @keydown.escape="trailerOpen = false">
                    @if (count($tvShow['videos']['results']) > 0)
                        <button @click="trailerOpen = true"
                            class="flex items-center bg-orange-500 text-white rounded font-semibold p-4 hover:bg-orange-600 transition ease-in-out duration-150 md:w-auto w-full gap-1">
                            <svg class="w-6 fill-current" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                            </svg>
                            <span>Watch trailer</span>
                        </button>
                        <template x-if="trailerOpen">
                            <div
                                class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
                                <div class="rounded-lg overflow-hidden">
                                    <div class="bg-gray-900 rounded-lg">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button @click="trailerOpen = false"
                                                class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                        </div>
                                        <div class="p-8">
                                            <div class="overflow-hidden relative">
                                                <iframe class="absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    @else
                        <div class="font-semibold mt-8">Trailer not available.</div>
                    @endif
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
                            <p class="text-sm">Runtime: {{ $tvShow['next_episode_to_air']['runtime'] }} minutes</p>
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
                            <p class="text-sm text-gray-400">{{ $season['air_date'] }}</p>
                            <p class="text-sm">{{ $season['overview'] }}</p>
                            <p class="text-sm">Episodes: {{ $season['episode_count'] }}</p>
                            <p class="text-sm flex gap-1">
                                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                    <path
                                        d="M17.56 21 a1 1 0 0 1-.46-.11 L12 18.22 l-5.1 2.67 a1 1 0 0 1-1.45-1.06 l1-5.63 l-4.12-4 a1 1 0 0 1-.25-1 a1 1 0 0 1 .81-.68 l5.7-.83 l2.51-5.13 a1 1 0 0 1 1.8 0 l2.54 5.12 l5.7.83 a1 1 0 0 1 .81.68 a1 1 0 0 1-.25 1 l-4.12 4 l1 5.63 a1 1 0 0 1-.4 1 a1 1 0 0 1-.62.18z " />
                                </svg>
                                {{ number_format($season['vote_average'], 1) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="border-t border-b border-gray-800 py-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($tvShow['credits']['cast'])->sortByDesc('popularity')->take(10) as $cast)
                    <div class="flex flex-col gap-2">
                        <a href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/original/' . $cast['profile_path'] }}" alt="Atores"
                                class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg w-full">
                        </a>
                        <div>
                            <a href="#" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                            <div class="text-sm text-gray-400">{{ $cast['character'] }}</div>
                        </div>
                    </div>
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
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Reviews
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($tvShow['reviews']['results'])->take(5) as $review)
                    <div class="w-full bg-gray-800 rounded-lg shadow-md p-6">
                        <div class="flex items-center space-x-4">
                            <img class="w-12 h-12 rounded-full"
                                src="https://www.themoviedb.org/t/p/w64_and_h64_face/{{ $review['author_details']['avatar_path'] }}"
                                alt="{{ $review['author_details']['username'] }} Avatar" />
                            <div>
                                <h3 class="text-lg font-semibold text-white">{{ $review['author'] }}</h3>
                                <div class="flex items-center">
                                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                                        <path
                                            d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 0 01-.62.18z"
                                            data-name="star" />
                                    </svg>
                                    <span class="text-white ml-2">{{ $review['author_details']['rating'] ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-400">
                            <p class="break-words">{!! \Illuminate\Support\Str::limit($review['content'], 150, ' (...)') !!}</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ $review['url'] }}" target="_blank" class="text-blue-400 hover:underline">Read
                                more</a>
                        </div>
                        <div class="mt-2 text-gray-500 text-sm">
                            <p>Reviewed on {{ \Illuminate\Support\Carbon::parse($review['created_at'])->toDateString() }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="py-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Similar movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @foreach ($similars as $similar)
                    <div class="flex justify-center">
                        <x-tv-show-card :tvShow="$similar" />
                    </div>
                @endforeach
            </div>
        </section>
        <section class="py-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Recommendations
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @foreach ($recommendations as $recommendation)
                    <div class="flex justify-center">
                        <x-tv-show-card :tvShow="$recommendation" />
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
