<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Contracts\View\View;

class CartControl extends Component
{
    /**
     * The cart item.
     *
     * @var \App\Models\CartItem
     */
    public $item;

    /**
     * Mount the cart control component.
     *
     * @param \App\Models\CartItem $item
     * @return void
     */
    public function mount(CartItem $item): void
    {
        $this->item = $item;
    }

    /**
     * Add quantity to cart.
     *
     * @return void
     */
    public function add(): void
    {
        $this->item->increment('qty');

        $this->dispatch('updatePrices');
    }

    /**
     * Remove quantity from cart.
     *
     * @return void
     */
    public function dec(): void
    {
        if ($this->item->qty > 1) {
            $this->item->decrement('qty');

            $this->dispatch('updatePrices');

            return;
        }

        cartService()->remove($this->item);

        $this->dispatch('cartCount', ['count' => cartService()->count()]);

        $this->dispatch('updatePrices');

        $this->dispatch('removeFromCart', ['id' => $this->item->id]);
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart-control');
    }
}
