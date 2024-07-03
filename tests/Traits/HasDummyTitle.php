<?php

namespace Tests\Traits;

use App\Models\Title;
use Illuminate\Database\Eloquent\Collection;

trait HasDummyTitle
{
    /**
     * Create a new dummy title.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\Title
     */
    public function createDummyTitle(array $data = []): Title
    {
        return Title::factory()->create($data);
    }

    /**
     * Create new dummy titles.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyTitles(int $times, array $data = []): Collection
    {
        return Title::factory($times)->create($data);
    }
}
