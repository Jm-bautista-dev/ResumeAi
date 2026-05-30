<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'primary_color',
        'secondary_color',
        'accent_color',
        'font_family',
        'layout_style',
        'background_effect',
        'card_style',
        'config',
    ];

    protected $casts = [
        'config' => 'json',
    ];

    /**
     * Get the user that owns the theme
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
