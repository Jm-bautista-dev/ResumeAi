<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioTemplate;

class PortfolioTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Developer Dark',
                'slug' => 'developer',
                'description' => 'Sleek Vercel-inspired dark theme optimized for software engineers and tech professionals.',
                'is_active' => true,
                'config' => json_encode([
                    'theme' => [
                        'primaryColor' => '#10B981',
                        'secondaryColor' => '#0F172A',
                        'accentColor' => '#6366F1',
                        'fontFamily' => 'JetBrains Mono'
                    ],
                    'sections' => [
                        'hero' => ['enabled' => true],
                        'projects' => ['enabled' => true],
                        'skills' => ['enabled' => true],
                        'contact' => ['enabled' => true]
                    ],
                ]),
            ],
            [
                'name' => 'Creative Agency',
                'slug' => 'creative',
                'description' => 'Bright, colorful, and bold dynamic Framer-like layout for designers and content creators.',
                'is_active' => true,
                'config' => json_encode([
                    'theme' => [
                        'primaryColor' => '#EC4899',
                        'secondaryColor' => '#F3E8FF',
                        'accentColor' => '#8B5CF6',
                        'fontFamily' => 'Poppins'
                    ],
                    'sections' => [
                        'hero' => ['enabled' => true],
                        'projects' => ['enabled' => true],
                        'skills' => ['enabled' => true],
                        'contact' => ['enabled' => true]
                    ],
                ]),
            ],
            [
                'name' => 'Corporate Executive',
                'slug' => 'corporate',
                'description' => 'Premium, traditional, structured business-focused theme for formal roles and managers.',
                'is_active' => true,
                'config' => json_encode([
                    'theme' => [
                        'primaryColor' => '#1E3A8A',
                        'secondaryColor' => '#F8FAFC',
                        'accentColor' => '#3B82F6',
                        'fontFamily' => 'Playfair Display'
                    ],
                    'sections' => [
                        'hero' => ['enabled' => true],
                        'projects' => ['enabled' => true],
                        'skills' => ['enabled' => true],
                        'contact' => ['enabled' => true]
                    ],
                ]),
            ],
            [
                'name' => 'Notion Minimal',
                'slug' => 'minimal',
                'description' => 'Ultra-clean Notion-inspired layout for minimalist designers and writers.',
                'is_active' => true,
                'config' => json_encode([
                    'theme' => [
                        'primaryColor' => '#1F2937',
                        'secondaryColor' => '#FFFFFF',
                        'accentColor' => '#4B5563',
                        'fontFamily' => 'Inter'
                    ],
                    'sections' => [
                        'hero' => ['enabled' => true],
                        'projects' => ['enabled' => true],
                        'skills' => ['enabled' => true],
                        'contact' => ['enabled' => true]
                    ],
                ]),
            ],
            [
                'name' => 'SaaS Product Landing',
                'slug' => 'saas',
                'description' => 'Modern SaaS marketing style landing page design to showcase yourself as a product/business developer.',
                'is_active' => true,
                'config' => json_encode([
                    'theme' => [
                        'primaryColor' => '#4F46E5',
                        'secondaryColor' => '#0F172A',
                        'accentColor' => '#F43F5E',
                        'fontFamily' => 'Inter'
                    ],
                    'sections' => [
                        'hero' => ['enabled' => true],
                        'projects' => ['enabled' => true],
                        'skills' => ['enabled' => true],
                        'contact' => ['enabled' => true]
                    ],
                ]),
            ],
        ];

        foreach ($templates as $template) {
            PortfolioTemplate::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}
