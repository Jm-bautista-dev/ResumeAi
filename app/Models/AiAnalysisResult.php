<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAnalysisResult extends Model
{
    protected $fillable = [
        'resume_id',
        'user_id',
        'score',
        'ats_score',
        'grammar_score',
        'content_score',
        'keyword_score',
        'suggestions',
        'strengths',
        'weaknesses',
        'recommended_template',
        'suggested_roles',
        'missing_skills',
    ];

    protected $casts = [
        'suggestions' => 'array',
        'strengths' => 'array',
        'weaknesses' => 'array',
        'suggested_roles' => 'array',
        'missing_skills' => 'array',
        'score' => 'integer',
        'ats_score' => 'integer',
        'grammar_score' => 'integer',
        'content_score' => 'integer',
        'keyword_score' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
