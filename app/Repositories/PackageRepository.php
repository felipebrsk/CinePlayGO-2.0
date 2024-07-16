<?php

namespace App\Repositories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Collection;

class PackageRepository extends AbstractRepository
{
    /**
     * The package model.
     *
     * @var \App\Models\Package
     */
    protected $model = Package::class;

    /**
     * Get all coin packages.
     *
     * @param array<int, string> $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return $this->model::query()
            ->active()
            ->get($columns);
    }
}
