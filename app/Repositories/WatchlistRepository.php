<?php

namespace App\Repositories;

use App\Models\Watchlist;
use Illuminate\Pagination\LengthAwarePaginator;

class WatchlistRepository extends AbstractRepository
{
    /**
     * The watchlist model.
     *
     * @var \App\Models\Watchlist
     */
    protected $model = Watchlist::class;

    /**
     * Get all the watchlists for user.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function allForUser(): LengthAwarePaginator
    {
        return $this->model::byUser()->paginate(self::PER_PAGE);
    }
}
