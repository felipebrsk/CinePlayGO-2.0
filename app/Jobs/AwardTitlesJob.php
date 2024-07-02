<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\TitleService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\{SerializesModels, InteractsWithQueue};

class AwardTitlesJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    /**
     * The user id.
     *
     * @var mixed
     */
    private $userId;

    /**
     * The titles.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $titles;

    /**
     * Create a new job instance.
     *
     * @param mixed $userId
     * @param \Illuminate\Database\Eloquent\Collection $titles
     * @return void
     */
    public function __construct(mixed $userId, Collection $titles)
    {
        $this->userId = $userId;
        $this->titles = $titles;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $titleService = new TitleService();

        $titleService->checkAndAwardTitle($this->userId, $this->titles);
    }
}
