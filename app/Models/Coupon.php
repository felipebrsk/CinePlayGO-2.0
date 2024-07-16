<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'type',
        'value',
        'active',
        'min_value',
        'single_use',
        'expiry_date',
        'first_purchase',
    ];

    /**
     * The fixed coupon type id.
     *
     * @var int
     */
    public const FIXED_TYPE_ID = 1;

    /**
     * The percent coupon type id.
     *
     * @var int
     */
    public const PERCENT_TYPE_ID = 2;

    /**
     *  Get the coupon by code.
     *
     *  @param string $code
     *  @return ?self
     */
    public static function findByCode(string $code): ?self
    {
        return self::where('code', $code)->first();
    }

    /**
     *  Apply discount over totals.
     *
     *  @param float $total
     *  @return float
     */
    public function discount(float $total): float
    {
        if ($this->coupon_type_id === self::FIXED_TYPE_ID) {
            return $this->value;
        } elseif ($this->coupon_type_id === self::PERCENT_TYPE_ID) {
            return ($this->value / 100) * $total;
        }

        return 0;
    }

    /**
     * Get the couponType that owns the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function couponType(): BelongsTo
    {
        return $this->belongsTo(CouponType::class);
    }
}
