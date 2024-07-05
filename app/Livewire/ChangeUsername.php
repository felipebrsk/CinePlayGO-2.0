<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangeUsername extends Component
{
    /**
     * The auth user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The password to confirm.
     *
     * @var string
     */
    public $password;

    /**
     * The new username.
     *
     * @var string
     */
    public $username;

    /**
     * The validation rules.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'password' => 'required|min:8',
        'username' => 'required|string|max:255',
    ];

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
     * @return void
     */
    public function submit(): void
    {
        $this->validate();

        if (!Hash::check($this->password, $this->user->password)) {
            throw ValidationException::withMessages(['password' => 'The provided password does not match your current password.']);
        }

        if (User::where('username', $this->username)->where('id', '!=', $this->user->id)->exists()) {
            throw ValidationException::withMessages(['username' => 'This username has already taken.']);
        }

        $this->user->update(['username' => $this->username]);

        session()->flash('success_message', 'Your username was successfully updated.');

        $this->redirect(route('profiles.show'));
    }

    /**
     * Render the livewire component view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.change-username');
    }
}
