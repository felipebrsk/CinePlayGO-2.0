<?php

namespace Tests\Traits;

use App\Models\{User, Cart};
use Illuminate\Database\Eloquent\Collection;

trait HasDummyCart
{
    /**
     * Create a new dummy cart.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\Cart
     */
    public function createDummyCart(array $data = []): Cart
    {
        return Cart::factory()->create($data);
    }

    /**
     * Create new dummy carts.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyCarts(int $times, array $data = []): Collection
    {
        return Cart::factory($times)->create($data);
    }

    /**
     * Associate a cart for user.
     *
     * @param \App\Models\User $user
     * @param array $data
     * @return \App\Models\Cart
     */
    public function createDummyCartTo(User $user, array $data = []): Cart
    {
        $cart = $this->createDummyCart($data);

        $user->cart()->save($cart)->save();

        return $cart;
    }
}
