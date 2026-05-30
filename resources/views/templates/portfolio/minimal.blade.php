<div class="bg-white text-zinc-900 p-8 md:p-12 border border-zinc-200 rounded-lg max-w-4xl mx-auto shadow-sm">
    @if ($sections['hero']['enabled'] ?? true)
        <header class="pb-8 border-b border-zinc-200 mb-8">
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-3">{{ $fullName }}</h1>
            <p class="text-zinc-600 leading-relaxed text-sm md:text-base font-normal">
                {{ $bio }}
            </p>
        </header>
    @endif

    @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
        <section class="mb-10">
            <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Projects</h2>
            <div class="space-y-6">
                @foreach ($projectsList as $proj)
                    <div>
                        <h3 class="font-bold text-zinc-900 text-sm flex items-center gap-2">
                            <span>&bull;</span> {{ $proj['title'] ?? '' }}
                            @if ($proj['link'] ?? '')
                                <a href="{{ $proj['link'] }}" target="_blank" class="text-xs text-zinc-400 hover:text-zinc-900 transition underline font-normal">Link ↗</a>
                            @endif
                        </h3>
                        <p class="text-zinc-600 text-xs mt-1.5 leading-relaxed font-light">{{ $proj['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
        <section class="mb-10 border-t border-zinc-200 pt-8">
            <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-3">Skills</h2>
            <div class="flex flex-wrap gap-x-4 gap-y-1.5 text-zinc-700 text-xs font-medium">
                @foreach ($skills as $skill)
                    <span>&bull; {{ $skill }}</span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($sections['contact']['enabled'] ?? true)
        <section class="border-t border-zinc-200 pt-8">
            <h2 class="text-xs font-bold text-zinc-400 uppercase tracking-widest mb-4">Contact</h2>
            <form class="space-y-3.5 max-w-lg">
                <input type="text" placeholder="Name" class="w-full px-3.5 py-2.5 border border-zinc-200 rounded text-zinc-900 focus:outline-none focus:border-zinc-900 placeholder-zinc-300 text-xs transition">
                <input type="email" placeholder="Email" class="w-full px-3.5 py-2.5 border border-zinc-200 rounded text-zinc-900 focus:outline-none focus:border-zinc-900 placeholder-zinc-300 text-xs transition">
                <textarea placeholder="Message..." rows="4" class="w-full px-3.5 py-2.5 border border-zinc-200 rounded text-zinc-900 focus:outline-none focus:border-zinc-900 placeholder-zinc-300 text-xs transition"></textarea>
                <button type="button" class="px-4 py-2 bg-zinc-900 text-white font-semibold rounded text-xs transition hover:bg-zinc-800 active:scale-[0.98]">
                    Send
                </button>
            </form>
        </section>
    @endif
</div>
