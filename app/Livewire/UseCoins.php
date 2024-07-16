<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{User, Cart};
use Illuminate\Contracts\View\View;

class UseCoins extends Component
{
    /**
     * The user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The user cart.
     *
     * @var \App\Models\Cart
     */
    public $cart;

    /**
     * The boolean to use coins.
     *
     * @var bool
     */
    public $use;

    /**
     * The use coins validation.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'use' => 'required|boolean',
    ];

    /**
     * Mount the component.
     *
     * @param \App\Models\Cart $cart
     * @param \App\Models\User $user
     * @return void
     */
    public function mount(Cart $cart, User $user): void
    {
        $this->cart = $cart;
        $this->user = $user;

        $this->use = $cart->use_coins;
    }

    /**
     * Check if user can use coins and update cart prices.
     *
     * @return void
     */
    public function submit(): void
    {
        $this->validate();

        if ($this->use) {
            $message = 'The coins are now in use.';

            $this->cart->update([
                'use_coins' => true,
            ]);
        } else {
            $message = 'The coins are not in use.';

            $this->cart->update([
                'use_coins' => false,
            ]);
        }

        $this->dispatch('updatePrices');

        $this->dispatch('notice', ['message' => $message, 'type' => 'success']);
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.use-coins');
    }
}
