<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    MovieController,
};

Route::get('/', HomeController::class)->name('home');
Route::resource('movies', MovieController::class)->only('index', 'show');
