<!-- Sidebar Navigation Component - SIP SK Pekalongan Utara -->
<aside class="w-72 bg-slate-950 text-slate-300 min-h-screen flex flex-col shrink-0 border-r border-slate-800/80 z-20 relative select-none">
    
    <!-- Branding Header -->
    <div class="h-20 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/60 backdrop-blur-xl">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-800 flex items-center justify-center shadow-lg shadow-indigo-500/25 ring-1 ring-indigo-400/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <span class="font-extrabold text-white text-base tracking-tight block">SIP-SK <span class="text-indigo-400">Utara</span></span>
                <span class="text-[10px] text-slate-400 font-medium tracking-wide block">Kec. Pekalongan Utara</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-6 overflow-y-auto">

        <!-- Group: Navigasi Utama -->
        <div class="space-y-1.5">
            <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 block mb-2">Navigasi Utama</span>

            <!-- Dashboard -->
            <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110 <?php echo e(request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard Overview</span>
                </div>
                <?php if(request()->routeIs('dashboard')): ?>
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                <?php endif; ?>
            </a>

            <!-- Submissions link -->
            <a href="<?php echo e(route('submissions.index')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('submissions.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110 <?php echo e(request()->routeIs('submissions.*') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Daftar Permohonan SK</span>
                </div>
                <?php if(request()->routeIs('submissions.*')): ?>
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                <?php endif; ?>
            </a>

            <!-- Templates link (Admin Kecamatan & Bagian Hukum) -->
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin_kecamatan|bagian_hukum')): ?>
            <a href="<?php echo e(route('templates.index')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('templates.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/30 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 transition-transform group-hover:scale-110 <?php echo e(request()->routeIs('templates.*') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    <span>Kelola Template SK</span>
                </div>
                <?php if(request()->routeIs('templates.*')): ?>
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                <?php endif; ?>
            </a>
            <?php endif; ?>
        </div>

        <!-- Group: Workflow Tahap Verifikasi -->
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin_kecamatan|bagian_hukum|camat')): ?>
        <div class="space-y-1.5 pt-2 border-t border-slate-900">
            <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 block mb-2">Workflow & Verifikasi</span>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin_kecamatan')): ?>
            <a href="<?php echo e(route('verification.kecamatan')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('verification.kecamatan') ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40 shadow-lg shadow-amber-950/40 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-amber-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Verifikasi Kecamatan</span>
                </div>
                <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-amber-500/20 text-amber-300">T-2</span>
            </a>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'bagian_hukum')): ?>
            <a href="<?php echo e(route('verification.hukum')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('verification.hukum') ? 'bg-blue-500/20 text-blue-300 border border-blue-500/40 shadow-lg shadow-blue-950/40 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-blue-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                    <span>Penomoran Bagian Hukum</span>
                </div>
                <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-blue-500/20 text-blue-300">T-3</span>
            </a>
            <?php endif; ?>

            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'camat')): ?>
            <a href="<?php echo e(route('verification.camat')); ?>" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all group <?php echo e(request()->routeIs('verification.camat') ? 'bg-purple-500/20 text-purple-300 border border-purple-500/40 shadow-lg shadow-purple-950/40 font-bold' : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'); ?>">
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-purple-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Pengesahan TTE Camat</span>
                </div>
                <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-purple-500/20 text-purple-300">T-4</span>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </nav>

    <!-- User Info & Logout Footer Card -->
    <div class="p-4 border-t border-slate-800/80 bg-slate-950/80 space-y-3">
        <!-- Theme Toggle Card in Sidebar -->
        <div class="p-2.5 rounded-xl border transition-colors duration-300 flex items-center justify-between"
             :class="darkMode ? 'bg-slate-900/80 border-slate-800 text-slate-300' : 'bg-slate-100 border-slate-200 text-slate-700'">
            <span class="text-xs font-semibold flex items-center gap-2">
                <svg x-show="darkMode" class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg x-show="!darkMode" x-cloak class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                <span x-text="darkMode ? 'Mode Gelap' : 'Mode Terang'"></span>
            </span>
            <button type="button" @click="toggleTheme()" class="px-2.5 py-1 rounded-lg text-[10px] font-bold transition-all"
                    :class="darkMode ? 'bg-slate-800 text-indigo-300 hover:bg-slate-700' : 'bg-white text-indigo-600 border border-slate-200 shadow-xs hover:bg-slate-50'">
                Ubah Mode
            </button>
        </div>

        <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3 overflow-hidden">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-400 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    <?php echo e(substr(Auth::user()->name ?? 'U', 0, 1)); ?>

                </div>
                <div class="truncate">
                    <span class="block text-xs font-bold text-white truncate"><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                    <span class="block text-[10px] text-indigo-400 font-semibold uppercase tracking-wider"><?php echo e(Auth::user()->getRoleNames()->first() ?? 'User'); ?></span>
                </div>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full py-2.5 px-3 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 text-xs font-semibold transition-all duration-200 border border-rose-500/20 flex items-center justify-center gap-2 group">
                <svg class="w-4 h-4 text-rose-400 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Keluar dari Sistem</span>
            </button>
        </form>
    </div>
</aside>
<?php /**PATH D:\sip-sk-utara\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>