<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'qty',
        'price',
        'cart_id',
        'itemable_id',
        'itemable_type',
    ];

    /**
     * Morph to item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function itemable(): MorphTo
    {
        return $this->morphTo('itemable');
    }
}
