<?php

namespace App\Strategies;

use App\Models\{User, TitleRequirement};

interface TaskStrategy
{
    /**
     * Calculate progress for title tasks.
     *
     * @param \App\Models\User $user
     * @param \App\Models\TitleRequirement $requirement
     * @return int
     */
    public function calculateProgress(User $user, TitleRequirement $requirement): int;
}
