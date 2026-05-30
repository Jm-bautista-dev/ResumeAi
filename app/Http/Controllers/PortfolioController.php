<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends Controller
{
    public function __construct(protected PortfolioService $portfolioService)
    {
    }

    /**
     * Display a listing of portfolios
     */
    public function index(): View
    {
        $portfolios = auth()->user()->portfolios()->latest()->paginate(12);
        return view('portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio
     */
    public function create(): View
    {
        $resumes = auth()->user()->resumes()->get();
        $templates = \App\Models\PortfolioTemplate::where('is_active', true)->get();
        return view('portfolio.create', compact('resumes', 'templates'));
    }

    /**
     * Store a newly created portfolio
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'resume_id' => 'required|exists:resumes,id',
            'template_id' => 'required|exists:portfolio_templates,id',
        ]);

        $portfolio = $this->portfolioService->createPortfolio(
            auth()->user(),
            $validated
        );

        return redirect()->route('portfolio.edit', $portfolio)->with('success', 'Portfolio created successfully');
    }

    /**
     * Show the portfolio editor
     */
    public function edit(Portfolio $portfolio): View
    {
        abort_if($portfolio->user_id !== auth()->id(), 403);
        $templates = \App\Models\PortfolioTemplate::where('is_active', true)->get();
        return view('portfolio.edit', compact('portfolio', 'templates'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        abort_if($portfolio->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'config' => 'required|json',
        ]);

        $this->portfolioService->updatePortfolio($portfolio, $validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Portfolio updated successfully',
                'portfolio' => $portfolio
            ]);
        }

        return redirect()->back()->with('success', 'Portfolio updated successfully');
    }

    /**
     * Preview the portfolio
     */
    public function preview(Portfolio $portfolio): View
    {
        abort_if($portfolio->user_id !== auth()->id(), 403);
        $resume = $portfolio->resume;
        return view('portfolio.preview', compact('portfolio', 'resume'));
    }

    /**
     * Delete a portfolio
     */
    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        abort_if($portfolio->user_id !== auth()->id(), 403);

        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Portfolio deleted successfully');
    }
}
