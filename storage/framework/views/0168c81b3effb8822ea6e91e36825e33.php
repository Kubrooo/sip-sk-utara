<?php $__env->startSection('title', 'Pengesahan & TTE Camat'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-500/10 text-purple-400 border border-purple-500/30">Tahap 4 - Final</span>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-1">Pengesahan & Tanda Tangan Elektronik (TTE) Camat</h1>
            <p class="text-sm text-slate-400 mt-1">Disahkan oleh Camat Pekalongan Utara dengan pembubuhan TTE QR Code & Hash SHA-256</p>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- Table Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/60 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/60">
                    <tr>
                        <th class="px-6 py-4">Nomor SK Resmi</th>
                        <th class="px-6 py-4">Kode Tracking</th>
                        <th class="px-6 py-4">Kelurahan Pengaju</th>
                        <th class="px-6 py-4">Jenis Dokumen SK</th>
                        <th class="px-6 py-4 text-right">Aksi Pengesahan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-bold text-emerald-400">
                                <?php echo e($submission->sk_number); ?>

                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-indigo-400">
                                <?php echo e($submission->tracking_code); ?>

                            </td>
                            <td class="px-6 py-4 font-medium text-white">
                                <?php echo e($submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name); ?>

                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <?php echo e($submission->template->title ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?php echo e(route('submissions.show', $submission)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                                    Lihat Pratinjau
                                </a>

                                <form action="<?php echo e(route('verification.approve', $submission)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Sahkan SK ini dan bubuhkan Tanda Tangan Elektronik (TTE) Camat?')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="inline-flex items-center px-4 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all shadow-lg shadow-emerald-600/30">
                                        ✍️ Sahkan & Bubuhkan TTE
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                Tidak ada permohonan SK yang menunggu pengesahan Camat saat ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views/verification/camat-index.blade.php ENDPATH**/ ?>