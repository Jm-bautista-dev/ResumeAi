<div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 border border-purple-100 p-8 md:p-12 rounded-3xl relative overflow-hidden shadow-xl text-slate-800">
    <div class="absolute top-0 right-0 w-64 h-64 bg-purple-300/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-pink-300/20 rounded-full blur-3xl -z-10"></div>
    
    @if ($sections['hero']['enabled'] ?? true)
        <header class="py-16 text-left relative z-10">
            <div class="inline-block px-3 py-1 bg-rose-100 text-rose-600 rounded-full text-xs font-semibold uppercase tracking-wider mb-6">
                ✨ Creative Mind
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 uppercase text-slate-900 leading-none">
                Hello. I'm <br>
                <span class="bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 bg-clip-text text-transparent">
                    {{ $fullName }}
                </span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mt-6 leading-relaxed font-light">
                {{ $bio }}
            </p>
        </header>
    @endif

    @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
        <section class="mb-16">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-8 tracking-tight uppercase flex items-center gap-2">
                📂 Selected Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($projectsList as $proj)
                    <div class="bg-white/80 backdrop-blur-md border border-purple-100/50 p-8 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">{{ $proj['title'] ?? '' }}</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 font-light">{{ $proj['description'] ?? '' }}</p>
                        @if ($proj['link'] ?? '')
                            <a href="{{ $proj['link'] }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-500 hover:text-rose-600 transition">
                                Explore Live Project &rarr;
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
        <section class="mb-16 border-t border-purple-100/50 pt-12">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-6 uppercase">My Toolkit</h2>
            <div class="flex flex-wrap gap-2.5">
                @foreach ($skills as $skill)
                    <span class="px-5 py-2.5 bg-white border border-purple-100/40 text-slate-700 rounded-xl text-sm font-semibold hover:border-pink-400 hover:shadow-md transition duration-200">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($sections['contact']['enabled'] ?? true)
        <section class="border-t border-purple-100/50 pt-12">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-8 uppercase">Let's Collaborate</h2>
            <form class="space-y-4 max-w-xl">
                <input type="text" placeholder="Your Name" class="w-full px-5 py-3.5 bg-white/90 border border-purple-100 rounded-2xl text-slate-900 focus:outline-none focus:border-rose-500 placeholder-slate-400 text-sm transition">
                <input type="email" placeholder="Your Email" class="w-full px-5 py-3.5 bg-white/90 border border-purple-100 rounded-2xl text-slate-900 focus:outline-none focus:border-rose-500 placeholder-slate-400 text-sm transition">
                <textarea placeholder="Tell me about your amazing project ideas..." rows="4" class="w-full px-5 py-3.5 bg-white/90 border border-purple-100 rounded-2xl text-slate-900 focus:outline-none focus:border-rose-500 placeholder-slate-400 text-sm transition"></textarea>
                <button type="button" class="w-full py-4 bg-gradient-to-r from-rose-500 via-pink-500 to-purple-600 text-white font-bold rounded-2xl hover:opacity-95 active:scale-[0.99] transition shadow-lg shadow-rose-500/20">
                    Send Message 💌
                </button>
            </form>
        </section>
    @endif
</div>
