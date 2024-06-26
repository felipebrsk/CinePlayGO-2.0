<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ActorController,
    MovieController,
    TvShowController,
};

Route::get('/', HomeController::class)->name('home');
Route::resource('movies', MovieController::class)->only('index', 'show');
Route::resource('actors', ActorController::class)->only('index', 'show');
Route::resource('tv-shows', TvShowController::class)->only('index', 'show');
