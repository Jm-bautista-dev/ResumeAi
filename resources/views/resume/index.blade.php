@extends('layouts.app')

@section('title', 'My Resumes')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-900 dark:to-gray-900">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">My Resumes</h1>
            <a href="{{ route('resume.create') }}" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:shadow-lg transition">
                Create Resume
            </a>
        </div>

        @if ($resumes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($resumes as $resume)
                    <div class="group bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-gray-200 dark:border-slate-700 hover:shadow-md transition overflow-hidden">
                        <div class="h-32 bg-gradient-to-br from-blue-400 to-purple-500 group-hover:shadow-lg transition"></div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $resume->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Updated {{ $resume->updated_at->diffForHumans() }}</p>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('resume.edit', $resume) }}" class="px-3 py-2 text-center bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded text-sm hover:bg-blue-200 transition">Edit</a>
                                <a href="{{ route('resume.preview', $resume) }}" class="px-3 py-2 text-center bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded text-sm hover:bg-purple-200 transition">Preview</a>
                                <a href="{{ route('resume.export-pdf', $resume) }}" class="px-3 py-2 text-center bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded text-sm hover:bg-green-200 transition">Export</a>
                                <form action="{{ route('resume.destroy', $resume) }}" method="POST" class="contents">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this resume?')" class="px-3 py-2 text-center bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 rounded text-sm hover:bg-red-200 transition">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($resumes->hasPages())
                <div class="mt-8">
                    {{ $resumes->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-700">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Resumes Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Start building your first resume today</p>
                <a href="{{ route('resume.create') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Create Your First Resume
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
