<?php

namespace Tests\Traits;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Collection;

trait HasDummyCoupon
{
    /**
     * Create a new dummy coupon.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\Coupon
     */
    public function createDummyCoupon(array $data = []): Coupon
    {
        return Coupon::factory()->create($data);
    }

    /**
     * Create new dummy coupons.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyCoupons(int $times, array $data = []): Collection
    {
        return Coupon::factory($times)->create($data);
    }
}
