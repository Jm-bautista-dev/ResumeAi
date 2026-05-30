<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AiController;

// ─── Public / Guest Routes ───────────────────────────────────────────────────
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/features',[HomeController::class, 'features'])->name('features');

// ─── Auth Routes ─────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resume Routes
    Route::get('/resume/templates',          [\App\Http\Controllers\ResumeTemplateController::class, 'index'])->name('resume.templates');
    Route::get('/resume/import',             [\App\Http\Controllers\ResumeImportController::class, 'create'])->name('resume.import');
    Route::post('/resume/import',            [\App\Http\Controllers\ResumeImportController::class, 'store'])->name('resume.import.store');
    Route::get('/resume/{resume}/score',     [\App\Http\Controllers\AiScoreController::class, 'show'])->name('resume.score');
    Route::post('/resume/{resume}/analyze',   [\App\Http\Controllers\AiScoreController::class, 'analyze'])->name('resume.analyze');
    Route::post('/resume/{resume}/apply-fixes', [\App\Http\Controllers\AiScoreController::class, 'applyFixes'])->name('resume.apply-fixes');
    Route::get('/resume/{resume}/preview/{template}', [ResumeController::class, 'previewTemplate'])->name('resume.preview-template');
    
    Route::resource('resume', ResumeController::class);
    Route::post('/resume/{resume}/duplicate', [ResumeController::class, 'duplicate'])->name('resume.duplicate');
    Route::get('/resume/{resume}/preview',   [ResumeController::class, 'preview'])->name('resume.preview');

    // Portfolio Routes
    Route::resource('portfolio', PortfolioController::class);
    Route::get('/portfolio/{portfolio}/preview', [PortfolioController::class, 'preview'])->name('portfolio.preview');

    // Export Routes
    Route::get('/resume/{resume}/export-pdf',      [ExportController::class, 'exportResumePdf'])->name('resume.export-pdf');
    Route::get('/portfolio/{portfolio}/export-zip', [ExportController::class, 'exportPortfolioZip'])->name('portfolio.export-zip');

    // AI Routes (AJAX)
    Route::prefix('api')->name('api.')->group(function () {
        Route::post('/ai/improve-description', [AiController::class, 'improveDescription'])->name('ai.improve-description');
        Route::post('/ai/generate-summary',    [AiController::class, 'generateSummary'])->name('ai.generate-summary');
        Route::post('/ai/optimize-ats',        [AiController::class, 'optimizeForAts'])->name('ai.optimize-ats');
    });
});
