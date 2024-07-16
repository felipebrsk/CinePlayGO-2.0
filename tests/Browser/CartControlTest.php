<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage};

class CartControlTest extends DuskTestCase
{
    use HasDummyCart;
    use HasDummyPackage;
    use HasDummyCartItem;

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

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->click('@increase')
                ->pause(1000);
        });

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

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->click('@decrease')
                ->pause(1000);
        });

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

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->assertVisible("@item-{$this->item->id}")
                ->click('@decrease')
                ->pause(1000)
                ->assertMissing("@item-{$this->item->id}");
        });

        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
        ]);
    }
}
