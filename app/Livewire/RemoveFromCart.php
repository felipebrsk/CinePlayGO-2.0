<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Cart, CartItem};
use Illuminate\Contracts\View\View;

class RemoveFromCart extends Component
{
    /**
     * The item to be removed.
     *
     * @var \App\Models\CartItem
     */
    public $item;

    /**
     * The user cart.
     *
     * @var \App\Models\Cart
     */
    public $cart;

    /**
     * Mount the remove from cart component.
     *
     * @param \App\Models\CartItem $item
     * @param \App\Models\Cart $cart
     * @return void
     */
    public function mount(CartItem $item, Cart $cart): void
    {
        $this->item = $item;
        $this->cart = $cart;
    }

    /**
     * Remove the item from cart.
     *
     * @return void
     */
    public function submit(): void
    {
        $redirectUrl = null;

        if ($this->cart->items->count() === 1) {
            $redirectUrl = request()->header('Referer') ?: route('carts.index');
        }

        cartService()->remove($this->item);

        $this->dispatch('notice', ['message' => 'Item removed from cart!', 'type' => 'success']);

        $this->dispatch('cartCount', ['count' => cartService()->count()]);

        $this->dispatch('updatePrices');

        $this->dispatch('removeFromCart', ['id' => $this->item->id]);

        if ($redirectUrl) {
            session()->flash('success_message', 'Item removed from cart!');

            $this->redirect($redirectUrl);
        }
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.remove-from-cart');
    }
}
