<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\{SerializesModels, InteractsWithQueue};
use App\Models\{Title, TitleRequirement, User, UserTitleProgress};

class RegisterUserJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    /**
     * The registered user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->wallet()->create([
            'amount' => 0,
        ]);

        titleService()->all()->each(function (Title $title) {
            $title->requirements->each(function (TitleRequirement $requirement) {
                UserTitleProgress::create([
                    'user_id' => $this->user->id,
                    'title_requirement_id' => $requirement->id,
                    'progress' => 0,
                    'completed' => false,
                ]);
            });
        });
    }
}
