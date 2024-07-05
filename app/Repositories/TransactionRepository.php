<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepository extends AbstractRepository
{
    /**
     * The transaction model.
     *
     * @var \App\Models\Transaction
     */
    protected $model = Transaction::class;

    /**
     * All transactions for user.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function allForUser(): LengthAwarePaginator
    {
        return $this->model::byUser()->paginate(self::PER_PAGE);
    }
}
