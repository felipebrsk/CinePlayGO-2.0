<?php

namespace App\Strategies;

use App\Models\{User, TitleRequirement};

class AvatarUploadedStrategy implements TaskStrategy
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
        return $user->picture ? 1 : 0;
    }
}
