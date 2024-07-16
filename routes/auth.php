<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CartController,
    ProfileController,
    WatchlistController,
};

Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'show')->name('profiles.show');
    Route::get('profile/picture', 'picture')->name('profiles.picture');
    Route::get('profile/password', 'password')->name('profiles.password');
    Route::get('profile/username', 'username')->name('profiles.username');
    Route::get('profile/coins', 'coins')->name('profiles.coins');
    Route::get('profile/titles', 'titles')->name('profiles.titles');
    Route::get('profile/transactions', 'transactions')->name('profiles.transactions');
});

Route::get('carts', CartController::class)->name('carts.index');

Route::resource('watchlists', WatchlistController::class)->only('index', 'store', 'destroy');
