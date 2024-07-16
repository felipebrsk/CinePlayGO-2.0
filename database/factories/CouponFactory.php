<?php

namespace Database\Factories;

use App\Models\CouponType;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->randomDigit(),
            'expiry_date' => Carbon::now()->addDay(),
            'code' => strtoupper(fake()->word()),
            'single_use' => fake()->boolean(),
            'first_purchase' => fake()->boolean(),
            'coupon_type_id' => CouponType::factory()->create(),
        ];
    }
}
