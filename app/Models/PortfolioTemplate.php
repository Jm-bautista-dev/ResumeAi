<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'preview_image',
        'config',
        'is_active',
    ];

    protected $casts = [
        'config' => 'json',
        'is_active' => 'boolean',
    ];
}
