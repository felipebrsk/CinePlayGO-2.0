<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use Tests\Traits\HasDummyUser;
use App\Livewire\ChangePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordTest extends TestCase
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
     * Test if can't change the password if old password doesn't match.
     *
     * @return void
     */
    public function test_if_cant_change_the_password_if_old_password_doesnt_match(): void
    {
        Livewire::test(ChangePassword::class, ['user' => $this->user])
            ->set('old_password', 'wrongpass')
            ->set('password', 'newpassword')
            ->set('password_confirmation', 'newpassword')
            ->call('submit')
            ->assertHasErrors(['old_password']);
    }

    /**
     * Test if can't change password if new password is the same as old.
     *
     * @return void
     */
    public function test_if_cant_change_password_if_new_password_is_the_same_as_old(): void
    {
        Livewire::test(ChangePassword::class, ['user' => $this->user])
            ->set('password', 'admin1234')
            ->set('password_confirmation', 'admin1234')
            ->set('old_password', 'admin1234')
            ->call('submit')
            ->assertHasErrors(['password']);
    }

    /**
     * Test if can update password if data is valid.
     *
     * @return void
     */
    public function test_if_can_update_password_if_data_is_valid(): void
    {
        Livewire::test(ChangePassword::class, ['user' => $this->user])
            ->set('password', 'newpassword1234')
            ->set('password_confirmation', 'newpassword1234')
            ->set('old_password', 'admin1234')
            ->call('submit')
            ->assertHasNoErrors(['password', 'old_password']);

        $this->assertTrue(Hash::check('newpassword1234', $this->user->fresh()->password));
    }
}
