<nav class="sticky top-0 z-50 bg-slate-900/90 border-b border-slate-800/80 backdrop-blur-md shadow-lg">
    <div class="px-6 py-4 mx-auto max-w-7xl flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-2xl font-black bg-gradient-to-r from-blue-400 via-indigo-500 to-rose-500 bg-clip-text text-transparent tracking-wider flex items-center gap-2">
            <span>✨</span> Resume.AI
        </a>
        
        <!-- Navigation Links -->
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white text-sm font-semibold transition">Console</a>
            <a href="{{ route('resume.templates') }}" class="text-slate-300 hover:text-white text-sm font-semibold transition">Templates</a>
            <a href="{{ route('resume.import') }}" class="text-slate-300 hover:text-white text-sm font-semibold transition">Import</a>
            <a href="{{ route('resume.index') }}" class="text-slate-300 hover:text-white text-sm font-semibold transition">My Resumes</a>
            <a href="{{ route('portfolio.index') }}" class="text-slate-300 hover:text-white text-sm font-semibold transition">Portfolios</a>
            
            <span class="w-px h-6 bg-slate-800"></span>

            <!-- User Dropdown Menu -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-2xl bg-slate-800 border border-slate-750 hover:border-slate-600 transition">
                    <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" 
                         alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full border border-slate-700 shadow-sm">
                    <svg class="w-4 h-4 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-52 bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl z-50">
                    <div class="px-4 py-3 border-b border-slate-800">
                        <p class="font-bold text-white text-sm leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 mt-1 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="block m-1">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2.5 text-xs font-bold text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 rounded-xl transition">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
