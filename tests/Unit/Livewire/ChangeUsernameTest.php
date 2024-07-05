<?php

namespace Tests\Unit\Livewire;

use App\Livewire\ChangeUsername;
use Tests\TestCase;
use Livewire\Livewire;
use Tests\Traits\HasDummyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangeUsernameTest extends TestCase
{
    use HasDummyUser;
    use RefreshDatabase;

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

        $this->user = $this->actingAsDummyUser();
    }

    /**
     * Test if can't change the username if user doesn't provide password or is invalid.
     *
     * @return void
     */
    public function test_if_cant_change_the_username_if_user_doesnt_provide_password_or_is_invalid(): void
    {
        Livewire::test(ChangeUsername::class, ['user' => $this->user])
            ->set('password', 'wrongpassword')
            ->set('username', $username = fake()->unique()->userName())
            ->call('submit')
            ->assertHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'username' => $username,
        ]);
    }

    /**
     * Test if can't change username for a duplicated username.
     *
     * @return void
     */
    public function test_if_cant_change_username_for_a_duplicated_username(): void
    {
        $this->createDummyUser([
            'username' => $duplicated = fake()->unique()->userName(),
        ]);

        Livewire::test(ChangeUsername::class, ['user' => $this->user])
            ->set('password', 'admin1234')
            ->set('username', $duplicated)
            ->call('submit')
            ->assertHasErrors(['username']);

        $this->assertNotEquals($duplicated, $this->user->fresh()->username);
    }

    /**
     * Test if can update username if data is valid.
     *
     * @return void
     */
    public function test_if_can_update_username_if_data_is_valid(): void
    {
        Livewire::test(ChangeUsername::class, ['user' => $this->user])
            ->set('password', 'admin1234')
            ->set('username', $username = fake()->unique()->userName())
            ->call('submit')
            ->assertHasNoErrors(['password', 'username']);

        $this->assertDatabaseHas('users', [
            'username' => $username,
        ]);
    }
}
