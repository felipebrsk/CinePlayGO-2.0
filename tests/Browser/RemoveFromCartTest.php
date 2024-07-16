<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage};

class RemoveFromCartTest extends DuskTestCase
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
     * Test if can remove an item from cart.
     *
     * @return void
     */
    public function test_if_can_remove_an_item_from_cart_on_remove_from_cart(): void
    {
        $item = $this->createDummyPackage();

        $this->createDummyCartItemTo($this->user->cart, [
            'itemable_id' => $item->id,
            'itemable_type' => $item::class,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->assertVisible("@item-{$this->item->id}")
                ->click('@removeCart')
                ->pause(1000)
                ->assertMissing("@item-{$this->item->id}")
                ->waitForText('Item removed from cart!');
        });
    }

    /**
     * Test if can redirect and clear cart if cart has only one item.
     *
     * @return void
     */
    public function test_if_can_redirect_and_clear_cart_if_cart_has_only_one_item(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->assertVisible("@item-{$this->item->id}")
                ->click('@removeCart')
                ->pause(1000)
                ->assertMissing("@item-{$this->item->id}")
                ->waitForText('There are no items in your cart!');
        });
    }
}
