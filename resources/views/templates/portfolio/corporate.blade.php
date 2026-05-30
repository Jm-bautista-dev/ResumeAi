<div class="bg-stone-50 border border-stone-200/60 p-8 md:p-12 rounded-2xl shadow-lg text-stone-850">
    @if ($sections['hero']['enabled'] ?? true)
        <header class="pb-12 border-b border-stone-200 mb-12 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-stone-900 mb-4" style="color: {{ $primaryColor }}">
                {{ $fullName }}
            </h1>
            <p class="text-lg md:text-xl text-stone-600 max-w-3xl leading-relaxed italic font-light">
                "{{ $bio }}"
            </p>
            <div class="flex flex-wrap gap-4 text-stone-500 text-xs md:text-sm mt-6 font-medium justify-center md:justify-start">
                @if ($email) <span>✉ {{ $email }}</span> @endif
                @if ($phone) <span>📞 {{ $phone }}</span> @endif
                @if ($location) <span>📍 {{ $location }}</span> @endif
            </div>
        </header>
    @endif

    @if (($sections['projects']['enabled'] ?? true) && count($projectsList) > 0)
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-stone-900 mb-6 border-l-4 border-stone-850 pl-3">Executive Initiatives</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($projectsList as $proj)
                    <div class="border border-stone-200 p-6 rounded-xl bg-white hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-stone-900 text-lg">{{ $proj['title'] ?? '' }}</h3>
                            @if ($proj['link'] ?? '')
                                <a href="{{ $proj['link'] }}" target="_blank" class="text-xs font-semibold hover:underline" style="color: {{ $primaryColor }}">Link ↗</a>
                            @endif
                        </div>
                        <p class="text-stone-600 text-sm leading-relaxed font-light">{{ $proj['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if (($sections['skills']['enabled'] ?? true) && count($skills) > 0)
        <section class="mb-12 border-t border-stone-200 pt-10">
            <h2 class="text-2xl font-bold text-stone-900 mb-5">Core Capabilities</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($skills as $skill)
                    <span class="px-4 py-2 border border-stone-250 bg-stone-100 text-stone-800 rounded-lg text-sm font-semibold hover:bg-stone-200 transition">
                        {{ $skill }}
                    </span>
                @endforeach
            </div>
        </section>
    @endif

    @if ($sections['contact']['enabled'] ?? true)
        <section class="border-t border-stone-200 pt-10">
            <h2 class="text-2xl font-bold text-stone-900 mb-6">Inquiries & Consulting</h2>
            <form class="space-y-4 max-w-xl">
                <input type="text" placeholder="Your Name" class="w-full px-4 py-3 border border-stone-200 rounded-lg text-stone-900 focus:outline-none focus:ring-1 focus:ring-stone-850 placeholder-stone-400 text-sm">
                <input type="email" placeholder="Your Email" class="w-full px-4 py-3 border border-stone-200 rounded-lg text-stone-900 focus:outline-none focus:ring-1 focus:ring-stone-850 placeholder-stone-400 text-sm">
                <textarea placeholder="Please describe the professional challenge or opportunity..." rows="4" class="w-full px-4 py-3 border border-stone-200 rounded-lg text-stone-900 focus:outline-none focus:ring-1 focus:ring-stone-850 placeholder-stone-400 text-sm"></textarea>
                <button type="button" class="px-6 py-3 text-white font-bold rounded-lg transition hover:opacity-90 active:scale-[0.98]" style="background-color: {{ $primaryColor }}">
                    Send Message
                </button>
            </form>
        </section>
    @endif
</div>
