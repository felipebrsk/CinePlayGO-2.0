<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\RemoveFromCart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyCart, HasDummyCartItem, HasDummyPackage, HasDummyUser};

class RemoveFromCartTest extends TestCase
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
     * Test if can remove an item from cart.
     *
     * @return void
     */
    public function test_if_can_remove_an_item_from_cart(): void
    {
        $package2 = $this->createDummyPackage();
        $this->createDummyCartItemTo($this->user->cart, [
            'itemable_id' => $package2->id,
            'itemable_type' => $package2::class,
        ]);

        $this->assertDatabaseCount('cart_items', 2)->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
        ]);

        Livewire::test(RemoveFromCart::class, ['item' => $this->item, 'cart' => $this->user->cart])
            ->call('submit')
            ->assertDispatched('notice')
            ->assertDispatched('cartCount')
            ->assertDispatched('updatePrices')
            ->assertDispatched('removeFromCart')
            ->assertNoRedirect();

        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);
    }

    /**
     * Test if can redirect and clear cart if cart has only one item.
     *
     * @return void
     */
    public function test_if_can_redirect_and_clear_cart_if_cart_has_only_one_item(): void
    {
        $this->item->update([
            'qty' => 1,
        ]);

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);

        Livewire::test(RemoveFromCart::class, ['item' => $this->item, 'cart' => $this->user->cart])
            ->call('submit')
            ->assertDispatched('notice')
            ->assertDispatched('cartCount')
            ->assertDispatched('updatePrices')
            ->assertDispatched('removeFromCart')
            ->assertRedirect(route('carts.index'));

        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $this->user->cart->id,
            'itemable_id' => $this->item->id,
            'qty' => 1,
        ]);
    }
}
