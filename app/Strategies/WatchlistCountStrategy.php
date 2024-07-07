<?php

namespace App\Strategies;

use App\Models\{User, TitleRequirement};

class WatchlistCountStrategy implements TaskStrategy
{
    /**
     * Calculate progress for watchlist tasks.
     *
     * @param \App\Models\User $user
     * @param \App\Models\TitleRequirement $requirement
     * @return int
     */
    public function calculateProgress(User $user, TitleRequirement $requirement): int
    {
        $count = $user->watchlists()->count();

        return $count > $requirement->goal ? $requirement->goal : $count;
    }
}
