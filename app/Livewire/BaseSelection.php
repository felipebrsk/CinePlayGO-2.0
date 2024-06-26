<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\{ActorService, GenreService, TvShowService, MovieService};

class BaseSelection extends Component
{
    /**
     * The movie service.
     *
     * @var \App\Services\MovieService
     */
    protected $movieService;

    /**
     * The actor service.
     *
     * @var \App\Services\ActorService
     */
    protected $actorService;

    /**
     * The tv show service.
     *
     * @var \App\Services\TvShowService
     */
    protected $tvShowService;

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
     * The load type option.
     *
     * @var string
     */
    public $loadType = 'scroll';

    /**
     * The load types array.
     *
     * @var array<string, string>
     */
    public $loadTypes = [
        'scroll' => 'Load on scroll',
        'click' => 'Load with button',
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
     * @return \App\Services\TvShowService
     */
    protected function getTvShowService(): TvShowService
    {
        if (!$this->tvShowService) {
            $this->tvShowService = app(TvShowService::class);
        }

        return $this->tvShowService;
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
     * Get the instance of actor service.
     *
     * @return \App\Services\ActorService
     */
    protected function getActorService(): ActorService
    {
        if (!$this->actorService) {
            $this->actorService = app(ActorService::class);
        }

        return $this->actorService;
    }

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
     * Update the selected genre.
     *
     * @param ?string $genre
     * @return void
     */
    public function updatedSelectedGenre(?string $genre): void
    {
        $this->selectedGenre = $genre;

        $this->fetch();
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

        $this->fetch();
    }

    /**
     * Update the load type option.
     *
     * @param string $load
     * @return void
     */
    public function updatedLoadType(string $load): void
    {
        $this->loadType = $load;
    }
}
