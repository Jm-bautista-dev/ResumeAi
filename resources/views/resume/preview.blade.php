@extends('layouts.app')

@section('title', 'Resume Preview - ' . $resume->title)

@section('content')
@php
    $templateSlug = $templateSlug ?? $resume->template_slug ?? 'modern-professional';
    $data = $resume->getStructuredData();
@endphp

<div class="min-h-screen bg-slate-950 text-slate-100 py-12 px-6">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <!-- Control Navbar Bar (Canva-style switcher) -->
        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-xl sticky top-[73px] z-40">
            <div class="flex items-center gap-4 flex-wrap">
                <a href="{{ route('resume.edit', $resume) }}" class="text-slate-400 hover:text-white transition text-sm flex items-center gap-1">&larr; Back to Editor</a>
                
                <span class="w-px h-6 bg-slate-800 hidden md:block"></span>
                
                <!-- Layout dropdown selector -->
                <div class="flex items-center gap-2">
                    <label for="template-selector" class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Choose Style:</label>
                    <select id="template-selector" onchange="switchTemplate(this.value)" 
                            class="px-4 py-2 rounded-xl bg-slate-850 border border-slate-750 text-white text-xs font-bold focus:outline-none focus:border-blue-500">
                        <option value="modern-professional" {{ $templateSlug === 'modern-professional' ? 'selected' : '' }}>Modern Professional (ATS)</option>
                        <option value="minimal-clean" {{ $templateSlug === 'minimal-clean' ? 'selected' : '' }}>Minimal Clean (ATS)</option>
                        <option value="creative-bold" {{ $templateSlug === 'creative-bold' ? 'selected' : '' }}>Creative Bold (MARKETING)</option>
                        <option value="technical-dev" {{ $templateSlug === 'technical-dev' ? 'selected' : '' }}>Technical Dev (MONO/TECH)</option>
                        <option value="corporate-executive" {{ $templateSlug === 'corporate-executive' ? 'selected' : '' }}>Corporate Executive (SERIF)</option>
                        <option value="gradient-modern" {{ $templateSlug === 'gradient-modern' ? 'selected' : '' }}>Gradient Modern (CREATIVE)</option>
                    </select>
                </div>
            </div>

            <!-- Export Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('resume.score', $resume) }}" class="px-5 py-2.5 bg-slate-850 hover:bg-slate-800 text-slate-200 border border-slate-750 text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-sm">
                    📈 Check AI ATS Score
                </a>
                <a href="{{ route('resume.export-pdf', $resume) }}" class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:opacity-95 text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5 shadow-lg shadow-emerald-500/10">
                    Export Professional PDF
                </a>
                <button onclick="window.print()" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-750 text-slate-300 text-xs font-bold rounded-xl transition flex items-center gap-1.5">
                    Print / Save local
                </button>
            </div>
        </div>

        <!-- Resume Page Frame -->
        <div class="max-w-4xl mx-auto shadow-2xl relative">
            <!-- Dynamic Include matching templates/resume/ -->
            @php
                $templatePath = "templates.resume.{$templateSlug}";
            @endphp
            
            @if(view()->exists($templatePath))
                @include($templatePath, [
                    'resume' => $resume,
                    'data' => $data,
                    'isPdf' => false
                ])
            @else
                <!-- Basic Fallback Preview -->
                <div class="p-12 text-slate-800 font-sans max-w-4xl mx-auto bg-white rounded-2xl">
                    <h1 class="text-4xl font-extrabold text-slate-900">{{ $data['personalInfo']['fullName'] ?? 'Your Name' }}</h1>
                    <p class="text-slate-500 mt-2">{{ $data['personalInfo']['email'] ?? '' }} | {{ $data['personalInfo']['phone'] ?? '' }}</p>
                    <p class="text-slate-650 leading-relaxed mt-4">{{ $data['summary'] ?? '' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function switchTemplate(slug) {
    // Save template selection asynchronously or redirect to custom templates route
    fetch(`/resume/{{ $resume->id }}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            title: "{{ addslashes($resume->title) }}",
            template_slug: slug,
            // send existing content unchanged
            content: JSON.stringify(@json($resume->content))
        })
    }).then(() => {
        window.location.href = `/resume/{{ $resume->id }}/preview/${slug}`;
    });
}
</script>
@endsection
