<?php

namespace App\Livewire;

use Livewire\Component;
use App\Client\TmdbClient;
use Illuminate\Contracts\View\View;

class SearchDropdown extends Component
{
    /**
     * The search statement.
     *
     * @var string
     */
    public $search = '';

    /**
     * The rules for component.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'title' => 'required|min:2',
    ];

    /**
     * The is open search.
     *
     * @var boolean
     */
    public $isOpen = true;

    /**
     * Update the search is open.
     *
     * @return void
     */
    public function updatedSearch(): void
    {
        $this->isOpen = true;
    }

    /**
     * Render the livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        $searchResults = [];
        $tmdbClient = new TmdbClient();

        if (strlen($this->search) >= 2) {
            $searchResults = $tmdbClient->get('search/multi', [
                'query' => $this->search,
            ])['results'];
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
