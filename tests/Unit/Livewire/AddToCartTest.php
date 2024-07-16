<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\AddToCart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyCart, HasDummyPackage, HasDummyUser};

class AddToCartTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
    use RefreshDatabase;
    use HasDummyPackage;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->actingAsDummyUser();
    }

    /**
     * Test if can add an item to cart.
     *
     * @return void
     */
    public function test_if_can_add_an_item_to_cart(): void
    {
        $this->createDummyCartTo($this->user);

        Livewire::test(AddToCart::class, ['item' => $this->createDummyPackage()])
            ->call('submit')
            ->assertHasNoErrors(['item'])
            ->assertDispatched('notice', ['message' => 'Item added to cart!', 'type' => 'success'])
            ->assertDispatched('cartCount', ['count' => cartService()->count()]);
    }

    /**
     * Test if can save the item on database.
     *
     * @return void
     */
    public function test_if_can_save_the_item_on_database(): void
    {
        $cart = $this->createDummyCartTo($this->user);

        Livewire::test(AddToCart::class, ['item' => $item = $this->createDummyPackage()])->call('submit');

        $this->assertDatabaseHas('cart_items', [
            'qty' => 1,
            'price' => $item->price,
            'itemable_id' => $item->id,
            'itemable_type' => $item::class,
            'cart_id' => $cart->id,
        ]);
    }

    /**
     * Test if can add the quantity on database if add the same item.
     *
     * @return void
     */
    public function test_if_can_add_the_quantity_on_database_if_add_the_same_item(): void
    {
        $cart = $this->createDummyCartTo($this->user);

        Livewire::test(AddToCart::class, ['item' => $item = $this->createDummyPackage()])->call('submit');

        $this->assertDatabaseHas('cart_items', [
            'qty' => 1,
            'price' => $item->price,
            'itemable_id' => $item->id,
            'itemable_type' => $item::class,
            'cart_id' => $cart->id,
        ]);

        Livewire::test(AddToCart::class, ['item' => $item])->call('submit');

        $this->assertDatabaseHas('cart_items', [
            'qty' => 2,
            'price' => $item->price,
            'itemable_id' => $item->id,
            'itemable_type' => $item::class,
            'cart_id' => $cart->id,
        ]);
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

        Livewire::test(AddToCart::class, ['item' => $item = $this->createDummyPackage()])->call('submit');

        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
        ]);
    }
}
