<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Watchlist;
use App\Livewire\WatchlistCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\{HasDummyUser, HasDummyWatchlist};

class WatchlistCardTest extends TestCase
{
    use HasDummyUser;
    use RefreshDatabase;
    use HasDummyWatchlist;

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

        $this->seed();
        $this->user = $this->actingAsDummyUser();
    }

    /**
     * Test if can toggle the watched status for watchlist.
     *
     * @return void
     */
    public function test_if_can_toggle_the_watched_status_for_watchlist(): void
    {
        $watchlist = $this->createDummyWatchlistTo($this->user, ['watched' => false]);

        $this->assertDatabaseHas('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
            'watched' => false,
        ]);

        Livewire::test(WatchlistCard::class, ['watchlist' => $watchlist, 'watched' => $watchlist->watched])
            ->call('changeWatch')
            ->assertSet('watched', true);

        $this->assertDatabaseHas('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
            'watched' => true,
        ]);
    }

    /**
     * Test if can remove the item from watchlist.
     *
     * @return void
     */
    public function test_if_can_remove_the_item_from_watchlist(): void
    {
        $watchlist = $this->createDummyWatchlistTo($this->user);

        $this->assertDatabaseHas('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
        ]);

        Livewire::test(WatchlistCard::class, ['watchlist' => $watchlist, 'watched' => $watchlist->watched])
            ->call('remove')
            ->assertRedirect(route('watchlists.index'))
            ->assertSessionHas('success_message', 'The item was successfully removed from watchlist!');

        $this->assertDatabaseMissing('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
        ]);
    }
}
