@extends('layouts.main')

@section('content')
    <div class="w-full container mx-auto flex flex-col gap-8 sm:px-8 px-2">
        <section class="flex flex-col md:flex-row items-center pt-8">
            <img alt="{{ $movie['title'] }}" src="{{ 'https://image.tmdb.org/t/p/w780/' . $movie['poster_path'] }}"
                class="w-full max-w-[30rem] rounded-md" />
            <div class="flex flex-col md:ml-8 mt-4 md:mt-0 gap-3">
                <div class="flex sm:flex-row flex-col justify-between items-center sm:gap-0 gap-4">
                    <a href={{ $movie['homepage'] }} target="_blank"
                        class="text-4xl font-semibold w-auto max-w-fit underline hover:text-blue-400 transition duration-200">
                        {{ $movie['title'] }}
                    </a>
                    @livewire('add-to-watchlist', ['media' => $movie, 'type' => \App\Models\MediaType::MOVIE_TYPE_ID], key($movie['id']))
                </div>
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
                <div class="flex md:flex-row flex-col gap-2">
                    @include('components.trailer', ['videos' => $movie['videos']['results']])
                    @include('components.watch-providers', ['providers' => $providers])
                </div>
            </div>
        </section>
        <section class="border-t border-b border-gray-800 py-4">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-4">
                @foreach (collect($movie['credits']['cast'])->sortByDesc('popularity')->take(10) as $cast)
                    <x-actor-card :cast="$cast" />
                @endforeach
            </div>
        </section>
        <section x-data="{ isOpen: false, image: '' }">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Images from {{ $movie['title'] }}
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">
                @if (count($movie['images']['backdrops']) > 0)
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
                @else
                    <p class="text-lg text-gray-400 mt-4">
                        No images was found.
                    </p>
                @endif
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
                @if (count($movie['reviews']['results']) > 0)
                    @foreach (collect($movie['reviews']['results'])->take(5) as $review)
                        <x-review-card :review="$review" />
                    @endforeach
                @else
                    <p class="text-lg text-gray-400">
                        No one review found.
                    </p>
                @endif
            </div>
        </section>
        <section class="py-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Similar movies
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @if (count($similars) > 0)
                    @foreach ($similars as $similar)
                        <div class="flex justify-center">
                            <x-movie-card :movie="$similar" />
                        </div>
                    @endforeach
                @else
                    <p class="text-lg text-gray-400">
                        No one similar movie was found.
                    </p>
                @endif
            </div>
        </section>
        <section class="py-6 border-t border-gray-700">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold md:text-left text-center">
                Recommendations
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @if (count($recommendations) > 0)
                    @foreach ($recommendations as $recommendation)
                        <div class="flex justify-center">
                            <x-movie-card :movie="$recommendation" />
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
