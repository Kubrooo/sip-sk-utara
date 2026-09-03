<?php $__env->startSection('title', 'Detail Permohonan SK - ' . $submission->tracking_code); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="font-mono text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                    <?php echo e($submission->tracking_code); ?>

                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo e($submission->status->badgeClass()); ?>">
                    <?php echo e($submission->status->label()); ?>

                </span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-2"><?php echo e($submission->template->title ?? 'Surat Keputusan'); ?></h1>
            <p class="text-xs text-slate-400 mt-1">Diajukan oleh: <strong class="text-slate-200"><?php echo e($submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name); ?></strong> • Pada <?php echo e($submission->created_at->translatedFormat('d F Y H:i')); ?></p>
        </div>

        <div class="flex flex-wrap gap-2">
            <?php if($submission->status === App\Enums\SubmissionStatus::DRAFT_KELURAHAN && Auth::user()->hasRole('admin_kelurahan')): ?>
                <a href="<?php echo e(route('submissions.edit', $submission)); ?>" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold transition-colors">
                    Edit Draf
                </a>
                <form action="<?php echo e(route('submissions.submit', $submission)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Ajukan Draf SK ini ke Kecamatan untuk verifikasi teknis?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold transition-all shadow-lg shadow-indigo-600/30">
                        🚀 Ajukan ke Kecamatan
                    </button>
                </form>
            <?php endif; ?>

            <a href="<?php echo e(route('submissions.pdf', $submission)); ?>" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/40 text-emerald-300 text-xs font-semibold transition-colors border border-emerald-500/30">
                📄 Preview / Unduh PDF
            </a>

            <a href="<?php echo e(route('submissions.index')); ?>" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                &larr; Kembali
            </a>
        </div>
    </div>

    <!-- Alert Success/Error -->
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

    <!-- Catatan Revisi / Penolakan (If Exists) -->
    <?php if($submission->revision_notes): ?>
        <div class="p-5 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-200 space-y-1">
            <h4 class="font-bold text-sm text-amber-400 flex items-center gap-2">
                ⚠️ Catatan Revisi / Penolakan Terakhir:
            </h4>
            <p class="text-sm leading-relaxed"><?php echo e($submission->revision_notes); ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Field Values Detail (Left 2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
                <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Isi Variabel Dokumen SK</h2>
                <div class="space-y-4">
                    <?php $__currentLoopData = $submission->template->dynamic_fields ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $key = $field['name'] ?? '';
                            $label = $field['label'] ?? $key;
                            $val = $submission->field_values[$key] ?? '-';
                        ?>
                        <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/80">
                            <span class="block text-xs uppercase font-semibold text-slate-400 mb-1"><?php echo e($label); ?></span>
                            <span class="text-sm text-white font-medium whitespace-pre-line"><?php echo e(is_array($val) ? implode(', ', $val) : $val); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Right Column: Metadata & Audit Trail Timeline -->
        <div class="space-y-6">
            <!-- Summary Info -->
            <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
                <h3 class="text-base font-semibold text-white border-b border-slate-700/60 pb-3">Informasi Tambahan</h3>
                <div class="text-xs space-y-3 text-slate-300">
                    <div>
                        <span class="text-slate-400 block">Nomor SK Resmi:</span>
                        <strong class="text-sm font-mono text-indigo-400"><?php echo e($submission->sk_number ?? 'Belum Diterbitkan'); ?></strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Penandatangan TTE:</span>
                        <strong class="text-sm text-white"><?php echo e($submission->approver->name ?? '-'); ?></strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Waktu Pengesahan TTE:</span>
                        <strong class="text-sm text-white"><?php echo e($submission->approved_at ? $submission->approved_at->translatedFormat('d F Y H:i') : '-'); ?></strong>
                    </div>
                    <?php if($submission->tte_hash): ?>
                        <div>
                            <span class="text-slate-400 block">SHA-256 Hash Verification:</span>
                            <code class="text-[10px] font-mono text-emerald-400 break-all block bg-slate-900 p-2 rounded border border-slate-700 mt-1">
                                <?php echo e($submission->tte_hash); ?>

                            </code>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Audit Trail Log Timeline -->
            <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
                <h3 class="text-base font-semibold text-white border-b border-slate-700/60 pb-3">Audit Trail Log</h3>
                <div class="space-y-4 relative before:absolute before:inset-0 before:left-3.5 before:w-0.5 before:bg-slate-700">
                    <?php $__empty_1 = true; $__currentLoopData = $submission->logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="relative pl-8 space-y-1">
                            <div class="absolute left-1.5 top-1.5 w-4 h-4 rounded-full bg-indigo-500 ring-4 ring-slate-800"></div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-white uppercase"><?php echo e($log->action); ?></span>
                                <span class="text-[10px] text-slate-400"><?php echo e($log->created_at->translatedFormat('d/m/y H:i')); ?></span>
                            </div>
                            <p class="text-xs text-slate-300"><?php echo e($log->notes); ?></p>
                            <span class="text-[10px] text-indigo-400 font-medium block">Oleh: <?php echo e($log->user->name ?? 'Sistem'); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-xs text-slate-500">Belum ada riwayat audit trail.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views/submissions/show.blade.php ENDPATH**/ ?>