<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
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
     * @var \App\Services\TvShowService
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
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        return view('home', [
            'nowPlayingMovies' => $this->movieService->filteredMovies([
                'rank' => 'now_playing',
                'page' => 1,
            ]),
            'nowPlayingTvShows' => $this->tvShowService->filteredTvShows([
                'rank' => 'airing_today',
                'page' => 1,
            ]),
        ]);
    }
}
