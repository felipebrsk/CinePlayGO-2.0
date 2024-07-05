<?php

use Illuminate\Support\Facades\{Auth, Route};
use App\Http\Controllers\{
    HomeController,
    ActorController,
    MovieController,
    TitleController,
    TvShowController,
    ProfileController,
    WatchlistController,
};

Auth::routes();
Route::resource('titles', TitleController::class);
Route::get('/', HomeController::class)->name('home');
Route::resource('movies', MovieController::class)->only('index', 'show');
Route::resource('actors', ActorController::class)->only('index', 'show');
Route::resource('tv-shows', TvShowController::class)->only('index', 'show');
Route::resource('watchlists', WatchlistController::class)->middleware('auth')->only('index', 'store', 'destroy');
Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('profile', 'show')->name('profiles.show');
    Route::get('profile/picture', 'picture')->name('profiles.picture');
    Route::get('profile/password', 'password')->name('profiles.password');
    Route::get('profile/username', 'username')->name('profiles.username');
    Route::get('profile/coins', 'coins')->name('profiles.coins');
    Route::get('profile/titles', 'titles')->name('profiles.titles');
    Route::get('profile/transactions', 'transactions')->name('profiles.transactions');
});
