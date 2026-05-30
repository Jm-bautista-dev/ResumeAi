@extends('layouts.app')

@section('title', 'Portfolio Preview - ' . $portfolio->title)

@section('content')
@php
    $config = $portfolio->config ?? [];
    $theme = $config['theme'] ?? [
        'primaryColor' => '#3B82F6',
        'secondaryColor' => '#1E293B',
        'accentColor' => '#EC4899',
        'fontFamily' => 'Inter'
    ];
    $sections = $config['sections'] ?? [
        'hero' => ['enabled' => true],
        'projects' => ['enabled' => true],
        'skills' => ['enabled' => true],
        'contact' => ['enabled' => true]
    ];
    $resumeData = $resume->getStructuredData();
    $fullName = $resumeData['personalInfo']['fullName'] ?? 'Your Name';
    $email = $resumeData['personalInfo']['email'] ?? 'hello@example.com';
    $phone = $resumeData['personalInfo']['phone'] ?? '';
    $location = $resumeData['personalInfo']['location'] ?? '';
    $website = $resumeData['personalInfo']['website'] ?? '';
    $bio = $resumeData['summary'] ?? 'Professional Bio...';
    $skills = $resumeData['skills'] ?? [];
    $projectsList = $resumeData['projects'] ?? [];
    
    $templateSlug = $portfolio->template->slug ?? 'modern-minimal';
    
    $primaryColor = $theme['primaryColor'] ?? '#3B82F6';
    $secondaryColor = $theme['secondaryColor'] ?? '#1E293B';
    $accentColor = $theme['accentColor'] ?? '#EC4899';
    $fontFamily = $theme['fontFamily'] ?? 'Inter';
@endphp

<!-- Custom Style Injection -->
<style>
    :root {
        --portfolio-primary: {{ $primaryColor }};
        --portfolio-secondary: {{ $secondaryColor }};
        --portfolio-accent: {{ $accentColor }};
    }
    .portfolio-font {
        font-family: '{{ $fontFamily }}', sans-serif;
    }
    .accent-glow {
        box-shadow: 0 0 15px {{ $accentColor }}33;
    }
    .primary-glow {
        box-shadow: 0 0 15px {{ $primaryColor }}33;
    }
</style>

<div class="min-h-screen bg-slate-950 text-slate-100 portfolio-font">
    
    <!-- Editor Header Toolbar (Floating) -->
    <div class="bg-slate-900/80 border-b border-slate-800 backdrop-blur-md py-4 px-6 sticky top-[73px] z-40">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('portfolio.edit', $portfolio) }}" class="text-slate-400 hover:text-white transition flex items-center gap-1.5 text-sm">
                &larr; Back to Editor
            </a>
            <div class="flex items-center gap-3">
                <span class="text-xs px-3 py-1 bg-slate-800 rounded-full border border-slate-700 text-slate-300">
                    Template: <span class="font-bold text-white uppercase">{{ str_replace('-', ' ', $templateSlug) }}</span>
                </span>
                <a href="{{ route('portfolio.export-zip', $portfolio) }}" 
                   class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition text-sm shadow-lg shadow-emerald-500/20">
                    Export Static ZIP
                </a>
            </div>
        </div>
    </div>

    <!-- MAIN PORTFOLIO RENDER -->
    <div class="py-12 max-w-5xl mx-auto px-6">
        @if (view()->exists("templates.portfolio.{$templateSlug}"))
            @include("templates.portfolio.{$templateSlug}", [
                'fullName' => $fullName,
                'bio' => $bio,
                'skills' => $skills,
                'projectsList' => $projectsList,
                'sections' => $sections,
                'email' => $email,
                'phone' => $phone,
                'location' => $location,
                'website' => $website,
                'primaryColor' => $primaryColor,
                'secondaryColor' => $secondaryColor,
                'accentColor' => $accentColor,
                'fontFamily' => $fontFamily
            ])
        @else
            <!-- FALLBACK DEFAULT LAYOUT -->
            <div class="bg-white text-zinc-900 border border-zinc-200 p-8 md:p-12 rounded-lg max-w-4xl mx-auto shadow-sm">
                @if ($sections['hero']['enabled'] ?? true)
                    <header class="pb-8 border-b border-zinc-200 mb-8">
                        <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-3" style="color: {{ $primaryColor }}">{{ $fullName }}</h1>
                        <p class="text-zinc-650 leading-relaxed text-sm md:text-base font-normal">
                            {{ $bio }}
                        </p>
                    </header>
                @endif

                @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
                    <section class="mb-10">
                        <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Projects</h2>
                        <div class="space-y-6">
                            @foreach ($projectsList as $proj)
                                <div>
                                    <h3 class="font-bold text-zinc-900 text-sm flex items-center gap-2">
                                        <span>&bull;</span> {{ $proj['title'] ?? '' }}
                                        @if ($proj['link'] ?? '')
                                            <a href="{{ $proj['link'] }}" target="_blank" class="text-xs text-zinc-450 hover:text-zinc-900 transition underline font-normal">Link ↗</a>
                                        @endif
                                    </h3>
                                    <p class="text-zinc-600 text-xs mt-1.5 leading-relaxed font-light">{{ $proj['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
                    <section class="mb-10 border-t border-zinc-200 pt-8">
                        <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-3">Skills</h2>
                        <div class="flex flex-wrap gap-x-4 gap-y-1.5 text-zinc-700 text-xs font-medium">
                            @foreach ($skills as $skill)
                                <span>&bull; {{ $skill }}</span>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection
