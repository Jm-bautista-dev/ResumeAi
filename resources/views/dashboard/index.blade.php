@extends('layouts.app')

@section('title', 'AI Career Console - Dashboard')

@section('content')
<div class="min-h-screen bg-slate-950 text-slate-100 py-12 px-6">
    <div class="max-w-7xl mx-auto space-y-10">
        
        <!-- Welcome banner -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-900 pb-8">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight bg-gradient-to-r from-blue-400 via-indigo-400 to-rose-400 bg-clip-text text-transparent">
                    Console.dashboard()
                </h1>
                <p class="text-slate-400 text-sm mt-2 font-light">
                    Welcome back, <span class="text-white font-semibold">{{ auth()->user()->name }}</span>. Optimize your career assets with next-generation AI metrics.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('resume.import') }}" class="px-5 py-3 bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 text-sm font-bold rounded-2xl transition flex items-center gap-2">
                    <span>📥</span> Import Resume
                </a>
                <a href="{{ route('resume.templates') }}" class="px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:opacity-95 active:scale-[0.98] transition shadow-lg shadow-blue-500/10 flex items-center gap-2">
                    <span>✨</span> Create Resume
                </a>
            </div>
        </div>

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- 1. Total Resumes -->
            <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl hover:border-slate-800/80 transition flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-450 uppercase tracking-widest">Active Resumes</p>
                    <p class="text-3xl font-black text-white group-hover:text-blue-400 transition">{{ $stats['totalResumes'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-300">
                    📄
                </div>
            </div>

            <!-- 2. Portfolios -->
            <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl hover:border-slate-800/80 transition flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-450 uppercase tracking-widest">Live Sites</p>
                    <p class="text-3xl font-black text-white group-hover:text-indigo-400 transition">{{ $stats['totalPortfolios'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-300">
                    🌐
                </div>
            </div>

            <!-- 3. AI Score Average -->
            @php
                $averageScore = round($resumes->avg('ai_score') ?? 0);
            @endphp
            <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl hover:border-slate-800/80 transition flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-450 uppercase tracking-widest">Avg ATS Score</p>
                    <p class="text-3xl font-black text-white group-hover:text-purple-400 transition">
                        {{ $averageScore > 0 ? $averageScore . '%' : 'N/A' }}
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-400 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-300">
                    🎯
                </div>
            </div>

            <!-- 4. Exports -->
            <div class="bg-slate-900/40 border border-slate-850 p-6 rounded-3xl hover:border-slate-800/80 transition flex items-center justify-between group">
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-450 uppercase tracking-widest">Total Downloads</p>
                    <p class="text-3xl font-black text-white group-hover:text-rose-400 transition">{{ $stats['exports'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition duration-300">
                    💾
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Panel (Recent Resumes List) -->
            <div class="lg:col-span-8 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <span>📄</span> Recent Resumes
                    </h2>
                </div>

                @if ($resumes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($resumes as $resume)
                            <div class="bg-slate-900/30 border border-slate-850 p-6 rounded-3xl space-y-5 hover:border-slate-800 transition duration-300 flex flex-col justify-between group">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-white text-lg group-hover:text-blue-400 transition">{{ $resume->title }}</h3>
                                        @if($resume->ai_score)
                                            <span class="px-2.5 py-0.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold rounded-full uppercase tracking-wider font-mono">
                                                ★ {{ $resume->ai_score }} Score
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 font-light">Last revised {{ $resume->updated_at->diffForHumans() }} // v{{ $resume->version }}</p>
                                </div>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('resume.edit', $resume) }}" class="flex-1 py-2.5 text-center bg-slate-850 hover:bg-blue-600 text-white rounded-xl text-xs font-bold transition shadow-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('resume.score', $resume) }}" class="px-3.5 py-2.5 bg-slate-900 border border-slate-800 text-slate-300 rounded-xl text-xs font-bold hover:border-indigo-500 hover:text-white transition">
                                        📈 Score
                                    </a>
                                    <a href="{{ route('resume.preview', $resume) }}" class="px-3.5 py-2.5 bg-slate-900 border border-slate-800 text-slate-350 rounded-xl text-xs font-bold hover:border-slate-700 hover:text-white transition">
                                        Preview
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-slate-900/10 border border-dashed border-slate-850 rounded-3xl p-8 space-y-4">
                        <span class="text-4xl">📄</span>
                        <h3 class="text-lg font-bold text-white">No resumes created yet</h3>
                        <p class="text-slate-400 text-sm font-light">Get started by selecting an AI-powered template gallery design.</p>
                        <a href="{{ route('resume.templates') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition inline-block">
                            Select Template Gallery &rarr;
                        </a>
                    </div>
                @endif
            </div>

            <!-- Right Panel (Portfolios List) -->
            <div class="lg:col-span-4 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <span>🌐</span> Active Portfolios
                    </h2>
                </div>

                @if ($portfolios->count() > 0)
                    <div class="space-y-4">
                        @foreach ($portfolios as $portfolio)
                            <div class="bg-slate-900/30 border border-slate-850 p-5 rounded-2xl flex items-center justify-between hover:border-slate-800 transition">
                                <div>
                                    <h4 class="font-bold text-white text-sm">{{ $portfolio->title }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase font-semibold font-mono">{{ $portfolio->template->name }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('portfolio.edit', $portfolio) }}" class="px-3 py-1.5 bg-slate-850 hover:bg-slate-800 text-slate-200 text-xs font-semibold rounded-lg transition border border-slate-750">Edit</a>
                                    <a href="{{ route('portfolio.preview', $portfolio) }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-slate-900/10 border border-dashed border-slate-850 rounded-2xl p-6 space-y-3">
                        <span class="text-3xl">🌐</span>
                        <h4 class="font-bold text-white text-sm">No live portfolio websites</h4>
                        <p class="text-slate-400 text-xs font-light">Instantly convert your resume details into a static static website.</p>
                        <a href="{{ route('portfolio.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition inline-block">
                            Generate Site
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
