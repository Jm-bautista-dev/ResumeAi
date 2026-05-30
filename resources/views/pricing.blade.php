@extends('layouts.app')

@section('title', 'Pricing - Resume AI Builder')

@section('content')
<div class="py-20 bg-slate-950 text-white min-h-[85vh] relative overflow-hidden">
    <!-- Glowing background nodes -->
    <div class="absolute top-10 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-down">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
                Simple, Transparent Pricing
            </h1>
            <p class="text-xl text-slate-400 max-w-2xl mx-auto">
                Unlock professional templates, AI features, and custom deployments. Choose the plan that fits your career goals.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="bg-slate-900/40 border border-slate-800 backdrop-blur-md rounded-2xl p-8 hover:border-slate-700 transition flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-2">Free</h3>
                    <p class="text-slate-400 text-sm mb-6">Perfect for starting out</p>
                    <div class="text-4xl font-extrabold mb-6">$0<span class="text-base font-normal text-slate-500">/month</span></div>
                    
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            1 Basic Resume
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Standard PDF Export
                        </li>
                        <li class="flex items-center gap-2 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            AI Assist Features
                        </li>
                        <li class="flex items-center gap-2 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Portfolio Generation & Export
                        </li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="block text-center py-3 bg-slate-800 hover:bg-slate-700 font-semibold rounded-xl transition text-white">
                    Get Started
                </a>
            </div>

            <!-- Pro Plan (Popular) -->
            <div class="relative bg-slate-900/60 border-2 border-purple-500/80 backdrop-blur-md rounded-2xl p-8 shadow-2xl shadow-purple-500/10 flex flex-col justify-between transform -translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-xs font-bold uppercase tracking-wider px-4 py-1.5 rounded-full">
                    Most Popular
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-2">Pro</h3>
                    <p class="text-slate-400 text-sm mb-6">For active job seekers</p>
                    <div class="text-4xl font-extrabold mb-6">$12<span class="text-base font-normal text-slate-500">/month</span></div>
                    
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Unlimited Resumes & Versions
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Premium PDF Templates
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            AI Assist (100 prompts / month)
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Portfolio Website Generator
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Export Portfolio as ZIP
                        </li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="block text-center py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 font-semibold rounded-xl transition text-white shadow-lg shadow-purple-500/20">
                    Upgrade to Pro
                </a>
            </div>

            <!-- Enterprise Plan -->
            <div class="bg-slate-900/40 border border-slate-800 backdrop-blur-md rounded-2xl p-8 hover:border-slate-700 transition flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <h3 class="text-2xl font-bold text-slate-100 mb-2">Enterprise</h3>
                    <p class="text-slate-400 text-sm mb-6">For teams and schools</p>
                    <div class="text-4xl font-extrabold mb-6">$49<span class="text-base font-normal text-slate-500">/month</span></div>
                    
                    <ul class="space-y-4 mb-8 text-slate-300">
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Everything in Pro plan
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Unlimited AI Prompts
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            GitHub Pages Auto Deploy
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Custom Domain Support
                        </li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="block text-center py-3 bg-slate-800 hover:bg-slate-700 font-semibold rounded-xl transition text-white">
                    Contact Sales
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
