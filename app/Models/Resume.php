<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'template_id',
        'template_slug',
        'content',
        'is_default',
        'published_at',
        'ai_score',
        'version',
        'job_role',
        'industry',
    ];

    protected $casts = [
        'content' => 'json',
        'published_at' => 'datetime',
    ];

    /**
     * Get the resume content, automatically decoding and merging defaults.
     */
    public function getContentAttribute($value)
    {
        $decoded = is_string($value) ? json_decode($value, true) : $value;
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        if (!is_array($decoded)) {
            $decoded = [];
        }

        return array_merge([
            'personalInfo' => [
                'fullName' => '',
                'email' => '',
                'phone' => '',
                'location' => '',
                'website' => '',
            ],
            'summary' => '',
            'skills' => [],
            'experience' => [],
            'education' => [],
            'projects' => [],
            'certifications' => [],
            'socialLinks' => [],
            'awards' => [],
            'languages' => [],
        ], $decoded);
    }

    /**
     * Get the user that owns the resume
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resume sections
     */
    public function sections(): HasMany
    {
        return $this->hasMany(ResumeSection::class);
    }

    /**
     * Get the portfolio associated with this resume
     */
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Get all AI requests for this resume
     */
    public function aiRequests(): HasMany
    {
        return $this->hasMany(AiRequest::class);
    }

    /**
     * Get all exports for this resume
     */
    public function exports(): HasMany
    {
        return $this->hasMany(Export::class);
    }

    /**
     * Get structured resume data
     */
    public function getStructuredData(): array
    {
        return [
            'personalInfo' => $this->content['personalInfo'] ?? [],
            'summary' => $this->content['summary'] ?? '',
            'skills' => $this->content['skills'] ?? [],
            'experience' => $this->content['experience'] ?? [],
            'education' => $this->content['education'] ?? [],
            'projects' => $this->content['projects'] ?? [],
            'certifications' => $this->content['certifications'] ?? [],
            'socialLinks' => $this->content['socialLinks'] ?? [],
            'awards' => $this->content['awards'] ?? [],
            'languages' => $this->content['languages'] ?? [],
        ];
    }
}
