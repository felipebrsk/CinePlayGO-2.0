<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Storage;

class ChangePictureTest extends DuskTestCase
{
    /**
     * Test if can't change the picture if photo mime is invalid.
     *
     * @return void
     */
    public function test_if_cant_change_picture_if_photo_mime_is_invalid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.picture'))
                ->waitForText('Change Profile Picture')
                ->assertSee('Change Profile Picture')
                ->attach('input[type=file]', public_path('assets/audios/sample.mp3'))
                ->waitForText('The photo field must be a file of type: png, jpeg, jpg, webp.', 10);
        });
    }

    /**
     * Test if can change the picture successfully.
     *
     * @return void
     */
    public function test_if_can_change_picture_successfully(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.picture'))
                ->waitForText('Change Profile Picture')
                ->assertSee('Change Profile Picture')
                ->attach('input[type=file]', public_path('assets/imgs/profile.jpg'))
                ->waitFor('@preview')
                ->press('Update Picture')
                ->waitForLocation(route('profiles.show'))
                ->assertSee('Your profile picture was successfully updated!');
        });

        Storage::assertExists('profiles/' . $this->user->username . '_profile_picture');
    }
}
