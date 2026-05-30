<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'type',
        'title',
        'order',
        'content',
    ];

    protected $casts = [
        'content' => 'json',
    ];

    /**
     * Get the resume that owns this section
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
