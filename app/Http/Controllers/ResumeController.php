<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\ResumeService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ResumeController extends Controller
{
    public function __construct(protected ResumeService $resumeService)
    {
    }

    /**
     * Display a listing of resumes
     */
    public function index(): View
    {
        $resumes = auth()->user()->resumes()->latest()->paginate(12);
        return view('resume.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resume
     */
    public function create(): View
    {
        return view('resume.create');
    }

    /**
     * Store a newly created resume
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'template_id' => 'required|integer',
            'template_slug' => 'nullable|string|max:100',
        ]);

        $resume = $this->resumeService->createResume(
            auth()->user(),
            $validated
        );

        return redirect()->route('resume.edit', $resume)->with('success', 'Resume created successfully');
    }

    /**
     * Show the resume editor
     */
    public function edit(Resume $resume): View
    {
        abort_if($resume->user_id !== auth()->id(), 403);
        return view('resume.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume): RedirectResponse|JsonResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|json',
            'template_slug' => 'nullable|string|max:100',
            'job_role' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        $this->resumeService->updateResume($resume, $validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Resume updated successfully',
                'resume' => $resume
            ]);
        }

        return redirect()->back()->with('success', 'Resume updated successfully');
    }

    /**
     * Preview the resume using its selected template
     */
    public function preview(Resume $resume): View
    {
        abort_if($resume->user_id !== auth()->id(), 403);
        $templateSlug = $resume->template_slug ?? 'modern-professional';
        return view('resume.preview', compact('resume', 'templateSlug'));
    }

    /**
     * Preview the resume using a specific selected template slug
     */
    public function previewTemplate(Resume $resume, string $templateSlug): View
    {
        abort_if($resume->user_id !== auth()->id(), 403);
        return view('resume.preview', compact('resume', 'templateSlug'));
    }

    /**
     * Duplicate a resume
     */
    public function duplicate(Resume $resume): RedirectResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        $newResume = $this->resumeService->duplicateResume($resume);

        return redirect()->route('resume.edit', $newResume)->with('success', 'Resume duplicated successfully');
    }

    /**
     * Delete a resume
     */
    public function destroy(Resume $resume): RedirectResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        $resume->delete();

        return redirect()->route('resume.index')->with('success', 'Resume deleted successfully');
    }
}
