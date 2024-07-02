<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{User, UserTitle};
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class ChangeTitle extends Component
{
    /**
     * The user titles.
     *
     * @var \Illuminate\Support\Collection
     */
    public $titles;

    /**
     * The selected title.
     *
     * @var mixed
     */
    public $selected;

    /**
     * The user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The rules for select title.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'selected' => 'required|exists:titles,id',
    ];


    /**
     * Mount the change title component.
     *
     * @param \App\Models\User $user
     * @param \Illuminate\Support\Collection $titles
     * @return void
     */
    public function mount(User $user, Collection $titles): void
    {
        $this->user = $user;
        $this->titles = $titles;
        $this->selected = $user->titles()->where('in_use', true)->first()?->id ?? '';
    }

    /**
     * Submit the request to change password.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(): mixed
    {
        $this->validate();

        UserTitle::query()
            ->where('user_id', $this->user->id)
            ->update([
                'in_use' => false,
            ]);

        UserTitle::query()
            ->where('user_id', $this->user->id)
            ->where('title_id', $this->selected)
            ->update([
                'in_use' => true,
            ]);

        return redirect(request()->header('Referer'))->with('success_message', 'Your title was successfully updated!');
    }

    /**
     * Render the livewire component view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.change-title');
    }
}
