<!-- Sidebar Navigation Component - SIP SK Pekalongan Utara -->
<aside class="w-64 bg-slate-900 text-slate-300 min-h-screen flex flex-col transition-all duration-200 border-r border-slate-800">
    <!-- Branding Header -->
    <div class="h-16 flex items-center px-6 bg-slate-950 font-bold text-white tracking-wide border-b border-slate-800">
        <span class="text-indigo-400 font-extrabold mr-1">SIP-SK</span> Pekalongan Utara
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <!-- Dashboard -->
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('dashboard') ? 'bg-indigo-600/20 text-indigo-400 font-semibold border border-indigo-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <!-- Submissions link -->
        <a href="<?php echo e(route('submissions.index')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('submissions.*') ? 'bg-indigo-600/20 text-indigo-400 font-semibold border border-indigo-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Daftar Permohonan SK
        </a>

        <!-- Templates link (Admin Kecamatan & Bagian Hukum) -->
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin_kecamatan|bagian_hukum')): ?>
        <a href="<?php echo e(route('templates.index')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('templates.*') ? 'bg-indigo-600/20 text-indigo-400 font-semibold border border-indigo-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            Kelola Template SK
        </a>
        <?php endif; ?>

        <!-- Workflow Verification Stages Links -->
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin_kecamatan')): ?>
        <a href="<?php echo e(route('verification.kecamatan')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('verification.kecamatan') ? 'bg-yellow-500/20 text-yellow-300 font-semibold border border-yellow-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Verifikasi Kecamatan
        </a>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'bagian_hukum')): ?>
        <a href="<?php echo e(route('verification.hukum')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('verification.hukum') ? 'bg-blue-500/20 text-blue-300 font-semibold border border-blue-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
            </svg>
            Penomoran Bagian Hukum
        </a>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'camat')): ?>
        <a href="<?php echo e(route('verification.camat')); ?>" class="flex items-center px-3 py-2.5 rounded-xl text-sm font-medium transition-all <?php echo e(request()->routeIs('verification.camat') ? 'bg-purple-500/20 text-purple-300 font-semibold border border-purple-500/30' : 'hover:bg-slate-800 hover:text-white'); ?>">
            <svg class="w-5 h-5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
            Pengesahan TTE Camat
        </a>
        <?php endif; ?>
    </nav>

    <!-- User Info & Logout Footer -->
    <div class="p-4 border-t border-slate-800 bg-slate-950 space-y-3">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-indigo-600/20 text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/30">
                <?php echo e(substr(Auth::user()->name ?? 'U', 0, 1)); ?>

            </div>
            <div class="truncate">
                <span class="block text-xs font-semibold text-white truncate"><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                <span class="block text-[10px] text-slate-400 truncate"><?php echo e(Auth::user()->email ?? ''); ?></span>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full py-2 px-3 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 text-xs font-semibold transition-colors border border-rose-500/20 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar (Logout)
            </button>
        </form>
    </div>
</aside>
<?php /**PATH D:\sip-sk-utara\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>