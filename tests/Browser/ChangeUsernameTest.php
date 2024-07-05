<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ChangeUsernameTest extends DuskTestCase
{
    /**
     * Test if can't change the username if user doesn't provide password or is invalid.
     *
     * @return void
     */
    public function test_if_cant_change_the_username_if_user_doesnt_provide_password_or_is_invalid(): void
    {
        $username = '';

        $this->browse(function (Browser $browser) use (&$username) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.username'))
                ->waitForText('Change Username')
                ->assertSee('Change Username')
                ->type('password', 'wrongpassword')
                ->type('username', $username = fake()->unique()->userName())
                ->press('Update Username')
                ->waitForText('The provided password does not match your current password.');
        });

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

        $this->browse(function (Browser $browser) use ($duplicated) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.username'))
                ->waitForText('Change Username')
                ->assertSee('Change Username')
                ->type('password', 'admin1234')
                ->type('username', $duplicated)
                ->press('Update Username')
                ->waitForText('This username has already taken.');
        });

        $this->assertNotEquals($duplicated, $this->user->fresh()->username);
    }

    /**
     * Test if can update username if data is valid.
     *
     * @return void
     */
    public function test_if_can_update_username_if_data_is_valid(): void
    {
        $username = '';

        $this->browse(function (Browser $browser) use (&$username) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.username'))
                ->waitForText('Change Username')
                ->assertSee('Change Username')
                ->type('password', 'admin1234')
                ->type('username', $username = fake()->unique()->userName())
                ->press('Update Username')
                ->waitForReload(seconds: 5)
                ->waitForText('Your username was successfully updated.', 10);
        });

        $this->assertDatabaseHas('users', [
            'username' => $username,
        ]);
    }
}
