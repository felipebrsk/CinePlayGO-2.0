<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WatchlistService;
use Illuminate\Contracts\View\View;

class WatchlistController extends Controller
{
    /**
     * The watchlist service.
     *
     * @var \App\Services\WatchlistService
     */
    private $watchlistService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\WatchlistService $watchlistService
     * @return void
     */
    public function __construct(WatchlistService $watchlistService)
    {
        $this->watchlistService = $watchlistService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('watchlists.index', [
            'watchlists' => $this->watchlistService->allForUser(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
