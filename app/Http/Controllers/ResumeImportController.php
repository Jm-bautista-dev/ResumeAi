<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\ResumeImport;
use App\Services\AiService;
use App\Services\ResumeParserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ResumeImportController extends Controller
{
    public function __construct(
        protected AiService $aiService,
        protected ResumeParserService $parserService
    ) {}

    /**
     * Show import form page
     */
    public function create(): View
    {
        return view('resume.import');
    }

    /**
     * Handle resume import processing
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'resume_file' => 'required|file|mimes:txt,pdf|max:5120',
        ]);

        $file = $request->file('resume_file');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $rawText = '';

        try {
            // Extract raw text
            if ($extension === 'txt') {
                $rawText = file_get_contents($file->getRealPath());
            } elseif ($extension === 'pdf') {
                $rawText = $this->parserService->parsePdf($file->getRealPath());
            }

            if (empty($rawText) || str_contains($rawText, 'Failed to parse PDF')) {
                return redirect()->back()->with('error', 'We could not extract any text from this file. Please make sure the document is not password-protected or empty.');
            }

            // Parse text via AI Service
            $parsedData = $this->aiService->parseImportedText($rawText);

            // Create fresh new Resume for user
            $title = 'Imported Resume - ' . date('M d, Y');
            $resume = Resume::create([
                'user_id' => auth()->id(),
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'template_id' => 1,
                'template_slug' => 'modern-professional',
                'content' => json_encode($parsedData),
                'job_role' => $parsedData['personalInfo']['jobRole'] ?? 'Software Professional',
            ]);

            // Save resume import record
            ResumeImport::create([
                'user_id' => auth()->id(),
                'original_filename' => $fileName,
                'raw_text' => $rawText,
                'parsed_data' => $parsedData,
                'status' => 'completed',
                'resume_id' => $resume->id,
            ]);

            return redirect()->route('resume.edit', $resume)->with('success', 'Resume parsed and imported successfully!');

        } catch (\Exception $e) {
            ResumeImport::create([
                'user_id' => auth()->id(),
                'original_filename' => $fileName,
                'raw_text' => $rawText ?: null,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
