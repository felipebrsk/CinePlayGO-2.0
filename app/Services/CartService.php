<?php

namespace App\Services;

use App\Models\Cart;
use App\Repositories\CartRepository;
use Illuminate\Database\Eloquent\Model;

class CartService extends AbstractService
{
    /**
     * The cart repository.
     *
     * @var \App\Repositories\CartRepository
     */
    protected $repository = CartRepository::class;

    /**
     * Check if cart exists for user.
     *
     * @return bool
     */
    public function userHasCart(): bool
    {
        return $this->repository->userHasCart();
    }

    /**
     * Get auth user cart.
     *
     * @return ?\App\Models\Cart
     */
    public function userCart(): ?Cart
    {
        return $this->repository->userCart();
    }
    /**
     * Get the items count.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->repository->count();
    }

    /**
     * Add item to cart.
     *
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return \App\Models\Cart
     */
    public function add(Model $item): Cart
    {
        return $this->repository->add($item);
    }

    /**
     * Remove item from cart.
     *
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return void
     */
    public function remove(Model $item): void
    {
        $this->repository->remove($item);
    }

    /**
     * Clear cart.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->repository->clear();
    }
}
