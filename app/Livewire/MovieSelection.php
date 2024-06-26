<?php

namespace App\Livewire;

use App\Services\GenreService;
use App\Services\MovieService;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class MovieSelection extends Component
{
    /**
     * The movie service.
     *
     * @var \App\Services\MovieService
     */
    protected $movieService;

    /**
     * The genre service.
     *
     * @var \App\Services\GenreService
     */
    protected $genreService;

    /**
     * The all available genres.
     *
     * @var array
     */
    public $genres = [];

    /**
     * The filter selected genre.
     *
     * @var string|null
     */
    public $selectedGenre = null;

    /**
     * The filter selected rank.
     *
     * @var string
     */
    public $selectedRank = 'popular';

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
     * The page number.
     *
     * @var int
     */
    public $page = 1;

    /**
     * Get the instance of movie service.
     *
     * @return \App\Services\MovieService
     */
    protected function getMovieService(): MovieService
    {
        if (!$this->movieService) {
            $this->movieService = app(MovieService::class);
        }

        return $this->movieService;
    }

    /**
     * Get the instance of genre service.
     *
     * @return \App\Services\GenreService
     */
    protected function getGenreService(): GenreService
    {
        if (!$this->genreService) {
            $this->genreService = app(GenreService::class);
        }

        return $this->genreService;
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount(MovieService $movieService, GenreService $genreService): void
    {
        $this->genreService = $genreService;
        $this->movieService = $movieService;
        $this->fetchGenres();
        $this->fetchMovies();
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
    public function fetchMovies(): void
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
     * Update the selected genre.
     *
     * @param ?string $genre
     * @return void
     */
    public function updatedSelectedGenre(?string $genre): void
    {
        $this->selectedGenre = $genre;

        $this->fetchMovies();
    }

    /**
     * Update the selected rank.
     *
     * @param string $rank
     * @return void
     */
    public function updatedSelectedRank(string $rank): void
    {
        $this->selectedRank = $rank;

        $this->fetchMovies();
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
