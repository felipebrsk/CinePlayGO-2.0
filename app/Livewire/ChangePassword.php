<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{
    /**
     * The auth user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The old password.
     *
     * @var string
     */
    public $old_password;

    /**
     * The new password.
     *
     * @var string
     */
    public $password;

    /**
     * The confirmation for new password.
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * The validation rules.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'old_password' => 'required',
        'password' => 'required|min:8|confirmed',
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

        if (!Hash::check($this->old_password, $this->user->password)) {
            throw ValidationException::withMessages(['old_password' => 'The provided password does not match your current password.']);
        }

        if ($this->old_password === $this->password) {
            throw ValidationException::withMessages(['password' => 'Your new password can not be your current password.']);
        }

        $this->user->update(['password' => $this->password]);

        Auth::logout();

        session()->flash('success_message', 'Your password was successfully changed! Please, log in again with your new password.');

        $this->redirect(route('login'));
    }

    /**
     * Render the livewire component view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.change-password');
    }
}
