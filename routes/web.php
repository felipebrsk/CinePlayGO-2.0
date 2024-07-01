<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\{
    HomeController,
    ActorController,
    MovieController,
    TvShowController,
    WatchlistController,
};

Auth::routes();
Route::get('/', HomeController::class)->name('home');
Route::resource('movies', MovieController::class)->only('index', 'show');
Route::resource('actors', ActorController::class)->only('index', 'show');
Route::resource('tv-shows', TvShowController::class)->only('index', 'show');
Route::resource('watchlists', WatchlistController::class)->middleware('auth')->only('index', 'store', 'destroy');
