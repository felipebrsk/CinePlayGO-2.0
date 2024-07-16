<?php

namespace Tests\Unit\Jobs;

use Tests\TestCase;
use App\Jobs\RegisterUserJob;
use Illuminate\Support\Facades\{Bus, Queue};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyTitle, HasDummyTitleRequirement, HasDummyUser};

class RegisterUserJobTest extends TestCase
{
    use HasDummyUser;
    use HasDummyTitle;
    use RefreshDatabase;
    use HasDummyTitleRequirement;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createDummyUser();
    }

    /**
     * Test if the job can be dispatched.
     *
     * @return void
     */
    public function test_if_the_job_can_be_dispatched(): void
    {
        Bus::fake();

        Bus::dispatch(new RegisterUserJob($this->user));

        Bus::assertDispatched(RegisterUserJob::class, 1);
    }

    /**
     * Test if the job can be queued.
     *
     * @return void
     */
    public function test_if_the_job_can_be_queued(): void
    {
        Queue::fake();

        Bus::dispatch(new RegisterUserJob($this->user));

        Queue::assertPushed(RegisterUserJob::class, 1);
    }

    /**
     * Test if can create the wallet for user.
     *
     * @return void
     */
    public function test_if_can_create_the_wallet_for_user(): void
    {
        $this->assertDatabaseEmpty('wallets');

        Bus::dispatch(new RegisterUserJob($this->user));

        $this->assertDatabaseCount('wallets', 1)->assertDatabaseHas('wallets', [
            'user_id' => $this->user->id,
            'amount' => 0,
        ]);
    }

    /**
     * Test if can create the title progresses for user.
     *
     * @return void
     */
    public function test_if_can_create_the_title_progresses_for_user(): void
    {
        $title = $this->createDummyTitle();

        $requirement = $this->createDummyTitleRequirementTo($title);

        $this->assertDatabaseEmpty('user_title_progress');

        Bus::dispatch(new RegisterUserJob($this->user));

        $this->assertDatabaseCount('user_title_progress', 1)->assertDatabaseHas('user_title_progress', [
            'progress' => 0,
            'completed' => false,
            'user_id' => $this->user->id,
            'title_requirement_id' => $requirement->id,
        ]);
    }
}
