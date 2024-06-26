<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use Illuminate\Contracts\View\View;

class ActorController extends Controller
{
    /**
     * The movie service.
     *
     * @var \App\Services\ActorService
     */
    private $actorService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\ActorService $actorService
     * @return void
     */
    public function __construct(ActorService $actorService)
    {
        $this->actorService = $actorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('actors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $details = $this->actorService->details($id);

        return view('actors.show', [
            'actor' => $details,
        ]);
    }
}
