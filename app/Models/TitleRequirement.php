<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo};

class TitleRequirement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task',
        'goal',
        'title_id',
    ];

    /**
     * Get the title that owns the TitleRequirement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title(): BelongsTo
    {
        return $this->belongsTo(Title::class);
    }

    /**
     * Get all of the requirementProgresses for the TitleRequirement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requirementProgresses(): HasMany
    {
        return $this->hasMany(UserTitleProgress::class);
    }
}
