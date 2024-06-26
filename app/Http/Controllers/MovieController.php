<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Contracts\View\View;

class MovieController extends Controller
{
    /**
     * The movie service.
     *
     * @var \App\Services\MovieService
     */
    private $movieService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\MovieService $movieService
     * @return void
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        $details = $this->movieService->details($id);

        return view('movies.show', [
            'movie' => $details,
            'similars' => $this->movieService->formatMovies($details['similar']['results']),
            'recommendations' => $this->movieService->formatMovies($details['recommendations']['results']),
        ]);
    }
}
