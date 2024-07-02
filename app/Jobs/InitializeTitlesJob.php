<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\TitleService;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\{SerializesModels, InteractsWithQueue};
use App\Models\{Title, TitleRequirement, UserTitleProgress};

class InitializeTitlesJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $titleService = new TitleService();
        $titles = $titleService->all();

        UserTitleProgress::where('completed', false)
            ->chunk(500, function (Collection $incompleteProgress) use ($titles, $titleService) {
                $incompleteProgress->each(function (UserTitleProgress $progress) use ($titles, $titleService) {
                    $user = $progress->user;

                    $titles->each(function (Title $title) use ($user, $titleService) {
                        $title->requirements->each(function (TitleRequirement $titleRequirement) use ($user, $titleService) {
                            $progress = $titleService->determineInitialProgress($user, $titleRequirement);

                            UserTitleProgress::updateOrCreate(
                                [
                                    'user_id' => $user->id,
                                    'title_requirement_id' => $titleRequirement->id,
                                ],
                                [
                                    'progress' => $progress,
                                    'completed' => $progress >= $titleRequirement->goal,
                                ]
                            );
                        });
                    });

                    AwardTitlesJob::dispatch($user->id, $titles);
                });
            });
    }
}
