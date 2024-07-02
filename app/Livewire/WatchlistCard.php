<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Watchlist;
use Illuminate\Contracts\View\View;

class WatchlistCard extends Component
{
    /**
     * The media to watchlist.
     *
     * @var \App\Models\Watchlist
     */
    public $watchlist;

    /**
     * The watched bool.
     *
     * @var bool
     */
    public $watched;

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'remove' => '$refresh',
        'changeWatch' => '$refresh',
    ];

    /**
     * Mount the component with media data.
     *
     * @param \App\Models\Watchlist $watchlist
     * @param bool $watched
     * @return void
     */
    public function mount(Watchlist $watchlist, bool $watched): void
    {
        $this->watchlist = $watchlist;
        $this->watched = $watched;
    }

    /**
     * Change watched status.
     *
     * @return void
     */
    public function changeWatch(): void
    {
        $this->watched = !$this->watched;

        $this->watchlist->update([
            'watched' => $this->watched,
        ]);
    }

    /**
     * Remove from watchlist.
     *
     * @return mixed
     */
    public function remove(): mixed
    {
        $this->watchlist->delete();

        return redirect(request()->header('Referer'))->with('success_message', 'The item was successfully removed from watchlist!');
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.watchlist-card');
    }
}
