<?php

namespace Tests\Traits;

use App\Models\Package;
use Illuminate\Database\Eloquent\Collection;

trait HasDummyPackage
{
    /**
     * Create a new dummy package.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\Package
     */
    public function createDummyPackage(array $data = []): Package
    {
        return Package::factory()->create($data);
    }

    /**
     * Create new dummy packages.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyPackages(int $times, array $data = []): Collection
    {
        return Package::factory($times)->create($data);
    }
}
