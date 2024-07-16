<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use Tests\Traits\HasDummyUser;
use App\Livewire\ChangePicture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePictureTest extends TestCase
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
     * Test if can't change the picture if photo mime is invalid.
     *
     * @return void
     */
    public function test_if_cant_change_picture_if_photo_mime_is_invalid(): void
    {
        Livewire::test(ChangePicture::class, ['user' => $this->user])
            ->set('photo', UploadedFile::fake()->create('fake.mp3'))
            ->call('submit')
            ->assertHasErrors(['photo']);
    }

    /**
     * Test if can store a new profile picture for user.
     *
     * @return void
     */
    public function test_if_can_store_a_new_profile_picture_for_user(): void
    {
        $this->assertNull($this->user->fresh()->picture);

        Livewire::test(ChangePicture::class, ['user' => $this->user])
            ->set('photo', UploadedFile::fake()->create('fake.png'))
            ->call('submit')
            ->assertHasNoErrors(['photo']);

        $this->assertNotNull($this->user->fresh()->picture);

        $this->assertDatabaseHas('users', [
            'picture' => 'profiles/' . $this->user->username . '_profile_picture',
        ]);
    }

    /**
     * Test if can store the picture on storage.
     *
     * @return void
     */
    public function test_if_can_store_the_picture_on_storage(): void
    {
        $path = 'profiles/' . $this->user->username . '_profile_picture';

        Storage::assertMissing($path);

        Livewire::test(ChangePicture::class, ['user' => $this->user])
            ->set('photo', UploadedFile::fake()->create('fake.png'))
            ->call('submit')
            ->assertHasNoErrors(['photo']);

        Storage::assertExists($path);
    }
}
