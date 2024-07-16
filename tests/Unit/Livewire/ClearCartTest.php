<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\ClearCart;
use Tests\Traits\{HasDummyCart, HasDummyUser};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClearCartTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
    use RefreshDatabase;

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
        $this->createDummyCartTo($this->user);
    }

    /**
     * Test if can clear the cart.
     *
     * @return void
     */
    public function test_if_can_clear_the_user_cart(): void
    {
        $this->assertNotSoftDeleted($this->user->cart);

        Livewire::test(ClearCart::class)
            ->call('submit')
            ->assertDispatched('cartCount')
            ->assertRedirect(route('carts.index'));

        $this->assertSoftDeleted($this->user->cart);
    }
}
