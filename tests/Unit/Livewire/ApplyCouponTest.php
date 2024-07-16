<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\ApplyCoupon;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyCoupon, HasDummyPackage, HasDummyUser};

class ApplyCouponTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
    use HasDummyCoupon;
    use HasDummyPackage;
    use RefreshDatabase;
    use HasDummyCartItem;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * The dummy cart.
     *
     * @var \App\Models\Cart
     */
    private $cart;

    /**
     * The dummy coupon.
     *
     * @var \App\Models\Coupon
     */
    private $coupon;

    /**
     * The dummy item.
     *
     * @var \App\Models\CartItem
     */
    private $item;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->actingAsDummyUser();

        $this->cart = $this->createDummyCartTo($this->user);

        $package = $this->createDummyPackage();

        $this->item = $this->createDummyCartItemTo($this->cart, [
            'qty' => 1,
            'price' => 1000,
            'itemable_id' => $package->id,
            'itemable_type' => $package::class,
        ]);

        $this->coupon = $this->createDummyCoupon([
            'code' => 'DISCOUNT10',
            'value' => 200,
            'min_value' => 500,
            'expiry_date' => Carbon::now()->addDay(),
        ]);
    }

    /**
     * Test if can apply coupon successfully.
     *
     * @return void
     */
    public function test_if_can_apply_coupon_successfully(): void
    {
        Livewire::test(ApplyCoupon::class)
            ->set('code', 'DISCOUNT10')
            ->call('apply')
            ->assertDispatched('updatePrices')
            ->assertDispatched('notice', [
                'message' => 'The coupon was successfully applied',
                'type' => 'success'
            ]);

        $this->assertEquals(session('coupon')['value'], 200);
    }

    /**
     * Test if fails to apply invalid coupon.
     *
     * @return void
     */
    public function test_if_fails_to_apply_invalid_coupon(): void
    {
        Livewire::test(ApplyCoupon::class)
            ->set('code', 'INVALID')
            ->call('apply')
            ->assertHasErrors(['code' => 'The coupon does not exist. Please, double check the code and try again later.']);
    }

    /**
     * Test if can't apply an expired coupon.
     *
     * @return void
     */
    public function test_if_cant_apply_an_expired_coupon(): void
    {
        $this->coupon->update(['expiry_date' => now()->subDay()]);

        Livewire::test(ApplyCoupon::class)
            ->set('code', 'DISCOUNT10')
            ->call('apply')
            ->assertHasErrors(['code' => 'This coupon is already expired!']);
    }

    /**
     * Test if can remove a coupon successfully.
     *
     * @return void
     */
    public function test_if_can_remove_coupon_successfully(): void
    {
        Livewire::test(ApplyCoupon::class)
            ->set('code', 'DISCOUNT10')
            ->call('apply');

        Livewire::test(ApplyCoupon::class)
            ->call('remove')
            ->assertDispatched('updatePrices');

        $this->assertNull(session('coupon'));
    }

    /**
     * Test if fails to apply coupon when cart value is less than coupon value.
     *
     * @return void
     */
    public function test_fails_to_apply_coupon_when_cart_value_is_less_than_coupon_value(): void
    {
        $this->item->update(['price' => 100]);

        Livewire::test(ApplyCoupon::class)
            ->set('code', 'DISCOUNT10')
            ->call('apply')
            ->assertHasErrors(['code' => 'The use of this coupon is not allowed for your cart.']);
    }

    /**
     * Test if fails to apply coupon when cart value is less than min value.
     *
     * @return void
     */
    public function test_fails_to_apply_coupon_when_cart_value_is_less_than_min_value(): void
    {
        $this->coupon->update(['min_value' => 1500]);

        Livewire::test(ApplyCoupon::class)
            ->set('code', 'DISCOUNT10')
            ->call('apply')
            ->assertHasErrors(['code' => "This coupon has a min value of $15.00 USD to be applied."]);
    }

    // TODO: add tests to first purchase and single use when create methods.
}
