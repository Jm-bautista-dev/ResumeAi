<?php

namespace App\Services;

use App\Models\AiRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiService
{
    protected ?string $openaiKey = null;
    protected ?string $groqKey = null;

    public function __construct()
    {
        $this->openaiKey = config('services.openai.key');
        $this->groqKey = config('services.groq.key');
    }

    /**
     * Improve job description
     */
    public function improveDescription(User $user, Resume $resume, string $text): string
    {
        if (!config('services.ai.enabled')) {
            return $text;
        }

        $prompt = "You are a professional resume editor. Rewrite the following job description bullet point to be more professional, action-oriented, impactful, and clear. Keep it to a single bullet point/sentence: \n\n\"" . $text . "\"";

        $response = $this->callAiApi($prompt, 'improve_description', $text);

        AiRequest::create([
            'user_id' => $user->id,
            'resume_id' => $resume->id,
            'type' => 'improve_description',
            'input' => json_encode(['text' => $text]),
            'output' => json_encode(['result' => $response]),
            'status' => 'completed',
        ]);

        return $response;
    }

    /**
     * Generate professional summary
     */
    public function generateSummary(User $user, Resume $resume, array $data): string
    {
        if (!config('services.ai.enabled')) {
            return 'Professional summary would be generated here.';
        }

        $prompt = $this->buildSummaryPrompt($data);

        $response = $this->callAiApi($prompt, 'professional_summary');

        AiRequest::create([
            'user_id' => $user->id,
            'resume_id' => $resume->id,
            'type' => 'professional_summary',
            'input' => json_encode($data),
            'output' => json_encode(['result' => $response]),
            'status' => 'completed',
        ]);

        return $response;
    }

    /**
     * Optimize resume for ATS
     */
    public function optimizeForAts(User $user, Resume $resume): array
    {
        if (!config('services.ai.enabled')) {
            return ['suggestions' => 'Resume optimization requires AI to be enabled'];
        }

        $resumeData = $resume->getStructuredData();
        $prompt = "Analyze this resume content and provide 3 key ATS optimization suggestions in bullet points:\n\n" . json_encode($resumeData);

        $response = $this->callAiApi($prompt, 'ats_optimization');

        AiRequest::create([
            'user_id' => $user->id,
            'resume_id' => $resume->id,
            'type' => 'ats_optimization',
            'input' => json_encode(['resume_id' => $resume->id]),
            'output' => json_encode(['suggestions' => $response]),
            'status' => 'completed',
        ]);

        return ['suggestions' => $response];
    }

    /**
     * Compute a dynamic AI Score based on content completeness (with smart API or responsive mock fallback)
     */
    public function scoreResume(Resume $resume): array
    {
        $data = $resume->getStructuredData();
        
        // Responsive mock logic based on actual filled out content
        $ats = 60;
        $grammar = 70;
        $content = 55;
        $keywords = 50;

        if (!empty($data['summary'])) { $ats += 10; $content += 15; }
        if (count($data['skills']) > 4) { $keywords += 25; $ats += 10; }
        if (count($data['experience']) > 1) { $content += 20; $ats += 10; }
        if (count($data['education']) > 0) { $grammar += 15; $content += 10; }
        if (count($data['projects']) > 0) { $content += 10; $keywords += 10; }

        $ats = min(100, $ats);
        $grammar = min(100, $grammar);
        $content = min(100, $content);
        $keywords = min(100, $keywords);

        $overall = round(($ats + $grammar + $content + $keywords) / 4);

        if (!empty($this->groqKey) || !empty($this->openaiKey)) {
            $prompt = "Score the following resume on a 0-100 scale. Return ONLY a valid JSON string with keys 'score' (overall), 'ats_score', 'grammar_score', 'content_score', 'keyword_score':\n\n" . json_encode($data);
            $res = $this->callAiApi($prompt, 'json_score');
            $decoded = json_decode($res, true);
            if (is_array($decoded) && isset($decoded['score'])) {
                return $decoded;
            }
        }

        return [
            'score' => $overall,
            'ats_score' => $ats,
            'grammar_score' => $grammar,
            'content_score' => $content,
            'keyword_score' => $keywords
        ];
    }

    /**
     * Complete deep AI resume analysis (strengths, weaknesses, suggestions, missing skills)
     */
    public function analyzeFullResume(Resume $resume): array
    {
        $data = $resume->getStructuredData();
        $scores = $this->scoreResume($resume);

        $strengths = [
            "Well-structured contact information header details.",
            "Strong skills section featuring highly desired technological competencies."
        ];
        $weaknesses = [
            "Professional summary is relatively short or lacks metric-driven results.",
            "Work experience descriptions could include more quantifiable key performance indicators (KPIs)."
        ];
        $suggestions = [
            "Begin experience descriptions with action verbs like 'Spearheaded', 'Engineered', and 'Architected'.",
            "Integrate at least three numerical achievements (e.g., 'boosted speed by 40%', 'reduced costs by 15%').",
            "Optimize skill category density by adding relevant industry keywords."
        ];
        $missingSkills = ["System Architecture", "Docker", "RESTful API Design"];
        $suggestedRoles = ["Senior Software Engineer", "Fullstack Web Developer", "Tech Lead"];

        if (!empty($data['skills'])) {
            $roles = $this->suggestJobRoles($resume);
            if (!empty($roles)) $suggestedRoles = $roles;
        }

        if (!empty($this->groqKey) || !empty($this->openaiKey)) {
            $prompt = "Analyze the following resume and return ONLY a valid JSON string with keys 'strengths' (array of strings), 'weaknesses' (array), 'suggestions' (array), 'missing_skills' (array), 'suggested_roles' (array):\n\n" . json_encode($data);
            $res = $this->callAiApi($prompt, 'json_analysis');
            $decoded = json_decode($res, true);
            if (is_array($decoded)) {
                return array_merge($scores, $decoded);
            }
        }

        return array_merge($scores, [
            'strengths' => $strengths,
            'weaknesses' => $weaknesses,
            'suggestions' => $suggestions,
            'missing_skills' => $missingSkills,
            'suggested_roles' => $suggestedRoles,
            'recommended_template' => $this->matchTemplate($resume)
        ]);
    }

    /**
     * Suggest related high-paying job roles matching the skillset
     */
    public function suggestJobRoles(Resume $resume): array
    {
        $skills = $resume->content['skills'] ?? [];
        if (empty($skills)) return ['Software Developer', 'Technology Consultant'];

        // Dynamic rule-based mapping for mock
        $joined = strtolower(implode(' ', $skills));
        $roles = [];
        if (str_contains($joined, 'php') || str_contains($joined, 'laravel')) {
            $roles[] = 'Laravel Engineer';
            $roles[] = 'Backend Developer';
        }
        if (str_contains($joined, 'javascript') || str_contains($joined, 'react') || str_contains($joined, 'vue')) {
            $roles[] = 'Frontend Developer';
            $roles[] = 'React Specialist';
        }
        if (str_contains($joined, 'python') || str_contains($joined, 'machine learning')) {
            $roles[] = 'Data Scientist';
            $roles[] = 'Python Architect';
        }
        
        $roles[] = 'Fullstack Developer';
        return array_unique($roles);
    }

    /**
     * Match the ideal resume template slug based on resume contents
     */
    public function matchTemplate(Resume $resume): string
    {
        $skills = $resume->content['skills'] ?? [];
        $joined = strtolower(implode(' ', $skills));
        
        if (str_contains($joined, 'developer') || str_contains($joined, 'engineer') || str_contains($joined, 'code')) {
            return 'technical-dev';
        }
        if (str_contains($joined, 'designer') || str_contains($joined, 'creative') || str_contains($joined, 'marketing')) {
            return 'creative-bold';
        }
        if (str_contains($joined, 'manager') || str_contains($joined, 'director') || str_contains($joined, 'executive')) {
            return 'corporate-executive';
        }
        return 'modern-professional';
    }

    /**
     * Suggest additional high-value skills for a target job role
     */
    public function suggestSkills(Resume $resume, string $targetRole): array
    {
        return ["AWS Cloud Practitioner", "Docker & Kubernetes", "CI/CD Pipeline Automation", "Unit Testing (PHPUnit/Jest)"];
    }

    /**
     * Parse imported raw resume text into structured fields
     */
    public function parseImportedText(string $rawText): array
    {
        $parser = new ResumeParserService();
        return $parser->parseText($rawText);
    }

    /**
     * Call AI API (OpenAI or Groq) with Mock Fallback
     */
    protected function callAiApi(string $prompt, string $type, ?string $inputText = null): string
    {
        // 1. Try Groq API
        if (!empty($this->groqKey)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->groqKey,
                    'Content-Type' => 'application/json',
                ])->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional resume writer and ATS optimization expert.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return $data['choices'][0]['message']['content'] ?? '';
                }
            } catch (\Exception $e) {
                Log::error('Groq AI call failed: ' . $e->getMessage());
            }
        }

        // 2. Try OpenAI API
        if (!empty($this->openaiKey)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->openaiKey,
                    'Content-Type' => 'application/json',
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional resume writer and ATS optimization expert.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    return $data['choices'][0]['message']['content'] ?? '';
                }
            } catch (\Exception $e) {
                Log::error('OpenAI call failed: ' . $e->getMessage());
            }
        }

        // 3. Fallback to smart simulated AI response if no keys/failures
        return $this->getSimulatedResponse($type, $prompt, $inputText);
    }

    /**
     * Simulated premium AI responses when API keys are absent
     */
    protected function getSimulatedResponse(string $type, string $prompt, ?string $inputText = null): string
    {
        if ($type === 'improve_description') {
            if ($inputText) {
                $clean = trim($inputText);
                if (strlen($clean) > 5) {
                    return "Spearheaded the design, implementation, and maintenance of scalable architectures, enhancing overall throughput by 25% and reducing system latency. Resolved complex code regressions and implemented automated testing pipelines to ensure continuous integration stability.";
                }
            }
            return "Designed and implemented robust backend services and RESTful APIs, facilitating seamless data integration and enhancing application responsiveness by 30%.";
        }

        if ($type === 'professional_summary') {
            return "Results-oriented Software Professional with a proven track record of engineering scalable, high-performance web applications. Adept at leveraging modern methodologies and industry best practices to streamline workflows, drive cross-functional collaboration, and consistently deliver robust business-aligned solutions.";
        }

        return "• Keywords Alignment: Incorporate action verbs like 'Spearheaded', 'Engineered', and 'Optimized' at the beginning of experience descriptions to improve ATS parsing score.\n• Categorize Skills: Group your technical skills into clear categories (e.g., Frontend, Backend, Devops) so ATS algorithms can easily extract them.\n• Simplify Layout: Keep the design minimal and avoid multi-column layouts, tables, or complex graphic elements in order to guarantee seamless parsing by legacy ATS parsers.";
    }

    /**
     * Build professional summary prompt
     */
    protected function buildSummaryPrompt(array $data): string
    {
        $skills = is_array($data['skills'] ?? null) ? implode(', ', $data['skills']) : '';
        $experience = is_string($data['experience'] ?? null) ? $data['experience'] : '';

        return "Generate a professional summary for a professional with these skills: " 
            . $skills 
            . " and this experience: " 
            . $experience;
    }
}
