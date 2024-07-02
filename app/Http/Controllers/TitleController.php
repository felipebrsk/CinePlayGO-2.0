<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TitleService;

class TitleController extends Controller
{
    /**
     * The title service.
     *
     * @var \App\Services\TitleService
     */
    private $titleService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\TitleService $titleService
     * @return void
     */
    public function __construct(TitleService $titleService)
    {
        $this->titleService = $titleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
