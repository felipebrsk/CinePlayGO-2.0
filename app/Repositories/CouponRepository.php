<?php

namespace App\Repositories;

use App\Models\{Cart, Coupon};

class CouponRepository extends AbstractRepository
{
    /**
     * The coupon repository.
     *
     * @var \App\Models\Coupon
     */
    protected $model = Coupon::class;

    /**
     * Find coupon by code.
     *
     * @param string $code
     * @return ?\App\Models\Coupon
     */
    public function findByCode(string $code): ?Coupon
    {
        return $this->model::findByCode($code);
    }

    /**
     * Apply coupon in user session.
     *
     * @param \App\Models\Coupon $coupon
     * @param \App\Models\Cart $cart
     * @return void
     */
    public function apply(Coupon $coupon, Cart $cart): void
    {
        session()->put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $coupon->value,
            'type' => $coupon->coupon_type_id,
            'value' => $coupon->discount($cart->total),
        ]);
    }

    /**
     * Remove coupon from session.
     *
     * @return void
     */
    public function remove(): void
    {
        session()->forget('coupon');
    }
}
