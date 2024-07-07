<?php

namespace App\Strategies;

use App\Models\{User, TitleRequirement};

class WatchedMoviesStrategy implements TaskStrategy
{
    /**
     * Calculate progress for watched movies tasks.
     *
     * @param \App\Models\User $user
     * @param \App\Models\TitleRequirement $requirement
     * @return int
     */
    public function calculateProgress(User $user, TitleRequirement $requirement): int
    {
        $count = $user->watchlists()->where('watched', true)->count();

        return $count > $requirement->goal ? $requirement->goal : $count;
    }
}
