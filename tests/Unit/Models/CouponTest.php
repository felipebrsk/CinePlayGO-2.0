<?php

namespace Tests\Unit\Models;

use App\Models\Coupon;
use PHPUnit\Framework\TestCase;
use Tests\Traits\TestUnitModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponTest extends TestCase
{
    use TestUnitModels;

    /**
     * The model to be tested.
     *
     * @return string
     */
    protected function model(): string
    {
        return Coupon::class;
    }

    /**
     * Test the model fillable attributes.
     *
     * @return void
     */
    public function test_fillable(): void
    {
        $fillable = [
            'code',
            'type',
            'value',
            'active',
            'min_value',
            'single_use',
            'expiry_date',
            'first_purchase',
        ];

        $this->verifyIfExistFillable($fillable);
    }

    /**
     * Test if the model uses the correctly traits.
     *
     * @return void
     */
    public function test_if_use_traits(): void
    {
        $traits = [
            HasFactory::class,
        ];

        $this->verifyIfUseTraits($traits);
    }

    /**
     * Test the model dates attributes.
     *
     * @return void
     */
    public function test_dates_attribute(): void
    {
        $dates = [
            'created_at',
            'updated_at',
        ];

        $this->verifyDates($dates);
    }

    /**
     * Test the model casts attributes.
     *
     * @return void
     */
    public function test_casts_attribute(): void
    {
        $casts = [
            'id' => 'int',
        ];

        $this->verifyCasts($casts);
    }

    /**
     * Test the constants for the model.
     *
     * @return void
     */
    public function test_constants_for_coupons(): void
    {
        $this->assertEquals(Coupon::FIXED_TYPE_ID, 1);
        $this->assertEquals(Coupon::PERCENT_TYPE_ID, 2);
    }
}
