<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\{Cart, User, Package};

class CartPrices extends Component
{
    /**
     * The user cart.
     *
     * @var \App\Models\Cart
     */
    public $cart;

    /**
     * The user.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The subtotal price.
     *
     * @var int
     */
    public $subtotal;

    /**
     * The total price.
     *
     * @var int
     */
    public $total;

    /**
     * The discount price.
     *
     * @var int
     */
    public $discount;

    /**
     * Define the listeners for the component.
     *
     * @var array<int, string>
     */
    protected $listeners = ['updatePrices'];

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

        $this->updatePrices();
    }

    /**
     * Update cart prices.
     *
     * @return void
     */
    public function updatePrices(): void
    {
        $this->subtotal = $this->cart->total;
        $this->discount = 0;
        $this->total = $this->subtotal;

        if ($coupon = session('coupon')) {
            $this->discount = $coupon['value'];
            $this->total -= $coupon['value'];
        }

        if ($this->cart->use_coins) {
            $coinValue = ($this->user->wallet->amount * Package::EXCHANGE_MULTIPLIER) * 100;

            if ($coinValue >= $this->total) {
                $this->discount = $this->cart->total;
                $this->total = 0;
            } else {
                $this->discount += $coinValue;
                $this->total -= $coinValue;
            }
        }
    }

    /**
     * Render the cart prices view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart-prices');
    }
}
