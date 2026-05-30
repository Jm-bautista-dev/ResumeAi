<div class="border border-slate-800 p-8 rounded-2xl bg-black relative overflow-hidden accent-glow">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 via-indigo-500 to-rose-500"></div>
    
    @if ($sections['hero']['enabled'] ?? true)
        <header class="text-center py-16 border-b border-slate-900 mb-12">
            <div class="inline-block px-3 py-1 border border-emerald-500/30 text-emerald-400 text-[10px] uppercase tracking-widest font-mono mb-6 rounded bg-emerald-500/5">
                // SYSTEM STABLE: DEPLOYED_SUCCESSFULLY
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 uppercase">
                <span class="bg-gradient-to-r from-emerald-400 via-teal-400 to-indigo-500 bg-clip-text text-transparent" style="text-shadow: 0 0 30px rgba(16,185,129,0.1)">
                    {{ $fullName }}
                </span>
            </h1>
            <p class="text-base md:text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed border-l-2 border-emerald-500 pl-4 text-left font-mono">
                {{ $bio }}
            </p>
        </header>
    @endif

    @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
        <section class="mb-16">
            <h2 class="text-2xl font-bold uppercase tracking-wider text-emerald-400 font-mono mb-8 flex items-center gap-2">
                <span>&gt;_</span> featured_repositories
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($projectsList as $proj)
                    <div class="border border-slate-900 bg-slate-950 p-6 rounded-xl hover:border-emerald-500/40 hover:shadow-lg hover:shadow-emerald-950/20 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-bold text-white font-mono">{{ $proj['title'] ?? 'project' }}</h3>
                            @if ($proj['link'] ?? '')
                                <a href="{{ $proj['link'] }}" target="_blank" class="text-xs text-indigo-400 hover:underline font-mono">LINK &rarr;</a>
                            @endif
                        </div>
                        <p class="text-slate-400 text-sm font-mono leading-relaxed">{{ $proj['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
        <section class="mb-16 border-t border-slate-900 pt-12">
            <h2 class="text-2xl font-bold uppercase tracking-wider text-emerald-400 font-mono mb-6">
                // core_technology_stack
            </h2>
            <div class="flex flex-wrap gap-2.5">
                @foreach ($skills as $skill)
                    <span class="px-4 py-2 border border-slate-800 bg-slate-950 text-slate-300 rounded-lg font-mono text-xs uppercase hover:bg-emerald-950/20 hover:text-emerald-400 hover:border-emerald-800/50 transition duration-200">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($sections['contact']['enabled'] ?? true)
        <section class="border-t border-slate-900 pt-12">
            <h2 class="text-2xl font-bold uppercase tracking-wider text-emerald-400 font-mono mb-8">
                // establish_connection
            </h2>
            <form class="space-y-4 max-w-xl font-mono">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" placeholder="visitor_name" class="w-full px-4 py-3 bg-slate-950 border border-slate-900 rounded-xl text-emerald-400 focus:outline-none focus:border-emerald-500 placeholder-slate-700 text-sm">
                    <input type="email" placeholder="visitor_email" class="w-full px-4 py-3 bg-slate-950 border border-slate-900 rounded-xl text-emerald-400 focus:outline-none focus:border-emerald-500 placeholder-slate-700 text-sm">
                </div>
                <textarea placeholder="connection_payload_details" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-900 rounded-xl text-emerald-400 focus:outline-none focus:border-emerald-500 placeholder-slate-700 text-sm"></textarea>
                <button type="button" class="w-full py-3 bg-gradient-to-r from-emerald-500 to-indigo-600 text-black font-bold uppercase tracking-wider rounded-xl transition hover:opacity-90 active:scale-[0.98]">
                    transmit_payload()
                </button>
            </form>
        </section>
    @endif
</div>
