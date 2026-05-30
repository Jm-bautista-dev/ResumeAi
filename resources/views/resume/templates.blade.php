@extends('layouts.app')

@section('title', 'Choose a Template - Resume Builder')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-100 py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight bg-gradient-to-r from-blue-400 via-indigo-400 to-rose-400 bg-clip-text text-transparent">
                Select Your AI-Ready Template
            </h1>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto mt-4 font-light">
                Choose from professionally designed layouts optimized for ATS software, refined by career experts, and powered by AI insights.
            </p>
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('resume.import') }}" class="px-6 py-3 bg-slate-900 border border-slate-800 text-slate-200 font-semibold rounded-2xl hover:border-blue-500 hover:text-white transition flex items-center gap-2 shadow-lg">
                    <span>📥</span> Import Existing Resume (PDF/TXT)
                </a>
            </div>
        </div>

        <!-- Template Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($templates as $tpl)
                @php
                    $meta = is_string($tpl->meta) ? json_decode($tpl->meta, true) : $tpl->meta;
                @endphp
                <div class="bg-slate-900/40 border border-slate-800/80 rounded-3xl p-6 hover:border-blue-500/60 hover:shadow-2xl hover:shadow-blue-500/5 transition duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Thumbnail Preview Simulated Graphic -->
                        <div class="aspect-[4/3] rounded-2xl mb-6 relative overflow-hidden flex flex-col justify-between p-4 border border-slate-800"
                             style="background-color: {{ $meta['secondary_color'] ?? '#0F172A' }}">
                            <div class="w-1/2 h-4 rounded-full bg-slate-700/50"></div>
                            <div class="space-y-2 mt-4">
                                <div class="w-full h-2 rounded bg-slate-700/30"></div>
                                <div class="w-5/6 h-2 rounded bg-slate-700/30"></div>
                                <div class="w-4/5 h-2 rounded bg-slate-700/30"></div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <div class="w-8 h-8 rounded-full" style="background-color: {{ $tpl->thumbnail_color }}"></div>
                                <div class="w-20 h-3 rounded bg-slate-700/40"></div>
                            </div>
                            <!-- Dynamic Overlay on Hover -->
                            <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center p-4">
                                <button onclick="openCreateModal({{ $tpl->id }}, '{{ addslashes($tpl->name) }}', '{{ $tpl->slug }}')"
                                        class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition shadow-lg shadow-blue-500/30">
                                    Use This Template
                                </button>
                            </div>
                        </div>

                        <!-- Info details -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs px-2.5 py-1 bg-slate-800 rounded-full text-slate-300 uppercase tracking-widest font-mono">
                                {{ $tpl->category }}
                            </span>
                            @if ($tpl->is_ats_friendly)
                                <span class="text-[10px] px-2 py-0.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-full font-bold uppercase">
                                    ✓ ATS Friendly
                                </span>
                            @else
                                <span class="text-[10px] px-2 py-0.5 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-full font-bold uppercase">
                                    ★ Creative Layout
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition">
                            {{ $tpl->name }}
                        </h3>
                        <p class="text-slate-400 text-sm font-light leading-relaxed mb-6">
                            {{ $tpl->description }}
                        </p>
                    </div>

                    <button onclick="openCreateModal({{ $tpl->id }}, '{{ addslashes($tpl->name) }}', '{{ $tpl->slug }}')"
                            class="w-full py-3 bg-slate-850 hover:bg-blue-600 text-white font-bold rounded-2xl transition flex items-center justify-center gap-2 group-hover:bg-blue-600 group-hover:shadow-lg group-hover:shadow-blue-500/20">
                        Create with Template &rarr;
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Creative Modal -->
<div id="create-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-950/80 backdrop-blur-md p-6">
    <div class="bg-slate-900 border border-slate-850 rounded-3xl p-8 max-w-md w-full shadow-2xl relative">
        <button onclick="closeCreateModal()" class="absolute top-5 right-5 text-slate-450 hover:text-white text-2xl transition">
            &times;
        </button>
        <h2 class="text-2xl font-bold text-white mb-2">Create New Resume</h2>
        <p class="text-slate-400 text-sm mb-6 font-light">
            You have selected <span id="modal-template-name" class="text-blue-400 font-semibold"></span>.
        </p>

        <form id="create-form" action="{{ route('resume.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" id="modal-template-id" name="template_id">
            <input type="hidden" id="modal-template-slug" name="template_slug">

            <div>
                <label for="title" class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Resume Title</label>
                <input type="text" id="title" name="title" required placeholder="e.g. Software Engineer Resume"
                       class="w-full px-4 py-3 bg-slate-800/40 border border-slate-700 text-white rounded-2xl focus:outline-none focus:border-blue-500 placeholder-slate-600 text-sm">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition shadow-lg shadow-blue-500/20">
                    Get Started &rarr;
                </button>
                <button type="button" onclick="closeCreateModal()" class="flex-1 py-3.5 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold rounded-2xl transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal(templateId, templateName, templateSlug) {
    document.getElementById('modal-template-name').textContent = templateName;
    document.getElementById('modal-template-id').value = templateId;
    document.getElementById('modal-template-slug').value = templateSlug;
    document.getElementById('create-modal').classList.remove('hidden');
    document.getElementById('title').focus();
}

function closeCreateModal() {
    document.getElementById('create-modal').classList.add('hidden');
}
</script>
@endsection
