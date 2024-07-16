<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\{
    HomeController,
    ActorController,
    MovieController,
    TitleController,
    TvShowController,
};

Auth::routes();
Route::resource('titles', TitleController::class);
Route::get('/', HomeController::class)->name('home');
Route::resource('movies', MovieController::class)->only('index', 'show');
Route::resource('actors', ActorController::class)->only('index', 'show');
Route::resource('tv-shows', TvShowController::class)->only('index', 'show');
