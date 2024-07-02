<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Services\TitleService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        return view('profiles.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Change the picture view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function picture(): View
    {
        return view('profiles.picture', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Change the password view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function password(): View
    {
        return view('profiles.password', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Change the username view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function username(): View
    {
        return view('profiles.username', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * The coins view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function coins(): View
    {
        return view('profiles.coins', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * The titles view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function titles(): View
    {
        $user = Auth::user();

        return view('profiles.titles', [
            'user' => $user,
            'titles' => $user->titles->mapWithKeys(function (Title $title) {
                return [$title->id => $title->title];
            }),
            'allTitles' => $this->titleService->all(),
        ]);
    }
}
