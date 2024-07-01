<?php

namespace App\Livewire;

use App\Models\MediaType;
use App\Models\Watchlist;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AddToWatchlist extends Component
{
    /**
     * The media to watchlist.
     *
     * @var array
     */
    public $media;

    /**
     * The media type.
     *
     * @var int
     */
    public $type;

    /**
     * Is already on watchlist.
     *
     * @var bool
     */
    public $already;

    /**
     * Mount the component with media data.
     *
     * @param array<string, mixed> $media
     * @param int $type
     * @return void
     */
    public function mount(array $media, int $type): void
    {
        $this->media = $media;
        $this->type = $type;

        $this->already = Watchlist::query()
            ->where('user_id', Auth::id())
            ->where('tmdb_id', $this->media['id'])
            ->exists();
    }

    /**
     * Add to watchlist.
     *
     * @return void
     */
    public function addToWatchlist(): void
    {
        $payload = [
            'user_id' => Auth::id(),
            'media_type_id' => $this->type,
            'tmdb_id' => $this->media['id'],
            'rate' => number_format($this->media['vote_average'], 1),
            'image' => "https://image.tmdb.org/t/p/original/{$this->media['poster_path']}",
        ];

        if (!$this->already) {
            if ($this->type === MediaType::MOVIE_TYPE_ID) {
                $payload += [
                    'name' => $this->media['title'],
                    'link' => route('movies.show', $this->media['id']),
                ];
            } else {
                $payload += [
                    'name' => $this->media['name'],
                    'link' => route('tv-shows.show', $this->media['id']),
                ];
            }

            Watchlist::create($payload);

            $this->already = true;
        }
    }

    /**
     * Renders the view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.add-to-watchlist');
    }
}
