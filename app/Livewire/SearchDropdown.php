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

            $searchResults = collect($searchResults)->map(function (array $item) {
                switch ($item['media_type']) {
                    case 'tv':
                        $name = $item['name'];
                        $image = "https://image.tmdb.org/t/p/w92/{$item['poster_path']}";
                        $url = route('tv-shows.show', $item['id']);

                        break;
                    case 'movie':
                        $name = $item['title'];
                        $image = "https://image.tmdb.org/t/p/w92/{$item['poster_path']}";
                        $url = route('movies.show', $item['id']);

                        break;
                    case 'person':
                        $name = $item['name'];
                        $image = "https://image.tmdb.org/t/p/w92/{$item['profile_path']}";
                        $url = route('actors.show', $item['id']);

                        break;
                    default:
                        $image = 'https://via.placeholder.com/50x75';
                        $name = 'Unknown';
                        $url = '#';

                        break;
                }

                return [
                    'name' => $name,
                    'image' => $image,
                    'url' => $url,
                ];
            })->take(7);
        }

        return view('livewire.search-dropdown', [
            'searchResults' => $searchResults,
        ]);
    }
}
