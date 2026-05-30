<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Resume AI Builder')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-900 text-gray-100">
    <div id="app" class="flex flex-col min-h-screen">
        <!-- Navigation -->
        @auth
            @include('components.navbar-auth')
        @else
            @include('components.navbar-guest')
        @endauth

        <!-- Main Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Alpine Toast Notification Container -->
    <div x-data="{ toasts: [] }" 
         @toast.window="toasts.push({ id: Date.now(), message: $event.detail.message, type: $event.detail.type }); setTimeout(() => { toasts = toasts.filter(t => t.id !== $event.detail.id) }, 4000)"
         class="fixed bottom-4 right-4 z-50 space-y-2 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="true"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 :class="{
                    'bg-emerald-600 border border-emerald-500/30': toast.type === 'success',
                    'bg-rose-600 border border-rose-500/30': toast.type === 'error',
                    'bg-sky-600 border border-sky-500/30': toast.type === 'info',
                    'bg-amber-600 border border-amber-500/30': toast.type === 'warning'
                 }"
                 class="px-6 py-3 rounded-xl text-white font-medium shadow-2xl pointer-events-auto backdrop-blur-md flex items-center gap-2 max-w-sm">
                <div class="flex-grow text-sm" x-text="toast.message"></div>
                <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="text-white/70 hover:text-white transition">
                    &times;
                </button>
            </div>
        </template>
    </div>

    <!-- Toast Notifications Trigger -->
    <script>
        window.showToast = function(message, type = 'info') {
            window.dispatchEvent(new CustomEvent('toast', { 
                detail: { id: Date.now(), message, type } 
            }));
        };

        @if ($errors->any())
            window.addEventListener('DOMContentLoaded', () => {
                showToast('{{ $errors->first() }}', 'error');
            });
        @endif
        
        @if (session('success'))
            window.addEventListener('DOMContentLoaded', () => {
                showToast('{{ session("success") }}', 'success');
            });
        @endif
    </script>
</body>
</html>
