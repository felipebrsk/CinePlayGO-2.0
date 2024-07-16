<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class ClearCart extends Component
{
    /**
     * Clear the cart.
     *
     * @return void
     */
    public function submit(): void
    {
        cartService()->clear();

        $this->dispatch('cartCount', ['count' => cartService()->count()]);

        session()->flash('success_message', 'Your cart was successfully cleared.');

        $redirectUrl = request()->header('Referer') ?: route('carts.index');
        $this->redirect($redirectUrl);
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.clear-cart');
    }
}
