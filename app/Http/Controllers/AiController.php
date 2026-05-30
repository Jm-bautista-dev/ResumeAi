<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AiController extends Controller
{
    public function __construct(protected AiService $aiService)
    {
    }

    /**
     * Improve job description using AI
     */
    public function improveDescription(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resume_id' => 'required|exists:resumes,id',
            'section' => 'required|string',
            'text' => 'required|string|max:2000',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);
        abort_if($resume->user_id !== auth()->id(), 403);

        try {
            $result = $this->aiService->improveDescription(
                auth()->user(),
                $resume,
                $validated['text']
            );

            return response()->json([
                'success' => true,
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to improve text. Please try again.',
            ], 500);
        }
    }

    /**
     * Generate professional summary using AI
     */
    public function generateSummary(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resume_id' => 'required|exists:resumes,id',
            'skills' => 'required|array',
            'experience' => 'nullable|string',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);
        abort_if($resume->user_id !== auth()->id(), 403);

        try {
            $result = $this->aiService->generateSummary(
                auth()->user(),
                $resume,
                $validated
            );

            return response()->json([
                'success' => true,
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to generate summary. Please try again.',
            ], 500);
        }
    }

    /**
     * Optimize for ATS
     */
    public function optimizeForAts(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'resume_id' => 'required|exists:resumes,id',
        ]);

        $resume = Resume::findOrFail($validated['resume_id']);
        abort_if($resume->user_id !== auth()->id(), 403);

        try {
            $result = $this->aiService->optimizeForAts(
                auth()->user(),
                $resume
            );

            return response()->json([
                'success' => true,
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to optimize resume. Please try again.',
            ], 500);
        }
    }
}
