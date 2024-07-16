<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Traits\HasDummyPackage;

class AddToCartTest extends DuskTestCase
{
    use HasDummyPackage;

    /**
     * The dummy packages.
     *
     * @var \App\Models\Package
     */
    private $package;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->package = $this->createDummyPackage();
        $this->user->wallet->update([
            'amount' => fake()->numberBetween(10000, 99999),
        ]);
    }

    /**
     * Test if can add an item to cart.
     *
     * @return void
     */
    public function test_if_can_add_an_item_to_cart(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.coins'))
                ->assertSee('Your Coins')
                ->assertSee($this->user->wallet->amount)
                ->press('Add to cart')
                ->waitForText('Item added to cart!');
        });
    }

    /**
     * Test if can save the item on database.
     *
     * @return void
     */
    public function test_if_can_save_the_item_on_database(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.coins'))
                ->press('Add to cart')
                ->waitForText('Item added to cart!');
        });

        $this->assertDatabaseHas('cart_items', [
            'qty' => 1,
            'price' => $this->package->price,
            'itemable_id' => $this->package->id,
            'itemable_type' => $this->package::class,
            'cart_id' => $this->user->cart->id,
        ]);
    }

    /**
     * Test if can add the quantity on database if add the same item.
     *
     * @return void
     */
    public function test_if_can_add_the_quantity_on_database_if_add_the_same_item(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.coins'))
                ->press('Add to cart')
                ->waitForText('Item added to cart!');

            $this->assertDatabaseHas('cart_items', [
                'qty' => 1,
                'price' => $this->package->price,
                'itemable_id' => $this->package->id,
                'itemable_type' => $this->package::class,
                'cart_id' => $this->user->cart->id,
            ]);

            $browser->loginAs($this->user)
                ->visit(route('profiles.coins'))
                ->press('Add to cart')
                ->waitForText('Item added to cart!');

            $this->assertDatabaseHas('cart_items', [
                'qty' => 2,
                'price' => $this->package->price,
                'itemable_id' => $this->package->id,
                'itemable_type' => $this->package::class,
                'cart_id' => $this->user->cart->id,
            ]);
        });
    }

    /**
     * Test if can create the cart if doesn't exist.
     *
     * @return void
     */
    public function test_if_can_create_the_cart_if_doesnt_exist(): void
    {
        $this->assertDatabaseMissing('carts', [
            'user_id' => $this->user->id,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('profiles.coins'))
                ->press('Add to cart')
                ->waitForText('Item added to cart!');
        });

        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
        ]);
    }
}
