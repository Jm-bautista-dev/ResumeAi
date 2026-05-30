<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\AiAnalysisResult;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AiScoreController extends Controller
{
    public function __construct(protected AiService $aiService)
    {}

    /**
     * Display circular progress visuals, breakdown, actionable suggestions
     */
    public function show(Resume $resume): View
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        // Fetch existing or run a fresh analysis
        $analysis = AiAnalysisResult::where('resume_id', $resume->id)->latest()->first();

        if (!$analysis) {
            $analysisData = $this->aiService->analyzeFullResume($resume);
            $analysis = AiAnalysisResult::create([
                'resume_id' => $resume->id,
                'user_id' => auth()->id(),
                'score' => $analysisData['score'] ?? 70,
                'ats_score' => $analysisData['ats_score'] ?? 70,
                'grammar_score' => $analysisData['grammar_score'] ?? 70,
                'content_score' => $analysisData['content_score'] ?? 70,
                'keyword_score' => $analysisData['keyword_score'] ?? 70,
                'suggestions' => $analysisData['suggestions'] ?? [],
                'strengths' => $analysisData['strengths'] ?? [],
                'weaknesses' => $analysisData['weaknesses'] ?? [],
                'recommended_template' => $analysisData['recommended_template'] ?? 'modern-professional',
                'suggested_roles' => $analysisData['suggested_roles'] ?? [],
                'missing_skills' => $analysisData['missing_skills'] ?? [],
            ]);

            $resume->update([
                'ai_score' => $analysis->score
            ]);
        }

        return view('resume.score', compact('resume', 'analysis'));
    }

    /**
     * Re-run resume analysis
     */
    public function analyze(Resume $resume): RedirectResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        $analysisData = $this->aiService->analyzeFullResume($resume);
        
        $analysis = AiAnalysisResult::create([
            'resume_id' => $resume->id,
            'user_id' => auth()->id(),
            'score' => $analysisData['score'] ?? 70,
            'ats_score' => $analysisData['ats_score'] ?? 70,
            'grammar_score' => $analysisData['grammar_score'] ?? 70,
            'content_score' => $analysisData['content_score'] ?? 70,
            'keyword_score' => $analysisData['keyword_score'] ?? 70,
            'suggestions' => $analysisData['suggestions'] ?? [],
            'strengths' => $analysisData['strengths'] ?? [],
            'weaknesses' => $analysisData['weaknesses'] ?? [],
            'recommended_template' => $analysisData['recommended_template'] ?? 'modern-professional',
            'suggested_roles' => $analysisData['suggested_roles'] ?? [],
            'missing_skills' => $analysisData['missing_skills'] ?? [],
        ]);

        $resume->update([
            'ai_score' => $analysis->score
        ]);

        return redirect()->back()->with('success', 'AI Analysis refreshed successfully!');
    }

    /**
     * One-click "Apply AI Fixes" bulk upgrade
     */
    public function applyFixes(Resume $resume): RedirectResponse
    {
        abort_if($resume->user_id !== auth()->id(), 403);

        /** @var array $content */
        $content = (array) $resume->content;

        // 1. Rewrite Professional Summary with Premium Simulated Version (or Call API)
        $content['summary'] = $this->aiService->generateSummary($resume->user, $resume, [
            'skills'     => (array) ($content['skills'] ?? []),
            'experience' => collect((array) ($content['experience'] ?? []))->map(fn($e) => ($e['position'] ?? '') . ' at ' . ($e['company'] ?? ''))->implode(', ')
        ]);

        // 2. Rewrite all Experience Bullet points automatically!
        $experience = (array) ($content['experience'] ?? []);
        if (!empty($experience)) {
            foreach ($experience as &$exp) {
                if (!empty($exp['description'])) {
                    $exp['description'] = $this->aiService->improveDescription($resume->user, $resume, $exp['description']);
                }
            }
            unset($exp);
            $content['experience'] = $experience;
        }

        // 3. Inject Missing Keywords/Skills automatically to boost score!
        $analysis = AiAnalysisResult::where('resume_id', $resume->id)->latest()->first();
        if ($analysis) {
            $missingSkills = is_array($analysis->missing_skills) ? $analysis->missing_skills : [];
            $existingSkills = (array) ($content['skills'] ?? []);
            foreach ($missingSkills as $missingSkill) {
                if (!in_array($missingSkill, $existingSkills)) {
                    $existingSkills[] = $missingSkill;
                }
            }
            $content['skills'] = $existingSkills;
        }

        // 4. Update Resume in database
        $resume->update([
            'content' => json_encode($content),
            'version' => $resume->version + 1,
        ]);

        // 5. Re-run analysis automatically so score immediately rises!
        $this->analyze($resume);

        return redirect()->back()->with('success', 'AI Improvements applied successfully! Experience bullet points rewritten, professional summary optimized, and keywords added. Your AI Career Score has risen!');
    }
}
