<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResumeTemplate extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'description',
        'thumbnail_color', 'is_ats_friendly', 'is_active', 'sort_order', 'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_ats_friendly' => 'boolean',
        'is_active' => 'boolean',
    ];

    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order')->get();
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'modern'     => 'Modern',
            'minimal'    => 'Minimal',
            'creative'   => 'Creative',
            'technical'  => 'Technical',
            'executive'  => 'Executive',
            'gradient'   => 'Bold',
            default      => ucfirst($this->category),
        };
    }
}
