<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Str;

class ResumeService
{
    /**
     * Create a new resume
     */
    public function createResume(User $user, array $data): Resume
    {
        $resume = new Resume([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . uniqid(),
            'template_id' => $data['template_id'] ?? 1,
            'template_slug' => $data['template_slug'] ?? 'modern-professional',
            'job_role' => $data['job_role'] ?? 'Software Professional',
            'industry' => $data['industry'] ?? null,
            'content' => [
                'personalInfo' => [
                    'fullName' => $user->name,
                    'email' => $user->email,
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
            ],
        ]);

        $user->resumes()->save($resume);

        return $resume;
    }

    /**
     * Update a resume
     */
    public function updateResume(Resume $resume, array $data): Resume
    {
        if (isset($data['content'])) {
            $resume->content = is_string($data['content']) 
                ? json_decode($data['content'], true) 
                : $data['content'];
        }

        if (isset($data['title'])) {
            $resume->title = $data['title'];
        }

        if (isset($data['template_slug'])) {
            $resume->template_slug = $data['template_slug'];
        }

        if (isset($data['job_role'])) {
            $resume->job_role = $data['job_role'];
        }

        if (isset($data['industry'])) {
            $resume->industry = $data['industry'];
        }

        $resume->save();

        return $resume;
    }

    /**
     * Duplicate a resume
     */
    public function duplicateResume(Resume $resume): Resume
    {
        $newResume = new Resume([
            'title' => $resume->title . ' (Copy)',
            'slug' => Str::slug($resume->title . ' copy') . '-' . uniqid(),
            'template_id' => $resume->template_id,
            'content' => $resume->content,
        ]);

        $resume->user->resumes()->save($newResume);

        return $newResume;
    }
}
