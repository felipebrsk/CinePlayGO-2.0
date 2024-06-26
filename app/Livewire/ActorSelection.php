<?php

namespace App\Livewire;

use App\Services\ActorService;

class ActorSelection extends BaseSelection
{
    /**
     * The filtered actors.
     *
     * @var \Illuminate\Support\Collection
     */
    public $actors = [];

    /**
     * Mount the component.
     *
     * @param \App\Services\GenreService $actorService
     * @return void
     */
    public function mount(ActorService $actorService): void
    {
        $this->actorService = $actorService;
        $this->fetchActors();
    }

    /**
     * Fetch the actors with filters.
     *
     * @return void
     */
    public function fetchActors(): void
    {
        $this->actors = $this->getActorService()->filteredActors([
            'page' => $this->page,
        ]);
    }

    /**
     * Load more movies according scroll.
     *
     * @return void
     */
    public function loadMore(): void
    {
        $this->page++;

        $newActors = $this->getActorService()->filteredActors([
            'page' => $this->page,
        ]);

        $this->actors = $this->actors->merge($newActors);
    }

    public function render()
    {
        return view('livewire.actor-selection');
    }
}
