<?php $__env->startSection('title', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <!-- Header Welcome Card -->
    <div class="bg-gradient-to-r from-indigo-900/60 via-slate-800 to-slate-800 p-8 rounded-3xl border border-indigo-500/20 shadow-2xl relative overflow-hidden">
        <div class="absolute right-0 top-0 translate-x-8 -translate-y-8 w-64 h-64 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                <?php echo e(Auth::user()->getRoleNames()->first() ?? 'User'); ?>

            </span>
            <h1 class="text-3xl font-bold text-white tracking-tight">Selamat Datang, <?php echo e(Auth::user()->name); ?></h1>
            <p class="text-sm text-slate-300 max-w-2xl">
                Sistem Informasi Pembuatan Surat Keputusan (SIP-SK) Produk Hukum Kecamatan Pekalongan Utara.
            </p>
        </div>
    </div>

    <!-- Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <!-- Draf Kelurahan -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl p-5 rounded-2xl shadow-xl space-y-3">
            <div class="flex items-center justify-between text-xs text-slate-400 font-semibold uppercase">
                <span>Draf Kelurahan</span>
                <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
            </div>
            <div class="text-3xl font-bold text-white"><?php echo e($stats['draft']); ?></div>
            <p class="text-xs text-slate-400">Draf belum diajukan</p>
        </div>

        <!-- Review Kecamatan -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl p-5 rounded-2xl shadow-xl space-y-3">
            <div class="flex items-center justify-between text-xs text-amber-400 font-semibold uppercase">
                <span>Verifikasi Kec.</span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            </div>
            <div class="text-3xl font-bold text-amber-300"><?php echo e($stats['review_kecamatan']); ?></div>
            <p class="text-xs text-slate-400">Menunggu verifikasi teknis</p>
        </div>

        <!-- Review Hukum -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl p-5 rounded-2xl shadow-xl space-y-3">
            <div class="flex items-center justify-between text-xs text-blue-400 font-semibold uppercase">
                <span>Penomoran Setda</span>
                <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span>
            </div>
            <div class="text-3xl font-bold text-blue-300"><?php echo e($stats['review_hukum']); ?></div>
            <p class="text-xs text-slate-400">Menunggu nomor resmi</p>
        </div>

        <!-- Ready Approval -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl p-5 rounded-2xl shadow-xl space-y-3">
            <div class="flex items-center justify-between text-xs text-purple-400 font-semibold uppercase">
                <span>Siap TTE Camat</span>
                <span class="w-2.5 h-2.5 rounded-full bg-purple-400"></span>
            </div>
            <div class="text-3xl font-bold text-purple-300"><?php echo e($stats['ready_approval']); ?></div>
            <p class="text-xs text-slate-400">Menunggu pengesahan</p>
        </div>

        <!-- Approved TTE -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl p-5 rounded-2xl shadow-xl space-y-3">
            <div class="flex items-center justify-between text-xs text-emerald-400 font-semibold uppercase">
                <span>Disetujui TTE</span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
            </div>
            <div class="text-3xl font-bold text-emerald-300"><?php echo e($stats['approved']); ?></div>
            <p class="text-xs text-slate-400">SK Terbit & Sah</p>
        </div>
    </div>

    <!-- Recent Activity Submissions Table -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl overflow-hidden shadow-2xl space-y-4 p-6">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-white">Pengajuan SK Terkini</h2>
            <a href="<?php echo e(route('submissions.index')); ?>" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/60 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/60">
                    <tr>
                        <th class="px-4 py-3">Tracking Code</th>
                        <th class="px-4 py-3">Nomor SK</th>
                        <th class="px-4 py-3">Kelurahan</th>
                        <th class="px-4 py-3">Jenis Template</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    <?php $__empty_1 = true; $__currentLoopData = $recentSubmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3 font-mono text-xs font-semibold text-indigo-400">
                                <?php echo e($sub->tracking_code); ?>

                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-200">
                                <?php echo e($sub->sk_number ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3 text-xs text-slate-300">
                                <?php echo e($sub->kelurahan->kelurahan_name ?? $sub->kelurahan->name); ?>

                            </td>
                            <td class="px-4 py-3 font-medium text-white text-xs">
                                <?php echo e($sub->template->title ?? '-'); ?>

                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium border <?php echo e($sub->status->badgeClass()); ?>">
                                    <?php echo e($sub->status->label()); ?>

                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="<?php echo e(route('submissions.show', $sub)); ?>" class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                                Belum ada riwayat pengajuan SK.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views/dashboard/index.blade.php ENDPATH**/ ?>