<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Contracts\View\View;
use Livewire\{Component, WithFileUploads};

class ChangePicture extends Component
{
    use WithFileUploads;

    /**
     * The changeable photo.
     *
     * @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
     */
    #[Validate('required|file|mimes:png,jpeg,jpg,webp|max:1024')]
    public $photo;

    /**
     * The auth user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Mount the livewire component.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function mount(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Submit the request to change password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(): mixed
    {
        if ($this->user->picture) {
            s3Service()->delete($this->user->picture);
        }

        $photo = $this->photo->storeAs(
            'profiles',
            $this->user->username . '_profile_picture',
            's3',
            'private',
        );

        $this->user->update([
            'picture' => $photo,
        ]);

        $this->removeTemporaryFile();

        return redirect()->route('profiles.show')->with('success_message', 'Your profile picture was successfully updated!');
    }

    /**
     * Remove the temporary file from storage.
     *
     * @return void
     */
    protected function removeTemporaryFile(): void
    {
        if ($this->photo) {
            $path = $this->photo->getPathname();

            if (s3Service()->exists($path)) {
                s3Service()->delete($path);
            }
        }
    }

    /**
     * Render the livewire component view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.change-picture');
    }
}
