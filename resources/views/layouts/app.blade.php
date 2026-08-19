<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
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
    </style>
</head>
<body class="h-full bg-slate-950 text-slate-100 font-sans antialiased selection:bg-indigo-500 selection:text-white">
    <div class="flex h-full min-h-screen relative overflow-x-hidden">

        <!-- Ambient Lighting Glows -->
        <div class="ambient-glow -top-40 -left-40"></div>
        <div class="ambient-glow top-1/2 right-0"></div>

        <!-- Sidebar Component -->
        @include('partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navbar Header -->
            <header class="h-16 border-b border-slate-800/80 bg-slate-950/70 backdrop-blur-xl px-6 flex items-center justify-between z-10 shrink-0">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                        SIP-SK Pekalongan Utara v2.0
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="block text-xs font-bold text-slate-100">{{ Auth::user()->name ?? 'User' }}</span>
                        <span class="block text-[10px] text-slate-400 font-mono">{{ Auth::user()->email ?? '' }}</span>
                    </div>
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white font-bold text-sm flex items-center justify-center shadow-lg shadow-indigo-500/20 ring-2 ring-slate-800">
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
