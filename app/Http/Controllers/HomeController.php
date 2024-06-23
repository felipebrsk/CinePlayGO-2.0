<?php

namespace App\Http\Controllers;

use App\Services\{MovieService, TvShowService};

class HomeController extends Controller
{
    /**
     * The movie service.
     *
     * @var \App\Services\MovieService
     */
    private $movieService;

    /**
     * The tv shows service.
     *
     * @var \App\Services\MovieService
     */
    private $tvShowService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\MovieService $movieService
     * @param \App\Services\TvShowService $tvShowService
     * @return void
     */
    public function __construct(MovieService $movieService, TvShowService $tvShowService)
    {
        $this->movieService = $movieService;
        $this->tvShowService = $tvShowService;
    }

    /**
     * Handle the incoming request.
     *
     * @return
     */
    public function __invoke()
    {
        return view('home', [
            'nowPlayingMovies' => $this->movieService->nowPlaying(),
            'nowPlayingTvShows' => $this->tvShowService->nowPlaying(),
        ]);
    }
}
