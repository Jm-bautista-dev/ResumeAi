<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResumeTemplate;

class ResumeTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Modern Professional',
                'slug' => 'modern-professional',
                'category' => 'modern',
                'description' => 'Two-column layout, sleek blue accents, optimized for professional ATS systems.',
                'thumbnail_color' => '#2563EB',
                'is_ats_friendly' => true,
                'is_active' => true,
                'sort_order' => 1,
                'meta' => json_encode([
                    'fonts' => ['sans' => 'Inter'],
                    'primary_color' => '#2563EB',
                    'secondary_color' => '#1E293B',
                ]),
            ],
            [
                'name' => 'Minimal Clean',
                'slug' => 'minimal-clean',
                'category' => 'minimal',
                'description' => 'Google & Apple style layout with pure white background and perfectly proportioned typography.',
                'thumbnail_color' => '#18181B',
                'is_ats_friendly' => true,
                'is_active' => true,
                'sort_order' => 2,
                'meta' => json_encode([
                    'fonts' => ['sans' => 'Inter'],
                    'primary_color' => '#18181B',
                    'secondary_color' => '#71717A',
                ]),
            ],
            [
                'name' => 'Creative Bold',
                'slug' => 'creative-bold',
                'category' => 'creative',
                'description' => 'Eye-catching left sidebar with a strong brand color. Perfect for marketers, designers, and creatives.',
                'thumbnail_color' => '#E11D48',
                'is_ats_friendly' => false,
                'is_active' => true,
                'sort_order' => 3,
                'meta' => json_encode([
                    'fonts' => ['sans' => 'Outfit'],
                    'primary_color' => '#E11D48',
                    'secondary_color' => '#0F172A',
                ]),
            ],
            [
                'name' => 'Technical Dev',
                'slug' => 'technical-dev',
                'category' => 'technical',
                'description' => 'Code-inspired technical layout using monospace fonts. Best for engineers, developers, and tech professionals.',
                'thumbnail_color' => '#059669',
                'is_ats_friendly' => true,
                'is_active' => true,
                'sort_order' => 4,
                'meta' => json_encode([
                    'fonts' => ['mono' => 'Fira Code', 'sans' => 'JetBrains Mono'],
                    'primary_color' => '#059669',
                    'secondary_color' => '#0F172A',
                ]),
            ],
            [
                'name' => 'Corporate Executive',
                'slug' => 'corporate-executive',
                'category' => 'executive',
                'description' => 'Traditional serif layout with high elegance. Tailored for executive, legal, and financial roles.',
                'thumbnail_color' => '#0F172A',
                'is_ats_friendly' => true,
                'is_active' => true,
                'sort_order' => 5,
                'meta' => json_encode([
                    'fonts' => ['serif' => 'Playfair Display'],
                    'primary_color' => '#0F172A',
                    'secondary_color' => '#475569',
                ]),
            ],
            [
                'name' => 'Gradient Modern',
                'slug' => 'gradient-modern',
                'category' => 'gradient',
                'description' => 'Vibrant gradient header making a stunning first impression. Ideal for modern digital creators.',
                'thumbnail_color' => '#7C3AED',
                'is_ats_friendly' => false,
                'is_active' => true,
                'sort_order' => 6,
                'meta' => json_encode([
                    'fonts' => ['sans' => 'Outfit'],
                    'primary_color' => '#7C3AED',
                    'secondary_color' => '#F43F5E',
                ]),
            ],
        ];

        foreach ($templates as $template) {
            ResumeTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}
