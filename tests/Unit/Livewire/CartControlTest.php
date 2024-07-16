<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\CartControl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage, HasDummyUser};

class CartControlTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
    use RefreshDatabase;
    use HasDummyPackage;
    use HasDummyCartItem;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    private $user;

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
        $cart = $this->createDummyCartTo($this->user);
        $package = $this->createDummyPackage();
        $this->item = $this->createDummyCartItemTo($cart, [
            'itemable_id' => $package->id,
            'itemable_type' => $package::class,
        ]);
    }

    /**
     * Test if can increase the quantity of an item in cart.
     *
     * @return void
     */
    public function test_if_can_increase_the_quantity_of_an_item_in_cart(): void
    {
        $this->item->update([
            'qty' => 1,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);

        Livewire::test(CartControl::class, ['item' => $this->item])->call('add')->assertDispatched('updatePrices');

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 2,
        ]);
    }

    /**
     * Test if can decrease the quantity of an item in cart.
     *
     * @return void
     */
    public function test_if_can_decrease_the_quantity_of_an_item_in_cart(): void
    {
        $this->item->update([
            'qty' => 2,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 2,
        ]);

        Livewire::test(CartControl::class, ['item' => $this->item])->call('dec')->assertDispatched('updatePrices');

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);
    }

    /**
     * Test if can remove an item from cart if decrease and quantity is only one.
     *
     * @return void
     */
    public function test_if_can_remove_an_item_from_cart_if_decrease_and_quantity_is_ony_one(): void
    {
        $this->item->update([
            'qty' => 1,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);

        Livewire::test(CartControl::class, ['item' => $this->item])->call('dec')
            ->assertDispatched('updatePrices')
            ->assertDispatched('cartCount')
            ->assertDispatched('removeFromCart');

        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
        ]);
    }
}
