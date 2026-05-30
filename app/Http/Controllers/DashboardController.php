<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     */
    public function index(): View
    {
        $user = auth()->user();
        $resumes = $user->resumes()->latest()->limit(5)->get();
        $portfolios = $user->portfolios()->latest()->limit(5)->get();
        $recentExports = $user->exports()->latest()->limit(5)->get();
        $aiRequestCount = $user->aiRequests()->count();

        $stats = [
            'totalResumes' => $user->resumes()->count(),
            'totalPortfolios' => $user->portfolios()->count(),
            'aiRequests' => $aiRequestCount,
            'exports' => $user->exports()->count(),
        ];

        return view('dashboard.index', compact('user', 'resumes', 'portfolios', 'recentExports', 'stats'));
    }
}
