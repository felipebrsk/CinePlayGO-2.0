<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Component
{
    /**
     * The item to be added to cart.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $item;

    /**
     * Mount the add to cart component.
     *
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return void
     */
    public function mount(Model $item): void
    {
        $this->item = $item;
    }

    /**
     * Add the item to cart.
     *
     * @return void
     */
    public function submit(): void
    {
        cartService()->add($this->item);

        $this->dispatch('notice', ['message' => 'Item added to cart!', 'type' => 'success']);

        $this->dispatch('cartCount', ['count' => cartService()->count()]);
    }

    /**
     * Render the add to cart view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.add-to-cart');
    }
}
