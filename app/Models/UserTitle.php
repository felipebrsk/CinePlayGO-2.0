<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{Pivot, BelongsTo};

class UserTitle extends Pivot
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'in_use',
        'user_id',
        'title_id',
        'acquired_at',
    ];

    /**
     * The related table.
     *
     * @var string
     */
    public $table = 'user_titles';

    /**
     * The incrementing id.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the user that owns the UserTitle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the title that owns the UserTitle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Title::class);
    }
}
