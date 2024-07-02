<?php

namespace App\Services;

use App\Repositories\TitleRepository;
use App\Models\{TitleRequirement, User};
use Illuminate\Database\Eloquent\Collection;

class TitleService extends AbstractService
{
    /**
     * The title repository.
     *
     * @var \App\Repositories\TitleRepository
     */
    protected $repository = TitleRepository::class;

    /**
     * Check and award title for user.
     *
     * @param mixed $userId
     * @param \Illuminate\Database\Eloquent\Collection $titles
     * @return void
     */
    public function checkAndAwardTitle(mixed $userId, Collection $titles): void
    {
        $this->repository->checkAndAwardTitle($userId, $titles);
    }
    /**
     * Determine the initial progress.
     *
     * @param \App\Models\User $user
     * @param \App\Models\TitleRequirement $requirement
     * @return int
     */
    public function determineInitialProgress(User $user, TitleRequirement $requirement): int
    {
        return $this->repository->determineInitialProgress($user, $requirement);
    }
}
