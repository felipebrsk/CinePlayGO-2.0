<?php

namespace App\Services;

use App\Repositories\PackageRepository;
use Illuminate\Database\Eloquent\Collection;

class PackageService extends AbstractService
{
    /**
     * The package repository.
     *
     * @var \App\Repositories\PackageRepository
     */
    protected $repository = PackageRepository::class;

    /**
     * Get all coin packages.
     *
     * @param array<int, string> $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function coins(array $columns = ['*']): Collection
    {
        return $this->repository->coins($columns);
    }
}
