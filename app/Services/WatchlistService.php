<?php

namespace App\Services;

use App\Repositories\WatchlistRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class WatchlistService extends AbstractService
{
    /**
     * The watchlist repository.
     *
     * @var \App\Repositories\WatchlistRepository
     */
    protected $repository = WatchlistRepository::class;

    /**
     * Get all the watchlists for user.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function allForUser(): LengthAwarePaginator
    {
        return $this->repository->allForUser();
    }
}
