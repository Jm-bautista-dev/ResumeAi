<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\Portfolio;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PdfExportService
{
    /**
     * Export resume as PDF
     */
    public function exportResume(Resume $resume): StreamedResponse|BinaryFileResponse
    {
        $templateSlug = $resume->template_slug ?? 'modern-professional';
        $viewName = "templates.resume.{$templateSlug}";

        if (!view()->exists($viewName)) {
            $viewName = 'resume.pdf-export';
        }

        $pdf = Pdf::loadView($viewName, [
            'resume' => $resume,
            'data' => $resume->getStructuredData(),
            'isPdf' => true,
        ]);

        $filename = $resume->slug . '.pdf';
        $path = "exports/resumes/{$filename}";

        Storage::put($path, $pdf->output());

        // Log the export
        $resume->user->exports()->create([
            'resume_id' => $resume->id,
            'type' => 'resume',
            'format' => 'pdf',
            'file_path' => $path,
            'file_size' => Storage::size($path),
        ]);

        return Storage::download($path, $filename);
    }

    /**
     * Export portfolio as ZIP
     */
    public function exportPortfolio(Portfolio $portfolio): StreamedResponse|BinaryFileResponse
    {
        $zipPath = storage_path("app/exports/portfolios/{$portfolio->slug}.zip");
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception('Could not create ZIP file');
        }

        // Add HTML files
        $html = view('portfolio.static-export', [
            'portfolio' => $portfolio,
            'resume' => $portfolio->resume,
        ])->render();

        $zip->addFromString('index.html', $html);
        $zip->addFromString('styles.css', $this->generatePortfolioStyles($portfolio));
        $zip->addFromString('script.js', $this->generatePortfolioScript());

        $zip->close();

        // Log the export
        $portfolio->user->exports()->create([
            'portfolio_id' => $portfolio->id,
            'type' => 'portfolio',
            'format' => 'zip',
            'file_path' => "exports/portfolios/{$portfolio->slug}.zip",
            'file_size' => filesize($zipPath),
        ]);

        return response()->download($zipPath, "{$portfolio->slug}.zip");
    }

    /**
     * Generate portfolio CSS
     */
    protected function generatePortfolioStyles(Portfolio $portfolio): string
    {
        return <<<'CSS'
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1f2937;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        
        section {
            padding: 60px 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        h2 {
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }
        
        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            transition: box-shadow 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        CSS;
    }

    /**
     * Generate portfolio JavaScript
     */
    protected function generatePortfolioScript(): string
    {
        return <<<'JS'
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Portfolio loaded');
            
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });
        JS;
    }
}
