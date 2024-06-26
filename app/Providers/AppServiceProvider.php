<?php

namespace App\Providers;

use App\Client\TmdbClient;
use Illuminate\Support\ServiceProvider;
use App\Services\{GenreService, MovieService};
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TmdbClient::class, function () {
            return new TmdbClient();
        });

        $this->app->bind(GenreService::class, function (Application $app) {
            return new GenreService($app->make(TmdbClient::class));
        });

        $this->app->bind(MovieService::class, function (Application $app) {
            return new MovieService($app->make(TmdbClient::class), $app->make(GenreService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
