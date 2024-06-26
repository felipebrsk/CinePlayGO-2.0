<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use App\Services\{GenreService, TvShowService};

class TvShowSelection extends BaseSelection
{
    /**
     * The filtered tv shows.
     *
     * @var \Illuminate\Support\Collection
     */
    public $tvShows = [];

    /**
     * The available ranks.
     *
     * @var array<string, string>
     */
    public $ranks = [
        'popular' => 'Popular',
        'top_rated' => 'Top Rated',
        'on_the_air' => 'On The Air',
        'airing_today' => 'Airling Today',
    ];

    /**
     * Mount the component.
     *
     * @param \App\Services\TvShowService $tvShowService
     * @param \App\Services\GenreService $genreService
     * @return void
     */
    public function mount(TvShowService $tvShowService, GenreService $genreService): void
    {
        $this->genreService = $genreService;
        $this->tvShowService = $tvShowService;
        $this->fetchGenres();
        $this->fetchTvShows();
    }

    /**
     * Fetch the all movie genres.
     *
     * @return void
     */
    public function fetchGenres(): void
    {
        $this->genres = $this->getGenreService()->tvShowGenres();
    }

    /**
     * Fetch the tv shows with filters.
     *
     * @return void
     */
    public function fetchTvShows(): void
    {
        $this->tvShows = $this->getTvShowService()->filteredTvShows([
            'rank' => $this->selectedRank,
            'page' => $this->page,
        ]);

        if ($this->selectedGenre) {
            $this->tvShows = $this->tvShows->filter(function (Collection $tvShow) {
                return in_array($this->selectedGenre, $tvShow['genre_ids']);
            });
        }
    }

    /**
     * Load more movies according scroll.
     *
     * @return void
     */
    public function loadMore(): void
    {
        $this->page++;

        $newTvShows = $this->getTvShowService()->filteredTvShows([
            'rank' => $this->selectedRank,
            'page' => $this->page,
        ]);

        $allTvShows = $this->tvShows->merge($newTvShows);

        if ($this->selectedGenre) {
            $allTvShows = $allTvShows->filter(function (Collection $movie) {
                return in_array($this->selectedGenre, $movie['genre_ids']);
            });
        }

        $this->tvShows = $allTvShows;
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.tv-show-selection');
    }
}
