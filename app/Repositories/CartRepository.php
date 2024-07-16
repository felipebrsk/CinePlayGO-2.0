<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CartRepository extends AbstractRepository
{
    /**
     * The cart model.
     *
     * @var \App\Models\Cart
     */
    protected $model = Cart::class;

    /**
     * Check if cart exists for user.
     *
     * @return bool
     */
    public function userHasCart(): bool
    {
        return $this->model::where('user_id', Auth::id())->exists();
    }

    /**
     * Get auth user cart.
     *
     * @return ?\App\Models\Cart
     */
    public function userCart(): ?Cart
    {
        return $this->model::where('user_id', Auth::id())->first();
    }

    /**
     * Get the items count.
     *
     * @return int
     */
    public function count(): int
    {
        $cart = $this->userCart();

        if ($cart) {
            return $cart->items()->count();
        }

        return 0;
    }

    /**
     * Add item to cart.
     *
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return \App\Models\Cart
     */
    public function add(Model $item): Cart
    {
        $cart = $this->userCart();

        if (!$cart) {
            $cart = $this->create([
                'user_id' => Auth::id(),
            ]);
        }

        $cartItem = $cart->items()
            ->where('itemable_id', $item->id)
            ->where('itemable_type', $item::class)
            ->first();

        if ($cartItem) {
            $cartItem->increment('qty');
        } else {
            $cart->items()->create([
                'qty' => 1,
                'price' => $item->price,
                'itemable_id' => $item->id,
                'itemable_type' => $item::class,
            ]);
        }

        return $cart;
    }

    /**
     * Remove item from cart.
     *
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return void
     */
    public function remove(Model $item): void
    {
        $cart = $this->userCart();

        $cart->items()->where('id', $item->id)->delete();

        if ($cart->items->isEmpty()) {
            $cart->delete();
        }
    }

    /**
     * Clear cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $cart = $this->userCart();

        $cart->delete();
    }
}
