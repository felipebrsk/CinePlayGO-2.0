<?php

namespace Tests\Traits;

use App\Models\{User, Watchlist};
use Illuminate\Database\Eloquent\Collection;

trait HasDummyWatchlist
{
    /**
     * Create a new dummy watchlist.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\Watchlist
     */
    public function createDummyWatchlist(array $data = []): Watchlist
    {
        return Watchlist::factory()->create($data);
    }

    /**
     * Create new dummy watchlists.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyWatchlists(int $times, array $data = []): Collection
    {
        return Watchlist::factory($times)->create($data);
    }

    /**
     * Associate a watchlist for user.
     *
     * @param \App\Models\User $user
     * @param array $data
     * @return \App\Models\Watchlist
     */
    public function createDummyWatchlistTo(User $user, array $data = []): Watchlist
    {
        $watchlist = $this->createDummyWatchlist($data);

        $user->watchlists()->save($watchlist)->save();

        return $watchlist;
    }
}
