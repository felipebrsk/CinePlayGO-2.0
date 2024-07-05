<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\{Title, UserTitle, UserTitleProgress, User, TitleRequirement};

class TitleRepository extends AbstractRepository
{
    /**
     * The title model.
     *
     * @var \App\Models\Title
     */
    protected $model = Title::class;

    /**
     * Get all titles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model::query()
            ->with('requirements')
            ->where('active', true)
            ->get();
    }

    /**
     * Check and award title for user.
     *
     * @param mixed $userId
     * @param \Illuminate\Database\Eloquent\Collection $titles
     * @return void
     */
    public function checkAndAwardTitle(mixed $userId, Collection $titles): void
    {
        foreach ($titles as $title) {
            $requirements = $title->requirements;
            $completedRequirements = 0;

            foreach ($requirements as $requirement) {
                $progress = UserTitleProgress::where('user_id', $userId)
                    ->where('title_requirement_id', $requirement->id)
                    ->where('completed', true)
                    ->first();

                if ($progress) {
                    $completedRequirements++;
                }
            }

            if ($completedRequirements === $requirements->count()) {
                UserTitle::firstOrCreate([
                    'user_id' => $userId,
                    'title_id' => $title->id,
                ], [
                    'in_use' => false,
                    'acquired_at' => now(),
                ]);
            }
        }
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
        switch ($requirement->task) {
            case 'Store at least five movies on watchlist.':
            case 'Put at least 25 movies on watchlist.':
                $count = $user->watchlists()->count();
                return $count > $requirement->goal ? $requirement->goal : $count;
            case 'Store a picture/avatar on platform.':
                return $user->picture ? 1 : 0;
            case 'Mark at least 10 movies as watched on your watchlist.':
                $count = $user->watchlists()->where('watched', true)->count();
                return $count > $requirement->goal ? $requirement->goal : $count;
            default:
                return 0;
        }
    }
}
