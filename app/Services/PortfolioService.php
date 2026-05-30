<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\PortfolioTemplate;
use App\Models\User;
use Illuminate\Support\Str;

class PortfolioService
{
    /**
     * Create a new portfolio
     */
    public function createPortfolio(User $user, array $data): Portfolio
    {
        $template = PortfolioTemplate::find($data['template_id']);

        $portfolio = new Portfolio([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . uniqid(),
            'template_id' => $data['template_id'],
            'config' => json_encode([
                'theme' => [
                    'primaryColor' => '#3B82F6',
                    'secondaryColor' => '#1E293B',
                    'accentColor' => '#EC4899',
                ],
                'sections' => [
                    'hero' => ['enabled' => true],
                    'projects' => ['enabled' => true],
                    'skills' => ['enabled' => true],
                    'contact' => ['enabled' => true],
                ],
            ]),
        ]);

        $portfolio->resume_id = $data['resume_id'];
        $user->portfolios()->save($portfolio);

        return $portfolio;
    }

    /**
     * Update a portfolio
     */
    public function updatePortfolio(Portfolio $portfolio, array $data): Portfolio
    {
        if (isset($data['config'])) {
            $portfolio->config = is_string($data['config']) 
                ? $data['config'] 
                : json_encode($data['config']);
        }

        if (isset($data['title'])) {
            $portfolio->title = $data['title'];
        }

        $portfolio->save();

        return $portfolio;
    }

    /**
     * Generate static portfolio files
     */
    public function generateStaticBuild(Portfolio $portfolio): array
    {
        // Implementation would generate HTML, CSS, JS files
        return [
            'status' => 'success',
            'files' => [],
        ];
    }
}
