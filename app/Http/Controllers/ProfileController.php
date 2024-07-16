<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Contracts\View\View;
use App\Services\{PackageService, TransactionService};

class ProfileController extends Controller
{
    /**
     * The transaction service.
     *
     * @var \App\Services\TransactionService
     */
    private $transactionService;
    /**
     * The package service.
     *
     * @var \App\Services\PackageService
     */
    private $packageService;

    /**
     * Create a new class instance.
     *
     * @param \App\Services\PackageService $packageService
     * @param \App\Services\TransactionService $transactionService
     * @return void
     */
    public function __construct(
        PackageService $packageService,
        TransactionService $transactionService,
    ) {
        $this->packageService = $packageService;
        $this->transactionService = $transactionService;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        return view('profiles.index', [
            'user' => $this->getAuthenticatedUser(),
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
            'user' => $this->getAuthenticatedUser(),
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
            'user' => $this->getAuthenticatedUser(),
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
            'user' => $this->getAuthenticatedUser(),
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
            'user' => $this->getAuthenticatedUser(),
            'packages' => $this->packageService->all(),
        ]);
    }

    /**
     * The transactions view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function transactions(): View
    {
        return view('profiles.transactions', [
            'user' => $this->getAuthenticatedUser(),
            'transactions' => $this->transactionService->allForUser(),
        ]);
    }

    /**
     * The titles view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function titles(): View
    {
        $user = $this->getAuthenticatedUser();

        return view('profiles.titles', [
            'user' => $user,
            'titles' => $user->titles->mapWithKeys(function (Title $title) {
                return [$title->id => $title->title];
            }),
            'allTitles' => titleService()->all(),
        ]);
    }
}
