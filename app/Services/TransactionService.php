<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionService extends AbstractService
{
    /**
     * The transaction repository.
     *
     * @var \App\Repositories\TransactionRepository
     */
    protected $repository = TransactionRepository::class;

    /**
     * All transactions for user.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function allForUser(): LengthAwarePaginator
    {
        return $this->repository->allForUser();
    }
}
