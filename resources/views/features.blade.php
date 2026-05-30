@extends('layouts.app')

@section('title', 'Features - Resume AI Builder')

@section('content')
<div class="py-20 bg-slate-950 text-white min-h-[85vh] relative overflow-hidden">
    <!-- Glowing background nodes -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                Engineered for Career Growth
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                Explore the advanced features that make building resumes, generating portfolios, and landing jobs extremely easy.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            <!-- Feature 1 -->
            <div class="bg-slate-900/50 border border-slate-800 backdrop-blur-md p-8 rounded-2xl" data-aos="fade-right">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-slate-100">AI-Powered Content Generation</h3>
                <p class="text-slate-400 leading-relaxed">
                    Instantly generate professional, tailored summaries and optimize experience bullet points. Our AI integrates directly with OpenAI and Groq APIs to write polished ATS-ready content.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-slate-900/50 border border-slate-800 backdrop-blur-md p-8 rounded-2xl" data-aos="fade-left">
                <div class="w-12 h-12 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-slate-100">Dynamic Portfolio Websites</h3>
                <p class="text-slate-400 leading-relaxed">
                    Convert your resume details into a gorgeous portfolio site with one click. Select from custom designs like Cyberpunk Neon or Modern Minimal, adjust color themes, and instantly preview it live.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-slate-900/50 border border-slate-800 backdrop-blur-md p-8 rounded-2xl" data-aos="fade-right">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-slate-100">Export PDF & Static Builds</h3>
                <p class="text-slate-400 leading-relaxed">
                    Export high-fidelity resumes as standard, clean PDFs. You can also package your portfolio website as a standalone, lightweight ZIP file containing static HTML, CSS, and JS ready to upload anywhere.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-slate-900/50 border border-slate-800 backdrop-blur-md p-8 rounded-2xl" data-aos="fade-left">
                <div class="w-12 h-12 rounded-xl bg-pink-500/20 text-pink-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-slate-100">Fully Secure & Localized</h3>
                <p class="text-slate-400 leading-relaxed">
                    We secure your data with Laravel Sanctum and Fortify security checks. No unauthenticated requests can inspect your personal information, and your generated files are served privately.
                </p>
            </div>
        </div>

        <div class="text-center" data-aos="zoom-in">
            <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 font-semibold rounded-xl transition text-white shadow-xl shadow-purple-500/10">
                Create Your Account Now
            </a>
        </div>
    </div>
</div>
@endsection
