<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeImport extends Model
{
    protected $fillable = [
        'user_id',
        'original_filename',
        'file_path',
        'raw_text',
        'parsed_data',
        'status',
        'error_message',
        'resume_id',
    ];

    protected $casts = [
        'parsed_data' => 'array',
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
