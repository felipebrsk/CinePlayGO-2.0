@extends('layouts.main')

@section('content')
    {{-- @php
        dd($movie);
    @endphp --}}
    <div class="w-full container mx-auto flex flex-col gap-8 sm:px-8 px-2">
        <section class="flex flex-col md:flex-row items-center pt-8">
            <img alt="{{ $movie['title'] }}" src="{{ 'https://image.tmdb.org/t/p/w342/' . $movie['poster_path'] }}"
                class="w-full max-w-[30rem]" />
            <div class="flex flex-col md:ml-8 mt-4 md:mt-0 gap-6">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex items-center text-gray-400 text-sm gap-1.5">
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                        <path
                            d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 0 01-.62.18z"
                            data-name="star" />
                    </svg>
                    <span>{{ number_format($movie['vote_average'], 1) }} ({{ $movie['vote_count'] }} votes)</span>
                    <span>|</span>
                    @if (isset($movie['release_date']))
                        <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('d M, Y') }}</span>
                    @else
                        <span>No release date provided.</span>
                    @endif
                    <span>|</span>
                    <span>{{ collect($movie['genres'])->pluck('name')->implode(', ') }}</span>
                </div>
                <div>
                    <h4 class="text-white font-bold">Synopsis:</h4>
                    <p class="text-gray-300">{{ $movie['overview'] }} - {{ $movie['tagline'] }}</p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Crew:</h4>
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-4">
                        @foreach (collect($movie['credits']['crew'])->sortByDesc('popularity')->take(4) as $crew)
                            <div>
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-bold">Spoken languages:</h4>
                    <p class="text-sm text-gray-400">
                        {{ collect($movie['spoken_languages'])->pluck('english_name')->implode(', ') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Production Companies:</h4>
                    <p class="text-sm text-gray-400">
                        {{ collect($movie['production_companies'])->pluck('name')->implode(', ') }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Budget:</h4>
                    <p class="text-sm text-gray-400">
                        {{ \Illuminate\Support\Number::currency($movie['budget']) }}
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold">Revenue:</h4>
                    <p class="text-sm text-gray-400">
                        {{ \Illuminate\Support\Number::currency($movie['revenue']) }}
                    </p>
                </div>
                <div x-data="{ trailerOpen: false }" @keydown.escape="trailerOpen = false">
                    @if (count($movie['videos']['results']) > 0)
                        <button @click="trailerOpen = true"
                            class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold p-4 hover:bg-orange-600 transition ease-in-out duration-150 md:w-auto w-full gap-1">
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
                                            <div class="responsive-container overflow-hidden relative"
                                                style="padding-top: 56.25%">
                                                <iframe class="absolute top-0 left-0 w-full h-full"
                                                    :src="'https://www.youtube.com/embed/' +
                                                    '{{ $movie['videos']['results'][0]['key'] }}'"
                                                    style="border:0;" allow="autoplay; encrypted-media"
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
        <section class="border-t border-b border-gray-800 py-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($movie['credits']['cast'])->sortByDesc('popularity')->take(10) as $cast)
                    <div class="flex flex-col gap-2">
                        <a href="#">
                            <img src="{{ 'https://image.tmdb.org/t/p/w342/' . $cast['profile_path'] }}" alt="Atores"
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
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Images
                {{ $movie['title'] }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">
                @foreach ($movie['images']['backdrops'] as $images)
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
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
                    <div class="lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button @click="isOpen = false" @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="poster">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Reviews</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($movie['reviews']['results'])->take(5) as $review)
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
                        <x-movie-card :movie="$similar" />
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
                        <x-movie-card :movie="$recommendation" />
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
