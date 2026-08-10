<!-- Main Header / Navbar Component -->
<header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Left Side: Toggle Mobile Sidebar & Logo -->
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg font-bold text-gray-800 tracking-tight flex items-center gap-2">
                <span>SIP SK Pekalongan Utara</span>
            </h1>
        </div>

        <!-- Right Side: User Profile & Quick Actions -->
        <div class="flex items-center gap-3">
            @auth
                <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500 capitalize">{{ auth()->user()->role ?? 'User' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-rose-600 font-medium hover:underline">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>
