<?php

namespace App\Http\Controllers;

use App\Services\TvShowService;
use Illuminate\Contracts\View\View;

class TvShowController extends Controller
{
    /**
     * The movie service.
     *
     * @var \App\Services\TvShowService
     */
    private $tvShowService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\TvShowService $tvShowService
     * @return void
     */
    public function __construct(TvShowService $tvShowService)
    {
        $this->tvShowService = $tvShowService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('tv-shows.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $details = $this->tvShowService->details($id);

        return view('tv-shows.show', [
            'tvShow' => $details,
            'similars' => $this->tvShowService->formatTvShows($details['similar']['results']),
            'recommendations' => $this->tvShowService->formatTvShows($details['recommendations']['results'])
        ]);
    }
}
