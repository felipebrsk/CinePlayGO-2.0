<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTitle extends Model
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
