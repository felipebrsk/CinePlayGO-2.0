<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponType extends Model
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
     * Get the coupon associated with the CouponType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function coupon(): HasOne
    {
        return $this->hasOne(Coupon::class);
    }
}
