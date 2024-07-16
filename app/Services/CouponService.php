<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\CouponRepository;
use App\Models\{Cart, Coupon, Package};
use App\Exceptions\BadRequestException;
use Illuminate\Support\{Number, Carbon};
use Illuminate\Contracts\Auth\Authenticatable;

class CouponService extends AbstractService
{
    /**
     * The coupon repository.
     *
     * @var \App\Repositories\CouponRepository
     */
    protected $repository = CouponRepository::class;

    /**
     *  Find coupon by code.
     *
     *  @param string $code
     *  @return ?\App\Models\Coupon
     */
    public function findByCode(string $code): ?Coupon
    {
        return $this->repository->findByCode($code);
    }

    /**
     *  Apply coupon in user session.
     *
     *  @param string $code
     *  @return void
     */
    public function apply(string $code): void
    {
        $cart = cartService()->userCart();
        $coupon = $this->findByCode($code);
        $user = Auth::user();

        $this->assertCanApply($coupon, $cart, $user);

        $this->repository->apply($coupon, $cart);
    }

    /**
     * Remove coupon from session.
     *
     * @return void
     */
    public function remove(): void
    {
        $this->repository->remove();
    }

    /**
     * Assert user can apply.
     *
     * @param ?\App\Models\Coupon $coupon
     * @param ?\App\Models\Cart $cart
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     * @throws \App\Exceptions\BadRequestException
     */
    public function assertCanApply(?Coupon $coupon, ?Cart $cart, Authenticatable $user): void
    {
        if (!$cart) {
            throw new BadRequestException('The cart is not valid. Please, reload the page and try again.');
        }
        if (!$coupon) {
            throw new BadRequestException('The coupon does not exist. Please, double check the code and try again later.');
        }
        if ($this->couponIsExpired($coupon)) {
            throw new BadRequestException('This coupon is already expired!');
        }
        if ($this->coinsIsAlreadyHigherThanTotal($cart, $user)) {
            throw new BadRequestException('You can not apply a coupon if coins amount is higher or same price of cart total.');
        }
        if (!$this->cartValueBiggerThanCoupon($coupon, $cart)) {
            throw new BadRequestException('The use of this coupon is not allowed for your cart.');
        }
        if (!$this->cartHasMinValueToAplly($coupon, $cart)) {
            $min = Number::currency($coupon->min_value / 100);

            throw new BadRequestException("This coupon has a min value of {$min} USD to be applied.");
        }
        if ($this->alreadyUsedCoupon($coupon, $user)) {
            throw new BadRequestException('This coupon can be applied only once!');
        }
        if ($this->alreadyHavePurchases($coupon, $user)) {
            throw new BadRequestException('This coupon is available only for first purchase on platform.');
        }
    }

    /**
     * Already used this coupon.
     *
     * @param \App\Models\Coupon $coupon
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return bool
     */
    private function alreadyUsedCoupon(Coupon $coupon, Authenticatable $user): bool
    {
        if ($coupon->single_use) {
            return false;
        }

        return false;
    }

    /**
     * Already used this coupon.
     *
     * @param \App\Models\Coupon $coupon
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return bool
     */
    private function alreadyHavePurchases(Coupon $coupon, Authenticatable $user): bool
    {
        if ($coupon->first_purchase) {
            return false;
        }

        return false;
    }

    /**
     * Assert if coupon is not expired.
     *
     * @param \App\Models\Coupon
     * @return bool
     */
    private function couponIsExpired(Coupon $coupon): bool
    {
        return $coupon->expiry_date < Carbon::now()->toDateString();
    }

    /**
     * Assert if the cart meets the minimum coupon value.
     *
     * @param \App\Models\Coupon $coupon
     * @param \App\Models\Cart $cart
     * @return bool
     */
    private function cartHasMinValueToAplly(Coupon $coupon, Cart $cart): bool
    {
        $has = true;

        if ($minValue = $coupon->min_value) {
            $has = $cart->total > $minValue;
        }

        return $has;
    }

    /**
     * Assert if cart value is bigger than coupon value.
     *
     * @param \App\Models\Coupon $coupon
     * @param \App\Models\Cart $cart
     * @return bool
     */
    private function cartValueBiggerThanCoupon(Coupon $coupon, Cart $cart): bool
    {
        return $cart->total > $coupon->value;
    }

    /**
     * Assert if coins amount is already the cart totals.
     *
     * @param \App\Models\Cart $cart
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return bool
     */
    public function coinsIsAlreadyHigherThanTotal(Cart $cart, Authenticatable $user): bool
    {
        if ($cart->use_coins) {
            return (($user->wallet->amount * Package::EXCHANGE_MULTIPLIER) * 100) >= $cart->total;
        }

        return false;
    }
}
