

<?php $__env->startSection('title', 'Penomoran Resmi Bagian Hukum (Setda)'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6" x-data="{ numberModal: false, revisionModal: false, selectedId: null, selectedCode: '' }">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/30">Tahap 3</span>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-1">Penomoran SK Resmi Bagian Hukum (Setda)</h1>
            <p class="text-sm text-slate-400 mt-1">Terbitkan Nomor SK Resmi Produk Hukum Kota Pekalongan setelah pemeriksaan substansi hukum</p>
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
                        <th class="px-6 py-4">Kode Tracking</th>
                        <th class="px-6 py-4">Kelurahan Pengaju</th>
                        <th class="px-6 py-4">Jenis Dokumen SK</th>
                        <th class="px-6 py-4">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-right">Aksi Penomoran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-indigo-400">
                                <?php echo e($submission->tracking_code); ?>

                            </td>
                            <td class="px-6 py-4 font-medium text-white">
                                <?php echo e($submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name); ?>

                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <?php echo e($submission->template->title ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 text-xs text-slate-400">
                                <?php echo e($submission->updated_at->translatedFormat('d F Y H:i')); ?>

                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?php echo e(route('submissions.show', $submission)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                                    Lihat Isi Draf
                                </a>

                                <button type="button" @click="selectedId = <?php echo e($submission->id); ?>; selectedCode = '<?php echo e($submission->tracking_code); ?>'; numberModal = true" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow-md shadow-blue-600/20">
                                    📑 Terbitkan Nomor SK
                                </button>

                                <button type="button" @click="selectedId = <?php echo e($submission->id); ?>; selectedCode = '<?php echo e($submission->tracking_code); ?>'; revisionModal = true" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/40 text-amber-300 text-xs font-semibold transition-colors border border-amber-500/30">
                                    ↩ Kembalikan Revisi
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                Tidak ada draf permohonan SK yang menunggu penomoran Bagian Hukum.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Input Nomor SK -->
    <div x-show="numberModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-4">
            <h3 class="text-lg font-bold text-white">Terbitkan Nomor SK Resmi</h3>
            <p class="text-xs text-slate-400">Kode Tracking: <span class="font-mono text-indigo-400" x-text="selectedCode"></span></p>

            <form :action="'/verification/' + selectedId + '/assign-number'" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-300 mb-2">Nomor SK Resmi (Format Setda)</label>
                    <input type="text" name="sk_number" required placeholder="188.4/001/PKL-UTARA/2026"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white font-mono text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="numberModal = false" class="px-4 py-2 rounded-xl bg-slate-700 text-slate-300 text-xs font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold">Simpan & Teruskan ke Camat</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Revisi -->
    <div x-show="revisionModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-4">
            <h3 class="text-lg font-bold text-white">Kembalikan Revisi ke Kelurahan</h3>
            <form :action="'/verification/' + selectedId + '/revision'" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-xs font-semibold uppercase text-slate-300 mb-2">Catatan Perbaikan Hukum</label>
                    <textarea name="notes" rows="4" required placeholder="Tuliskan catatan koreksi pasal / dasar hukum..."
                        class="w-full p-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs focus:ring-2 focus:ring-amber-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="revisionModal = false" class="px-4 py-2 rounded-xl bg-slate-700 text-slate-300 text-xs font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white text-xs font-semibold">Kirim Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views/verification/hukum-index.blade.php ENDPATH**/ ?>