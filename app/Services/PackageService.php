<?php

namespace App\Services;

use App\Repositories\PackageRepository;

class PackageService extends AbstractService
{
    /**
     * The package repository.
     *
     * @var \App\Repositories\PackageRepository
     */
    protected $repository = PackageRepository::class;
}
