<?php

namespace App\Strategies;

use App\Models\{User, TitleRequirement};

class TransactionCountStrategy implements TaskStrategy
{
    /**
     * Calculate progress for avatar uploaded tasks.
     *
     * @param \App\Models\User $user
     * @param \App\Models\TitleRequirement $requirement
     * @return int
     */
    public function calculateProgress(User $user, TitleRequirement $requirement): int
    {
        $count = $user->transactions()->count();

        return $count > $requirement->goal ? $requirement->goal : $count;
    }
}
