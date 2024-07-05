<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionType extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
    ];

    /**
     * The subtract transaction type.
     *
     * @var int
     */
    public const SUBTRACT_TYPE_ID = 1;

    /**
     * The addition transaction type.
     *
     * @var int
     */
    public const ADDITION_TYPE_ID = 2;

    /**
     * Get all of the transactions for the TransactionType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
