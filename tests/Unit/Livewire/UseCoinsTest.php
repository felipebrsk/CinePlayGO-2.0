<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\UseCoins;
use Tests\Traits\{HasDummyCart, HasDummyUser};
use Illuminate\Foundation\Testing\RefreshDatabase;

class UseCoinsTest extends TestCase
{
    use HasDummyUser;
    use HasDummyCart;
    use RefreshDatabase;

    /**
     * The dummy user.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The user cart.
     *
     * @var \App\Models\Cart
     */
    protected $cart;

    /**
     * Setup new test environments.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->actingAsDummyUser();
        $this->cart = $this->createDummyCartTo($this->user, [
            'use_coins' => false,
        ]);
    }

    /**
     * Test if can toggle the use coins.
     *
     * @return void
     */
    public function test_if_can_toggle_use_coins(): void
    {
        Livewire::test(UseCoins::class, ['cart' => $this->cart, 'user' => $this->user])
            ->set('use', true)
            ->call('submit')
            ->assertDispatched('updatePrices')
            ->assertDispatched('notice', ['message' => 'The coins are now in use.', 'type' => 'success']);

        $this->cart->refresh();

        $this->assertTrue($this->cart->use_coins);

        Livewire::test(UseCoins::class, ['cart' => $this->cart, 'user' => $this->user])
            ->set('use', false)
            ->call('submit')
            ->assertDispatched('updatePrices')
            ->assertDispatched('notice', ['message' => 'The coins are not in use.', 'type' => 'success']);

        $this->cart->refresh();

        $this->assertFalse($this->cart->use_coins);
    }
}
