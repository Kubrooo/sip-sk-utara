

<?php $__env->startSection('title', 'Buat Draf Pengajuan SK Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Buat Draf Pengajuan SK Baru</h1>
            <p class="text-sm text-slate-400 mt-1">Inisiasi draf Surat Keputusan untuk Kelurahan <?php echo e(Auth::user()->kelurahan_name ?? Auth::user()->name); ?></p>
        </div>
        <a href="<?php echo e(route('submissions.index')); ?>" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-medium transition-colors">
            &larr; Batal
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <ul class="list-disc list-inside space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Template Switcher Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
        <label for="template_selector" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Pilih Jenis Template SK</label>
        <select id="template_selector" onchange="window.location.href='<?php echo e(route('submissions.create')); ?>?template_id=' + this.value"
            class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white font-medium text-sm focus:ring-2 focus:ring-indigo-500">
            <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tpl->id); ?>" <?php echo e($selectedTemplate->id == $tpl->id ? 'selected' : ''); ?>>
                    [<?php echo e($tpl->code); ?>] <?php echo e($tpl->title); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <!-- Form Input Dinamis -->
    <form method="POST" action="<?php echo e(route('submissions.store')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="template_id" value="<?php echo e($selectedTemplate->id); ?>">

        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Isi Bidang Variabel Dokumen (<?php echo e($selectedTemplate->title); ?>)</h2>

            <div class="space-y-5">
                <?php $__currentLoopData = $selectedTemplate->dynamic_fields ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $key = $field['name'] ?? '';
                        $label = $field['label'] ?? $key;
                        $type = $field['type'] ?? 'text';
                        $required = !empty($field['required']);
                        $options = $field['options'] ?? [];
                    ?>

                    <div>
                        <label for="field_<?php echo e($key); ?>" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                            <?php echo e($label); ?>

                            <?php if($required): ?>
                                <span class="text-rose-400 font-bold">*</span>
                            <?php endif; ?>
                        </label>

                        <?php if($type === 'textarea'): ?>
                            <textarea name="field_values[<?php echo e($key); ?>]" id="field_<?php echo e($key); ?>" rows="4" <?php echo e($required ? 'required' : ''); ?>

                                class="w-full p-4 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500"><?php echo e(old('field_values.' . $key)); ?></textarea>

                        <?php elseif($type === 'select'): ?>
                            <select name="field_values[<?php echo e($key); ?>]" id="field_<?php echo e($key); ?>" <?php echo e($required ? 'required' : ''); ?>

                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Pilih <?php echo e($label); ?> --</option>
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($opt); ?>" <?php echo e(old('field_values.' . $key) == $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                        <?php elseif($type === 'date'): ?>
                            <input type="date" name="field_values[<?php echo e($key); ?>]" id="field_<?php echo e($key); ?>" <?php echo e($required ? 'required' : ''); ?> value="<?php echo e(old('field_values.' . $key)); ?>"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        <?php elseif($type === 'number'): ?>
                            <input type="number" name="field_values[<?php echo e($key); ?>]" id="field_<?php echo e($key); ?>" <?php echo e($required ? 'required' : ''); ?> value="<?php echo e(old('field_values.' . $key)); ?>"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        <?php else: ?>
                            <input type="text" name="field_values[<?php echo e($key); ?>]" id="field_<?php echo e($key); ?>" <?php echo e($required ? 'required' : ''); ?> value="<?php echo e(old('field_values.' . $key)); ?>"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="<?php echo e(route('submissions.index')); ?>" class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-sm transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all shadow-lg shadow-indigo-600/30">
                Simpan Draf Permohonan
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views/submissions/create.blade.php ENDPATH**/ ?>