<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTitleProgress extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'progress',
        'completed',
        'title_requirement_id',
    ];

    /**
     * Get the user that owns the UserTitleProgress
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the titleRequirement that owns the UserTitleProgress
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function titleRequirement(): BelongsTo
    {
        return $this->belongsTo(TitleRequirement::class);
    }
}
