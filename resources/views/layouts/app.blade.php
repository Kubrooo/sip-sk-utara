<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — SIP-SK Pekalongan Utara</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#312e81',
                            950: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        .glass-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card-hover:hover {
            border-color: rgba(99, 102, 241, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -10px rgba(79, 70, 229, 0.15);
        }
        .ambient-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.12) 0%, rgba(0, 0, 0, 0) 70%);
            pointer-events: none;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }

        /* Light Mode Styles & Overrides */
        body.light-theme {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }

        body.light-theme header {
            background-color: rgba(255, 255, 255, 0.85) !important;
            border-color: rgba(226, 232, 240, 0.9) !important;
        }

        body.light-theme aside {
            background-color: #ffffff !important;
            border-color: rgba(226, 232, 240, 0.9) !important;
            color: #334155 !important;
        }

        body.light-theme aside .bg-slate-950\/60,
        body.light-theme aside .bg-slate-950\/80,
        body.light-theme aside .bg-slate-950 {
            background-color: #ffffff !important;
            border-color: rgba(226, 232, 240, 0.9) !important;
        }

        body.light-theme aside .border-slate-800\/80,
        body.light-theme aside .border-slate-900 {
            border-color: rgba(226, 232, 240, 0.9) !important;
        }

        body.light-theme aside .text-white {
            color: #0f172a !important;
        }

        body.light-theme aside .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme aside .hover\:bg-slate-900:hover {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }

        body.light-theme aside .bg-slate-900\/80 {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .glass-card,
        body.light-theme .bg-slate-800\/80,
        body.light-theme .bg-slate-900\/80,
        body.light-theme .bg-slate-900\/90,
        body.light-theme .bg-slate-900\/60 {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01) !important;
        }

        body.light-theme .glass-card-hover:hover {
            border-color: rgba(99, 102, 241, 0.4) !important;
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.1) !important;
        }

        body.light-theme .text-white {
            color: #0f172a !important;
        }

        body.light-theme .text-slate-100 {
            color: #1e293b !important;
        }

        body.light-theme .text-slate-200 {
            color: #334155 !important;
        }

        body.light-theme .text-slate-300 {
            color: #475569 !important;
        }

        body.light-theme .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme table thead {
            background-color: #f8fafc !important;
            color: #475569 !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme table tbody tr {
            border-color: #f1f5f9 !important;
        }

        body.light-theme table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        body.light-theme input:not([type="checkbox"]):not([type="radio"]),
        body.light-theme select,
        body.light-theme textarea {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }

        body.light-theme ::-webkit-scrollbar-track { background: #f1f5f9; }
        body.light-theme ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        body.light-theme ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* High-contrast Color Mappings for Light Mode */
        body.light-theme .text-amber-300,
        body.light-theme .text-amber-400 {
            color: #b45309 !important; /* Amber-700 for high contrast */
            font-weight: 700 !important;
        }

        body.light-theme .text-yellow-300,
        body.light-theme .text-yellow-400 {
            color: #a16207 !important; /* Yellow-700 */
            font-weight: 700 !important;
        }

        body.light-theme .text-indigo-300,
        body.light-theme .text-indigo-400 {
            color: #4338ca !important; /* Indigo-700 */
            font-weight: 700 !important;
        }

        body.light-theme .text-blue-300,
        body.light-theme .text-blue-400 {
            color: #1d4ed8 !important; /* Blue-700 */
            font-weight: 700 !important;
        }

        body.light-theme .text-purple-300,
        body.light-theme .text-purple-400 {
            color: #7e22ce !important; /* Purple-700 */
            font-weight: 700 !important;
        }

        body.light-theme .text-emerald-300,
        body.light-theme .text-emerald-400 {
            color: #047857 !important; /* Emerald-700 */
            font-weight: 700 !important;
        }

        body.light-theme .text-rose-300,
        body.light-theme .text-rose-400 {
            color: #be123c !important; /* Rose-700 */
            font-weight: 700 !important;
        }

        /* Badge background contrast fix for Light Mode */
        body.light-theme .bg-amber-500\/10,
        body.light-theme .bg-amber-500\/20 {
            background-color: #fef3c7 !important;
            border-color: #fde68a !important;
        }

        body.light-theme .bg-yellow-500\/10,
        body.light-theme .bg-yellow-500\/20 {
            background-color: #fef9c3 !important;
            border-color: #fef08a !important;
        }

        body.light-theme .bg-indigo-500\/10,
        body.light-theme .bg-indigo-500\/20 {
            background-color: #e0e7ff !important;
            border-color: #c7d2fe !important;
        }

        body.light-theme .bg-blue-500\/10,
        body.light-theme .bg-blue-500\/20 {
            background-color: #dbeafe !important;
            border-color: #bfdbfe !important;
        }

        body.light-theme .bg-purple-500\/10,
        body.light-theme .bg-purple-500\/20 {
            background-color: #f3e8ff !important;
            border-color: #e9d5ff !important;
        }

        body.light-theme .bg-emerald-500\/10,
        body.light-theme .bg-emerald-500\/20 {
            background-color: #d1fae5 !important;
            border-color: #a7f3d0 !important;
        }

        /* Gradient Text Override for Light Mode */
        body.light-theme .bg-clip-text {
            background-image: linear-gradient(to right, #3730a3, #4f46e5, #2563eb) !important;
            -webkit-background-clip: text !important;
            background-clip: text !important;
            color: transparent !important;
            font-weight: 800 !important;
        }
    </style>
</head>
<body class="h-full font-sans antialiased selection:bg-indigo-500 selection:text-white transition-colors duration-300"
      :class="darkMode ? 'bg-slate-950 text-slate-100 dark-theme' : 'bg-slate-100 text-slate-900 light-theme'"
      x-data="{
          darkMode: localStorage.getItem('theme') === 'light' ? false : true,
          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
          }
      }">
    <div class="flex h-full min-h-screen relative overflow-x-hidden">

        <!-- Ambient Lighting Glows -->
        <div class="ambient-glow -top-40 -left-40 transition-opacity duration-300" :class="darkMode ? 'opacity-100' : 'opacity-20'"></div>
        <div class="ambient-glow top-1/2 right-0 transition-opacity duration-300" :class="darkMode ? 'opacity-100' : 'opacity-20'"></div>

        <!-- Sidebar Component -->
        @include('partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar Header -->
            <header class="h-16 border-b px-6 flex items-center justify-between z-10 shrink-0 backdrop-blur-xl transition-colors duration-300"
                    :class="darkMode ? 'border-slate-800/80 bg-slate-950/70' : 'border-slate-200 bg-white/85 shadow-sm'">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold transition-colors duration-300"
                          :class="darkMode ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'bg-indigo-50 text-indigo-700 border border-indigo-200'">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                        SIP-SK Pekalongan Utara v2.0
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Theme Toggle Switch Button -->
                    <button type="button" @click="toggleTheme()" 
                            class="p-2.5 rounded-xl transition-all duration-200 focus:outline-none flex items-center justify-center border shadow-sm"
                            :class="darkMode ? 'bg-slate-900 text-amber-400 border-slate-800 hover:bg-slate-800' : 'bg-slate-100 text-indigo-600 border-slate-200 hover:bg-slate-200'"
                            :title="darkMode ? 'Ubah ke Mode Terang (Light Mode)' : 'Ubah ke Mode Gelap (Dark Mode)'">
                        <!-- Sun Icon (shown in dark mode) -->
                        <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <!-- Moon Icon (shown in light mode) -->
                        <svg x-show="!darkMode" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <div class="text-right hidden sm:block">
                        <span class="block text-xs font-bold transition-colors duration-300" :class="darkMode ? 'text-slate-100' : 'text-slate-900'">{{ Auth::user()->name ?? 'User' }}</span>
                        <span class="block text-[10px] font-mono transition-colors duration-300" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ Auth::user()->email ?? '' }}</span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white font-bold text-sm flex items-center justify-center shadow-lg shadow-indigo-500/20 ring-2 transition-all duration-300"
                         :class="darkMode ? 'ring-slate-800' : 'ring-slate-200'">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Area -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8 lg:p-10 space-y-8 relative z-0">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
