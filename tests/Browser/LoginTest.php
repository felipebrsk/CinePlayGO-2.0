<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /**
     * Test if can't log in if email doesn't exist on database.
     *
     * @return void
     */
    public function test_if_cant_log_in_if_email_doesnt_exist_on_database(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->assertSee('Login')
                ->type('email', 'fake@gmail.com')
                ->type('password', 'admin1234')
                ->press('Login')
                ->waitForText('These credentials do not match our records.');
        });
    }

    /**
     * Test if can't log in if password is invalid.
     *
     * @return void
     */
    public function test_if_cant_log_in_if_password_is_invalid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('login'))
                ->assertSee('Login')
                ->type('email', $this->user->email)
                ->type('password', 'wrongpass1234')
                ->press('Login')
                ->waitForText('These credentials do not match our records.');
        });
    }
}
