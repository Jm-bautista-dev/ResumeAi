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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;850&family=Poppins:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --portfolio-primary: {{ $primaryColor }};
            --portfolio-secondary: {{ $secondaryColor }};
            --portfolio-accent: {{ $accentColor }};
        }
        .portfolio-font {
            font-family: '{{ $fontFamily }}', sans-serif;
        }
    </style>
</head>
<body class="portfolio-font text-slate-100 bg-slate-950 min-h-screen">

    <div class="max-w-5xl mx-auto px-6 py-12">
        
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
                                            <a href="{{ $proj['link'] }}" target="_blank" class="text-xs text-zinc-455 hover:text-zinc-900 transition underline font-normal">Link ↗</a>
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
</body>
</html>
