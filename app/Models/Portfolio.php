<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resume_id',
        'title',
        'slug',
        'template_id',
        'theme_id',
        'config',
        'published_at',
        'github_repo',
        'deployed_url',
    ];

    protected $casts = [
        'config' => 'json',
        'published_at' => 'datetime',
    ];

    /**
     * Get the user that owns the portfolio
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resume associated with this portfolio
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }

    /**
     * Get the portfolio template
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(PortfolioTemplate::class, 'template_id');
    }

    /**
     * Get the portfolio theme
     */
    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Get all exports for this portfolio
     */
    public function exports(): HasMany
    {
        return $this->hasMany(Export::class);
    }
}
