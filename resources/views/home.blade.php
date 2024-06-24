@extends('layouts.main')
@section('content')
    <section class="hero w-full bg-cover bg-center h-96"
        style="background-image: url('{{ asset('assets/imgs/hero.png') }}');">
        <div class="container mx-auto h-full flex items-center justify-center text-center">
            <div class="text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Welcome to CinePlayGO 2.0</h1>
                <p class="text-lg md:text-xl mb-8">Discover your next favorite movie or TV show</p>
            </div>
        </div>
    </section>
    <section class="container mx-auto py-8">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold sm:text-left text-center">
            Now playing movies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-8">
            @foreach ($nowPlayingMovies as $movie)
                <div class="flex justify-center">
                    <x-movie-card :movie="$movie" />
                </div>
            @endforeach
        </div>
    </section>
    <section class="container mx-auto py-8 border-t border-gray-700">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold sm:text-left text-center">
            Now playing tv shows
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-8">
            @foreach ($nowPlayingTvShows as $tvShow)
                <div class="flex justify-center">
                    <x-tv-show-card :tvShow="$tvShow" />
                </div>
            @endforeach
        </div>
    </section>
@endsection
