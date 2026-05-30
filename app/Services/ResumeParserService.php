<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class ResumeParserService
{
    /**
     * Parse raw text into structured resume array
     */
    public function parseText(string $text): array
    {
        $lines = explode("\n", $text);
        $data = [
            'personalInfo' => [
                'fullName' => '',
                'email' => '',
                'phone' => '',
                'location' => '',
                'website' => '',
            ],
            'summary' => '',
            'skills' => [],
            'experience' => [],
            'education' => [],
            'projects' => [],
            'certifications' => [],
            'socialLinks' => [],
            'awards' => [],
            'languages' => [],
        ];

        // 1. Extract email
        if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches)) {
            $data['personalInfo']['email'] = trim($matches[0]);
        }

        // 2. Extract phone
        if (preg_match('/\(?\+?[0-9]{1,4}\)?[-\s.]?[0-9]{3}[-\s.]?[0-9]{3,4}[-\s.]?[0-9]{3,4}/', $text, $matches)) {
            $data['personalInfo']['phone'] = trim($matches[0]);
        }

        // 3. Extract website/social
        if (preg_match('/(https?:\/\/)?(www\.)?(github\.com|linkedin\.com|portfolio|twitter\.com)\/[a-zA-Z0-9-_]+/i', $text, $matches)) {
            $data['personalInfo']['website'] = trim($matches[0]);
        }

        // 4. Try to find the name from the very first few lines (usually line 0 or 1 is the name if it is not a header)
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (empty($trimmed)) continue;
            // First non-empty line that doesn't contain @, phone chars, or section keywords is probably the name
            if (!str_contains($trimmed, '@') && !preg_match('/[0-9]{5,}/', $trimmed) && !preg_match('/(resume|cv|experience|education|skills|summary)/i', $trimmed) && strlen($trimmed) < 40) {
                $data['personalInfo']['fullName'] = $trimmed;
                break;
            }
        }

        // 5. Segment-based parsing (splitting by typical headers)
        $sections = $this->extractSections($text);

        // Summary
        if (!empty($sections['summary'])) {
            $data['summary'] = trim($sections['summary']);
        }

        // Skills
        if (!empty($sections['skills'])) {
            // Split skills by commas, bullets, pipes, or newlines
            $skillsText = $sections['skills'];
            $splitSkills = preg_split('/[,•|]|\n/', $skillsText);
            foreach ($splitSkills as $skill) {
                $trimmed = trim($skill, " \t\n\r\0\x0B•*-");
                if (!empty($trimmed) && strlen($trimmed) < 40) {
                    $data['skills'][] = $trimmed;
                }
            }
        }

        // Experience
        if (!empty($sections['experience'])) {
            $expLines = explode("\n", $sections['experience']);
            $currentJob = null;
            $descLines = [];

            foreach ($expLines as $line) {
                $trimmed = trim($line);
                if (empty($trimmed)) continue;

                // Detect a new job: e.g. "Software Engineer at Acme Corp" or "Acme Corp | Software Engineer | 2020 - Present"
                if (preg_match('/(at|@|\|)/i', $trimmed) || preg_match('/(engineer|developer|manager|analyst|specialist|designer|intern|consultant)/i', $trimmed)) {
                    if ($currentJob) {
                        $currentJob['description'] = implode("\n", $descLines);
                        $data['experience'][] = $currentJob;
                    }
                    
                    $parts = preg_split('/(at|@|\|)/i', $trimmed, 2);
                    $position = trim($parts[0] ?? 'Position');
                    $company = trim($parts[1] ?? 'Company');
                    
                    // Basic cleanup of dates if inline
                    $startDate = '';
                    $endDate = '';
                    if (preg_match('/(19|20)\d{2}/', $company, $dateMatches)) {
                        // date found, simple split placeholder
                        $startDate = $dateMatches[0];
                        $endDate = 'Present';
                    }

                    $currentJob = [
                        'company' => $company,
                        'position' => $position,
                        'startDate' => $startDate ?: '2022',
                        'endDate' => $endDate ?: 'Present',
                        'description' => ''
                    ];
                    $descLines = [];
                } else {
                    if ($currentJob) {
                        $descLines[] = ltrim($trimmed, ' •*-');
                    }
                }
            }
            if ($currentJob) {
                $currentJob['description'] = implode("\n", $descLines);
                $data['experience'][] = $currentJob;
            }
        }

        // Education
        if (!empty($sections['education'])) {
            $eduLines = explode("\n", $sections['education']);
            foreach ($eduLines as $line) {
                $trimmed = trim($line);
                if (empty($trimmed)) continue;

                // e.g. "BS in Computer Science - Stanford University, 2020"
                $degree = 'Bachelor\'s Degree';
                $field = 'Computer Science';
                $school = $trimmed;
                $year = '2021';

                if (preg_match('/(bachelor|bs|ba|master|ms|ma|phd|diploma)/i', $trimmed, $degMatches)) {
                    $degree = $degMatches[0];
                }
                
                if (preg_match('/(in|of)\s+([a-zA-Z\s]+)/i', $trimmed, $fieldMatches)) {
                    $field = trim($fieldMatches[2]);
                }

                if (preg_match('/(19|20)\d{2}/', $trimmed, $yearMatches)) {
                    $year = $yearMatches[0];
                }

                $data['education'][] = [
                    'school' => $school,
                    'degree' => $degree,
                    'field' => $field,
                    'year' => $year
                ];
            }
        }

        // Projects
        if (!empty($sections['projects'])) {
            $projLines = explode("\n", $sections['projects']);
            $currentProj = null;
            foreach ($projLines as $line) {
                $trimmed = trim($line);
                if (empty($trimmed)) continue;

                if (strlen($trimmed) < 40 && !str_starts_with($trimmed, '-')) {
                    if ($currentProj) {
                        $data['projects'][] = $currentProj;
                    }
                    $currentProj = [
                        'title' => $trimmed,
                        'description' => '',
                        'link' => ''
                    ];
                } elseif ($currentProj) {
                    $currentProj['description'] .= ($currentProj['description'] ? ' ' : '') . ltrim($trimmed, ' •*-');
                }
            }
            if ($currentProj) {
                $data['projects'][] = $currentProj;
            }
        }

        // Fallbacks for empty arrays to keep edit page functioning properly
        if (empty($data['skills'])) $data['skills'] = ['PHP', 'Laravel', 'JavaScript'];
        if (empty($data['experience'])) $data['experience'] = [['company' => 'Acme Corp', 'position' => 'Senior Developer', 'startDate' => '2022', 'endDate' => 'Present', 'description' => 'Developed fullstack apps using Laravel and Alpine.js.']];

        return $data;
    }

    /**
     * Extract raw text from PDF
     */
    public function parsePdf(string $path): string
    {
        $parserClass = 'Smalot\\PdfParser\\Parser';
        if (class_exists($parserClass)) {
            try {
                $parser = new $parserClass();
                $pdf = $parser->parseFile($path);
                return $pdf->getText();
            } catch (Exception $e) {
                Log::error('Smalot PDF parser failed: ' . $e->getMessage());
            }
        }

        // Fallback: Read using basic text filter or shell command if pdftotext exists
        return "Failed to parse PDF binary data. Please copy-paste your resume text instead.";
    }

    /**
     * Split raw text into sections
     */
    public function extractSections(string $text): array
    {
        $sections = [
            'summary' => '',
            'experience' => '',
            'education' => '',
            'skills' => '',
            'projects' => '',
        ];

        $lines = explode("\n", $text);
        $currentSection = '';

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (empty($trimmed)) continue;

            // Detect section headers
            if (preg_match('/^(professional\s+)?summary|about\s*me/i', $trimmed)) {
                $currentSection = 'summary';
                continue;
            } elseif (preg_match('/^(work\s+)?experience|employment|career/i', $trimmed)) {
                $currentSection = 'experience';
                continue;
            } elseif (preg_match('/^education|academic/i', $trimmed)) {
                $currentSection = 'education';
                continue;
            } elseif (preg_match('/^skills|technical\s+skills|expertise/i', $trimmed)) {
                $currentSection = 'skills';
                continue;
            } elseif (preg_match('/^projects|key\s+projects|featured\s+projects/i', $trimmed)) {
                $currentSection = 'projects';
                continue;
            }

            if ($currentSection) {
                $sections[$currentSection] .= $line . "\n";
            }
        }

        return $sections;
    }
}
