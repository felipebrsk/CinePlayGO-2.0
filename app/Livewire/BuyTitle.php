<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\{Title, TransactionType, User, UserTitle};

class BuyTitle extends Component
{
    /**
     * The user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The buyable title.
     *
     * @var \App\Models\Title
     */
    public $title;

    /**
     * Mount the livewire component.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Title $title
     * @return void
     */
    public function mount(User $user, Title $title): void
    {
        $this->user = $user;
        $this->title = $title;
    }

    /**
     * Submit the request to change password.
     *
     * @return mixed
     */
    public function submit()
    {
        if ($this->title->price > $this->user->wallet->amount) {
            $this->addError('error_message', 'You have no coins enough to buy this title!');

            return;
        } else {
            $this->user->wallet()->update([
                'amount' => $this->user->wallet->amount - $this->title->price,
            ]);

            $this->user->transactions()->create([
                'amount' => $this->title->price,
                'transaction_type_id' => TransactionType::SUBTRACT_TYPE_ID,
                'description' => 'Purchase of the title ' . $this->title->title,
            ]);

            UserTitle::firstOrCreate([
                'in_use' => false,
                'user_id' => $this->user->id,
                'title_id' => $this->title->id,
            ]);

            return redirect(request()->header('Referer'))->with('success_message', "You have successfully purchased the {$this->title->title} title!");
        }
    }

    /**
     * Render the livewire component view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.buy-title');
    }
}
