<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage};

class ClearCartTest extends DuskTestCase
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
     * Test if can clear the cart.
     *
     * @return void
     */
    public function test_if_can_clear_the_user_cart(): void
    {
        $this->assertNotSoftDeleted($this->user->cart);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('carts.index'))
                ->assertSee('🛒Cart')
                ->assertVisible("@item-{$this->item->id}")
                ->press('Clear Cart')
                ->waitForReload()
                ->assertMissing("@item-{$this->item->id}")
                ->waitForText('Your cart was successfully cleared.')
                ->waitForText('There are no items in your cart!');
        });

        $this->assertSoftDeleted($this->user->cart);
    }
}
