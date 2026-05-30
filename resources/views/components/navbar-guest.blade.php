<!-- Navigation for Guest Users -->
<nav class="sticky top-0 z-50 bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 shadow-sm">
    <div class="px-4 py-4 mx-auto max-w-7xl flex items-center justify-between">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Resume AI
        </a>
        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}" class="px-6 py-2 text-gray-900 dark:text-white hover:text-blue-600 transition">
                Sign In
            </a>
            <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-purple-500/50 transition">
                Get Started
            </a>
        </div>
    </div>
</nav>
