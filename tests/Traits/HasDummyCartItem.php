<?php

namespace Tests\Traits;

use App\Models\{Cart, CartItem};
use Illuminate\Database\Eloquent\Collection;

trait HasDummyCartItem
{
    /**
     * Create a new dummy cart item.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\CartItem
     */
    public function createDummyCartItem(array $data = []): CartItem
    {
        return CartItem::factory()->create($data);
    }

    /**
     * Create new dummy cart items.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyCartItems(int $times, array $data = []): Collection
    {
        return CartItem::factory($times)->create($data);
    }

    /**
     * Associate a cart item for cart.
     *
     * @param \App\Models\Cart $user
     * @param array $data
     * @return \App\Models\CartItem
     */
    public function createDummyCartItemTo(Cart $cart, array $data = []): CartItem
    {
        $cartItem = $this->createDummyCartItem($data);

        $cart->items()->save($cartItem)->save();

        return $cartItem;
    }
}
