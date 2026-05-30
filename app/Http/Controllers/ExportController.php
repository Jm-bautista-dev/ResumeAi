<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\PdfExportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
    public function __construct(protected PdfExportService $pdfService)
    {
    }

    /**
     * Export resume as PDF
     */
    public function exportResumePdf(Resume $resume): BinaryFileResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);
        return $this->pdfService->exportResume($resume);
    }

    /**
     * Export portfolio as static files
     */
    public function exportPortfolioZip(\App\Models\Portfolio $portfolio): BinaryFileResponse
    {
        abort_if($portfolio->user_id !== auth()->id(), 403);
        return $this->pdfService->exportPortfolio($portfolio);
    }
}
