@extends('layouts.main', ['title' => 'Home'])

@section('content')
    <div class="container mx-auto">
        <section class="py-3">
            @include('components.title', ['title' => 'Now Playing'])
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @foreach ($nowPlayingMovies as $movie)
                    <div class="flex justify-center">
                        <x-movie-card :movie="$movie" />
                    </div>
                @endforeach
            </div>
        </section>
        <section class="py-3 border-t border-gray-700">
            @include('components.title', ['title' => 'Now playing tv shows'])
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-4">
                @foreach ($nowPlayingTvShows as $tvShow)
                    <div class="flex justify-center">
                        <x-tv-show-card :tvShow="$tvShow" />
                    </div>
                @endforeach
            </div>
        </section>
        <section class="my-4">
            <button onclick="window.location.href='{{ route('movies.index') }}'"
                class="flex mx-auto justify-center bg-transparent border border-gray-700 text-white rounded
                    font-semibold p-4 hover:bg-orange-400 transition ease-in-out duration-150 md:w-auto w-full">
                <span>View more</span>
            </button>
        </section>
    </div>
@endsection
