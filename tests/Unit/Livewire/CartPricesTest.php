<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\CartPrices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage, HasDummyUser};

class CartPricesTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
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

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->actingAsDummyUser();

        $this->user->wallet()->update([
            'amount' => 1000,
        ]);

        $this->cart = $this->createDummyCartTo($this->user, [
            'use_coins' => false,
        ]);

        $package = $this->createDummyPackage();

        $this->createDummyCartItemTo($this->cart, [
            'qty' => 1,
            'price' => 1000,
            'itemable_id' => $package->id,
            'itemable_type' => $package::class,
        ]);
    }

    /**
     * Test initial prices without coupon or coins.
     *
     * @return void
     */
    public function test_initial_prices_without_coupon_or_coins(): void
    {
        Livewire::test(CartPrices::class, ['cart' => $this->cart, 'user' => $this->user])
            ->assertSet('subtotal', 1000)
            ->assertSet('discount', 0)
            ->assertSet('total', 1000);
    }

    /**
     * Test if can set correct prices when coupon is applied.
     *
     * @return void
     */
    public function test_if_can_set_correct_prices_when_coupon_is_applied(): void
    {
        session(['coupon' => ['value' => 200]]);

        Livewire::test(CartPrices::class, ['cart' => $this->cart, 'user' => $this->user])
            ->call('updatePrices')
            ->assertSet('subtotal', 1000)
            ->assertSet('discount', 200)
            ->assertSet('total', 800);
    }

    public function test_prices_with_coins()
    {
        $this->cart->update(['use_coins' => true]);

        Livewire::test(CartPrices::class, ['cart' => $this->cart, 'user' => $this->user])
            ->call('updatePrices')
            ->assertSet('subtotal', 1000)
            ->assertSet('discount', 500) // Package multiplier (coin) is 0.005, 1000 * 0.005
            ->assertSet('total', 500);
    }

    /**
     * Test the prices with coupon and coins.
     *
     * @return void
     */
    public function test_prices_with_coupon_and_coins(): void
    {
        session(['coupon' => ['value' => 200]]);

        $this->cart->update(['use_coins' => true]);

        Livewire::test(CartPrices::class, ['cart' => $this->cart, 'user' => $this->user])
            ->call('updatePrices')
            ->assertSet('subtotal', 1000)
            ->assertSet('discount', 700)
            ->assertSet('total', 300);
    }

    /**
     * Test if the prices can be set to 0 if the coins total is higher than cart totals.
     *
     * @return void
     */
    public function test_if_the_prices_can_be_set_to_0_if_the_coins_total_is_higher_than_cart_totals(): void
    {
        session(['coupon' => ['value' => 200]]);

        $this->user->wallet()->update([
            'amount' => 10000,
        ]);

        $this->cart->update(['use_coins' => true]);

        Livewire::test(CartPrices::class, ['cart' => $this->cart, 'user' => $this->user])
            ->call('updatePrices')
            ->assertSet('subtotal', 1000)
            ->assertSet('discount', 1000)
            ->assertSet('total', 0);
    }
}
