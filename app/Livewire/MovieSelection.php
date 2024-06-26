<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use App\Services\{GenreService, MovieService};

class MovieSelection extends BaseSelection
{
    /**
     * The filtered movies.
     *
     * @var \Illuminate\Support\Collection
     */
    public $movies = [];

    /**
     * The available ranks.
     *
     * @var array<string, string>
     */
    public $ranks = [
        'popular' => 'Popular',
        'upcoming' => 'Upcoming',
        'top_rated' => 'Top Rated',
        'now_playing' => 'Now Playing',
    ];

    /**
     * Mount the component.
     *
     * @param \App\Services\MovieService $movieService
     * @param \App\Services\GenreService $genreService
     * @return void
     */
    public function mount(MovieService $movieService, GenreService $genreService): void
    {
        $this->genreService = $genreService;
        $this->movieService = $movieService;
        $this->fetchGenres();
        $this->fetch();
    }

    /**
     * Fetch the all movie genres.
     *
     * @return void
     */
    public function fetchGenres(): void
    {
        $this->genres = $this->getGenreService()->movieGenres();
    }

    /**
     * Fetch the movies with filters.
     *
     * @return void
     */
    public function fetch(): void
    {
        $this->movies = $this->getMovieService()->filteredMovies([
            'rank' => $this->selectedRank,
            'page' => $this->page,
        ]);

        if ($this->selectedGenre) {
            $this->movies = $this->movies->filter(function (Collection $movie) {
                return in_array($this->selectedGenre, $movie['genre_ids']);
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

        $newMovies = $this->getMovieService()->filteredMovies([
            'rank' => $this->selectedRank,
            'page' => $this->page,
        ]);

        $allMovies = $this->movies->merge($newMovies);

        if ($this->selectedGenre) {
            $allMovies = $allMovies->filter(function (Collection $movie) {
                return in_array($this->selectedGenre, $movie['genre_ids']);
            });
        }

        $this->movies = $allMovies;
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.movie-selection');
    }
}
