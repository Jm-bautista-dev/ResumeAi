<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resume_id',
        'type',
        'input',
        'output',
        'tokens_used',
        'cost',
        'status',
    ];

    protected $casts = [
        'input' => 'json',
        'output' => 'json',
        'cost' => 'decimal:4',
    ];

    /**
     * Get the user that made the request
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resume associated with the request
     */
    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
