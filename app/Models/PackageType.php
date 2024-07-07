<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageType extends Model
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
     * The coin type const.
     *
     * @var int
     */
    public const COIN_TYPE_ID = 1;

    /**
     * Get all of the packages for the PackageType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}
