@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>

        <div class="relative px-6 py-32 mx-auto max-w-7xl">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                    Create Your
                    <span class="bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                        Perfect Resume
                    </span>
                </h1>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    AI-powered resume builder and portfolio generator. Create stunning portfolios, optimize for ATS, and land your dream job.
                </p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-purple-500/50 transition">
                        Get Started Free
                    </a>
                    <a href="{{ route('features') }}" class="px-8 py-3 border border-purple-400 text-white font-semibold rounded-lg hover:bg-purple-900/20 transition">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Preview -->
    <div class="px-6 py-20 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group p-6 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 transition backdrop-blur-xl">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-400 to-purple-500 mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Smart Resume Builder</h3>
                <p class="text-gray-400">Drag-and-drop editor with live preview and multiple templates</p>
            </div>

            <div class="group p-6 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 transition backdrop-blur-xl">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-400 to-blue-500 mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.5 1.5H5.75A2.25 2.25 0 003.5 3.75v12.5A2.25 2.25 0 005.75 18.5h8.5a2.25 2.25 0 002.25-2.25V9m-9-7.5v3.75a1.5 1.5 0 001.5 1.5h3.75m-5.25 10.5h3m0 0h2.25"></path>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-2">Portfolio Generator</h3>
                <p class="text-gray-400">Auto-generate beautiful portfolio websites from your resume</p>
            </div>

            <div class="group p-6 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 transition backdrop-blur-xl">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-pink-400 to-red-500 mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM15.657 14.243a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM11 17a1 1 0 102 0v-1a1 1 0 10-2 0v1zM5.757 15.657a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zM5.757 4.343a1 1 0 01-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zM10 5.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z"></path>
                    </svg>
                </div>
                <h3 class="text-white font-semibold mb-2">AI-Powered Enhancement</h3>
                <p class="text-gray-400">Optimize your resume with AI assistance and ATS alignment</p>
            </div>
        </div>
    </div>
</div>
@endsection
