<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Traits\HasDummyWatchlist;

class WatchlistCardTest extends DuskTestCase
{
    use HasDummyWatchlist;

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

        $this->browse(function (Browser $browser) use ($watchlist) {
            $browser->loginAs($this->user)
                ->visit(route('watchlists.index'))
                ->waitForText($watchlist->name)
                ->assertSee('Not watched')
                ->press('Mark as watched')
                ->waitForText('Watched')
                ->assertSee('Watched');
        });

        $this->assertDatabaseHas('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
            'watched' => true,
        ]);
    }

    /**
     * Test if it can removes item from watchlist.
     *
     * @return void
     */
    public function test_if_it_can_removes_item_from_watchlist(): void
    {
        $watchlist = $this->createDummyWatchlistTo($this->user);

        $this->assertDatabaseHas('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
        ]);

        $this->browse(function (Browser $browser) use ($watchlist) {
            $browser->loginAs($this->user)
                ->visit(route('watchlists.index'))
                ->waitForText($watchlist->name)
                ->press('Remove')
                ->waitForReload()
                ->assertDontSee($watchlist->name)
                ->assertSee('The item was successfully removed from watchlist!');
        });

        $this->assertDatabaseMissing('watchlists', [
            'id' => $watchlist->id,
            'user_id' => $this->user->id,
        ]);
    }
}
