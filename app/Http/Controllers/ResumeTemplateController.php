<?php

namespace App\Http\Controllers;

use App\Models\ResumeTemplate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResumeTemplateController extends Controller
{
    /**
     * Display the visual template gallery
     */
    public function index(): View
    {
        $templates = ResumeTemplate::active();
        return view('resume.templates', compact('templates'));
    }
}
