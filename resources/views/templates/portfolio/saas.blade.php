<div class="bg-slate-900 border border-slate-800 p-8 md:p-12 rounded-3xl relative overflow-hidden text-slate-100 shadow-2xl">
    <div class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-indigo-500/10 via-purple-500/5 to-transparent -z-10"></div>
    
    @if ($sections['hero']['enabled'] ?? true)
        <header class="py-16 text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 border border-indigo-500/30 text-indigo-400 text-xs font-semibold rounded-full bg-indigo-950/20 mb-6">
                🚀 SaaS & Product Developer
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Building products that <br>
                <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-rose-400 bg-clip-text text-transparent">
                    solve real problems.
                </span>
            </h1>
            <p class="text-base md:text-lg text-slate-400 leading-relaxed font-light mb-8">
                {{ $bio }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <button type="button" onclick="document.querySelector('#portfolio-contact-sec').scrollIntoView({ behavior: 'smooth' })" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition duration-200 shadow-lg shadow-indigo-500/20 active:scale-[0.98]">
                    Get in touch
                </button>
            </div>
        </header>
    @endif

    @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
        <section class="mb-16 border-t border-slate-800/80 pt-12">
            <div class="text-center max-w-lg mx-auto mb-10">
                <h2 class="text-2xl font-bold uppercase tracking-widest text-indigo-400 text-xs mb-2">Portfolio</h2>
                <h3 class="text-3xl font-extrabold text-white">Shipped Products</h3>
                <p class="text-slate-400 text-sm mt-2 font-light">Explore the features and case studies of modern apps I have crafted.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($projectsList as $proj)
                    <div class="bg-slate-950 border border-slate-800/60 p-6 rounded-2xl hover:border-indigo-500/40 hover:-translate-y-1 transition duration-300">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="text-lg font-bold text-white">{{ $proj['title'] ?? '' }}</h4>
                            @if ($proj['link'] ?? '')
                                <a href="{{ $proj['link'] }}" target="_blank" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 hover:underline">Launch ↗</a>
                            @endif
                        </div>
                        <p class="text-slate-400 text-xs leading-relaxed font-light">{{ $proj['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
        <section class="mb-16 border-t border-slate-800/80 pt-12 text-center">
            <h2 class="text-2xl font-bold uppercase tracking-widest text-indigo-400 text-xs mb-4">Core Skillset</h2>
            <div class="flex flex-wrap justify-center gap-2 max-w-2xl mx-auto">
                @foreach ($skills as $skill)
                    <span class="px-3.5 py-2 bg-slate-950 border border-slate-800/60 text-slate-300 hover:border-indigo-500/30 rounded-xl text-xs font-semibold hover:-translate-y-0.5 hover:shadow transition duration-200">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($sections['contact']['enabled'] ?? true)
        <section id="portfolio-contact-sec" class="border-t border-slate-800/80 pt-12">
            <div class="text-center max-w-lg mx-auto mb-8">
                <h2 class="text-2xl font-bold uppercase tracking-widest text-indigo-400 text-xs mb-2">Connect</h2>
                <h3 class="text-3xl font-extrabold text-white">Start a Project</h3>
            </div>
            <form class="space-y-4 max-w-xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" placeholder="Name" class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-xl text-white focus:outline-none focus:border-indigo-500 placeholder-slate-600 text-sm transition">
                    <input type="email" placeholder="Email" class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-xl text-white focus:outline-none focus:border-indigo-500 placeholder-slate-600 text-sm transition">
                </div>
                <textarea placeholder="Tell me about your product requirements..." rows="4" class="w-full px-4 py-3.5 bg-slate-950 border border-slate-800 rounded-xl text-white focus:outline-none focus:border-indigo-500 placeholder-slate-600 text-sm transition"></textarea>
                <button type="button" class="w-full py-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-rose-500 text-white font-bold rounded-xl hover:opacity-95 active:scale-[0.99] transition shadow-lg shadow-indigo-500/10">
                    Submit Proposal
                </button>
            </form>
        </section>
    @endif
</div>
