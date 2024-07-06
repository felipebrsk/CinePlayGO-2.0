<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Hash;

class ChangePasswordTest extends DuskTestCase
{
    /**
     * Test if can't change the password if old password doesn't match.
     *
     * @return void
     */
    public function test_if_cant_change_the_password_if_old_password_doesnt_match(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.password'))
                ->waitForText('Change Password')
                ->assertSee('Change Password')
                ->type('password', 'newpassword1234')
                ->type('password_confirmation', 'newpassword1234')
                ->type('old_password', 'wrongpassword')
                ->press('Update Password')
                ->waitForText('The provided password does not match your current password.');
        });
    }

    /**
     * Test if can't change password if new password is the same as old.
     *
     * @return void
     */
    public function test_if_cant_change_password_if_new_password_is_the_same_as_old(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.password'))
                ->waitForText('Change Password')
                ->assertSee('Change Password')
                ->type('password', 'admin1234')
                ->type('password_confirmation', 'admin1234')
                ->type('old_password', 'admin1234')
                ->press('Update Password')
                ->waitForText('Your new password can not be your current password.');
        });
    }

    /**
     * Test if can update password if data is valid.
     *
     * @return void
     */
    public function test_if_can_update_password_if_data_is_valid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.password'))
                ->waitForText('Change Password')
                ->assertSee('Change Password')
                ->type('password', 'newpassword1234')
                ->type('password_confirmation', 'newpassword1234')
                ->type('old_password', 'admin1234')
                ->press('Update Password')
                ->waitForReload()
                ->assertGuest();
        });

        $this->assertTrue(Hash::check('newpassword1234', $this->user->fresh()->password));
    }
}
