<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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
        return view('profiles.titles', [
            'user' => Auth::user(),
            'titles' => [
                10 => 'Enthusiastic',
                25 => 'Absolute Cinema',
                1 => 'Watcher',
            ],
        ]);
    }
}
