@extends('layouts.app')

@section('title', 'Create Portfolio')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-900 dark:to-gray-900">
    <div class="px-4 py-8 mx-auto max-w-4xl">
        <div class="mb-8">
            <a href="{{ route('portfolio.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline mb-4 inline-block">← Back</a>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Create New Portfolio</h1>
        </div>

        <form action="{{ route('portfolio.store') }}" method="POST" class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 p-8">
            @csrf

            <div class="mb-8">
                <label for="title" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Portfolio Title</label>
                <input type="text" id="title" name="title" placeholder="e.g., My Web Development Portfolio" required class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20">
                @error('title')
                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="resume_id" class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">Select Resume</label>
                <select id="resume_id" name="resume_id" required class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-20">
                    <option value="">Choose a resume...</option>
                    @foreach ($resumes as $resume)
                        <option value="{{ $resume->id }}">{{ $resume->title }}</option>
                    @endforeach
                </select>
                @error('resume_id')
                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8" x-data="{ selectedTemplate: {{ $templates->first()->id ?? 0 }} }">
                <label for="template_id" class="block text-sm font-semibold text-slate-300 mb-2">Choose Template</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($templates as $template)
                        <label class="cursor-pointer">
                            <input type="radio" name="template_id" value="{{ $template->id }}" required class="sr-only" x-model="selectedTemplate">
                            <div class="p-4 border-2 rounded-xl transition" 
                                 :class="selectedTemplate == {{ $template->id }} ? 'border-purple-500 bg-purple-500/10' : 'border-slate-800 bg-slate-900/40 hover:border-slate-700'">
                                <div class="w-full h-24 bg-gradient-to-br from-purple-900/50 to-slate-900/50 rounded-lg mb-3 flex items-center justify-center text-xs text-slate-500 uppercase tracking-widest font-bold">
                                    {{ $template->slug }}
                                </div>
                                <p class="font-semibold text-slate-200 text-sm">{{ $template->name }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $template->description }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('template_id')
                    <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                    Create Portfolio
                </button>
                <a href="{{ route('portfolio.index') }}" class="flex-1 px-6 py-3 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-slate-700 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
