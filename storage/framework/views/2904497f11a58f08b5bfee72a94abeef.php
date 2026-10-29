<?php $__env->startSection('title', 'Edit Template SK - ' . $template->code); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto space-y-6" x-data="{
    fields: <?php echo \Illuminate\Support\Js::from(old('dynamic_fields', $template->dynamic_fields ?? []))->toHtml() ?>,
    editorHtml: <?php echo \Illuminate\Support\Js::from(old('html_template', $template->html_template))->toHtml() ?>,
    previewHtml: '',
    addField() {
        this.fields.push({ name: '', label: '', type: 'text', options: '', required: false });
    },
    removeField(index) {
        if (this.fields.length > 1) {
            this.fields.splice(index, 1);
        }
    },
    updateEditor() {
        this.editorHtml = this.$refs.editor.innerHTML;
        this.previewHtml = this.editorHtml.replace(/\x7b\x7b\s*([a-z][a-z0-9_]*)\s*\x7d\x7d/g, '<span style=&quot;background:#e0e7ff;color:#3730a3;padding:2px 4px;border-radius:3px;&quot;>[$1]</span>');
    },
    insertText(text) {
        this.$refs.editor.focus();
        document.execCommand('insertText', false, text);
        this.updateEditor();
    },
    insertSection(title) {
        this.$refs.editor.focus();
        document.execCommand('insertHTML', false, '<p><strong>' + title + ':</strong> </p>');
        this.updateEditor();
    },
    format(command) {
        this.$refs.editor.focus();
        document.execCommand(command, false, null);
        this.updateEditor();
    }
}" x-init="$refs.editor.innerHTML = editorHtml; updateEditor()">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Edit Template SK</h1>
            <p class="text-sm text-slate-400 mt-1">Kode: <span class="font-mono text-indigo-400"><?php echo e($template->code); ?></span></p>
        </div>
        <a href="<?php echo e(route('templates.index')); ?>" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-medium transition-colors">
            &larr; Kembali
        </a>
    </div>

    <?php if(isset($errors) && $errors->any()): ?>
        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <ul class="list-disc list-inside space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('templates.update', $template)); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Metadata Template Card -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Informasi Utama Template</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="code" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Kode Template</label>
                    <input type="text" name="code" id="code" required value="<?php echo e(old('code', $template->code)); ?>"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-white font-mono text-sm">
                </div>

                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Judul Dokumen SK</label>
                    <input type="text" name="title" id="title" required value="<?php echo e(old('title', $template->title)); ?>"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-white text-sm">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e($template->is_active ? 'checked' : ''); ?> class="rounded bg-slate-900 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                <label for="is_active" class="text-sm font-medium text-slate-300">Aktifkan Template ini</label>
            </div>
        </div>

        <!-- Dynamic Fields Builder Card -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-5">
            <div class="flex items-center justify-between border-b border-slate-700/60 pb-3">
                <div>
                    <h2 class="text-lg font-semibold text-white">Bidang Input Dinamis (Dynamic Fields)</h2>
                    <p class="text-xs text-slate-400">Variabel input yang wajib diisi Admin Kelurahan saat membuat draf SK.</p>
                </div>
                <button type="button" @click="addField()" class="px-3 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 text-xs font-semibold border border-indigo-500/30 transition-colors">
                    + Tambah Variabel
                </button>
            </div>

            <div class="space-y-4">
                <template x-for="(field, index) in fields" :key="index">
                    <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/80 relative space-y-3">
                        <div class="flex items-center justify-between text-xs text-slate-400 font-mono">
                            <span>Variabel #<span x-text="index + 1"></span>: <strong class="text-indigo-400" x-text="field.name ? ('\x7b\x7b' + field.name + '\x7d\x7d') : '\x7b\x7b...\x7d\x7d'"></strong></span>
                            <button type="button" @click="removeField(index)" x-show="fields.length > 1" class="text-rose-400 hover:text-rose-300 font-semibold">
                                Hapus
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <div>
                                <label class="block text-[11px] font-semibold uppercase text-slate-400 mb-1">Nama Variabel (Key)</label>
                                <input type="text" :name="'dynamic_fields[' + index + '][name]'" x-model="field.name" required
                                    class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white text-xs font-mono">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold uppercase text-slate-400 mb-1">Label Tampilan</label>
                                <input type="text" :name="'dynamic_fields[' + index + '][label]'" x-model="field.label" required
                                    class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white text-xs">
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold uppercase text-slate-400 mb-1">Tipe Input</label>
                                <select :name="'dynamic_fields[' + index + '][type]'" x-model="field.type"
                                    class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white text-xs">
                                    <option value="text">Teks Singkat</option>
                                    <option value="textarea">Teks Panjang</option>
                                    <option value="date">Tanggal</option>
                                    <option value="number">Angka</option>
                                    <option value="select">Pilihan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold uppercase text-slate-400 mb-1">Opsi Select</label>
                                <input type="text" :name="'dynamic_fields[' + index + '][options]'"
                                    :value="Array.isArray(field.options) ? field.options.join(', ') : field.options"
                                    @input="field.options = $event.target.value"
                                    x-show="field.type === 'select'" :required="field.type === 'select'"
                                    class="w-full px-3 py-2 rounded-lg bg-slate-800 border border-slate-700 text-white text-xs">
                            </div>
                        </div>
                        <label class="inline-flex items-center gap-2 text-xs text-slate-300">
                            <input type="checkbox" :name="'dynamic_fields[' + index + '][required]'" value="1" x-model="field.required"
                                class="rounded bg-slate-800 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                            Wajib diisi oleh Admin Kelurahan
                        </label>
                    </div>
                </template>
            </div>
        </div>

        <!-- HTML Template Body Card -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
            <div>
                <h2 class="text-lg font-semibold text-white">Isi Dokumen</h2>
                <p class="text-xs text-slate-400 mt-1">Edit seperti dokumen biasa. Gunakan tombol variabel, bukan mengetik placeholder secara manual.</p>
            </div>
            <div class="flex flex-wrap gap-2 rounded-xl border border-slate-700 bg-slate-900/70 p-3">
                <button type="button" @click="format('bold')" class="rounded-lg bg-slate-700 px-3 py-1.5 text-xs font-bold text-white">B</button>
                <button type="button" @click="format('italic')" class="rounded-lg bg-slate-700 px-3 py-1.5 text-xs italic text-white">I</button>
                <button type="button" @click="format('justifyCenter')" class="rounded-lg bg-slate-700 px-3 py-1.5 text-xs text-white">Tengah</button>
                <span class="mx-1 border-l border-slate-700"></span>
                <template x-for="field in fields" :key="field.name">
                    <button type="button" @click="insertText('&#123;&#123;' + field.name + '&#125;&#125;')" class="rounded-lg bg-indigo-600/30 px-3 py-1.5 text-xs font-semibold text-indigo-200 border border-indigo-500/30" x-text="field.label || field.name"></button>
                </template>
                <button type="button" @click="insertText('&#123;&#123;sk_number&#125;&#125;')" class="rounded-lg bg-emerald-600/30 px-3 py-1.5 text-xs font-semibold text-emerald-200 border border-emerald-500/30">Nomor SK</button>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="self-center text-[11px] font-semibold text-slate-400">Tambah bagian:</span>
                <button type="button" @click="insertSection('Menimbang')" class="rounded-lg border border-slate-600 px-2.5 py-1.5 text-[11px] text-slate-300">Menimbang</button>
                <button type="button" @click="insertSection('Mengingat')" class="rounded-lg border border-slate-600 px-2.5 py-1.5 text-[11px] text-slate-300">Mengingat</button>
                <button type="button" @click="insertSection('MEMUTUSKAN')" class="rounded-lg border border-slate-600 px-2.5 py-1.5 text-[11px] text-slate-300">MEMUTUSKAN</button>
                <button type="button" @click="insertSection('MENETAPKAN')" class="rounded-lg border border-slate-600 px-2.5 py-1.5 text-[11px] text-slate-300">MENETAPKAN</button>
            </div>
            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <div x-ref="editor" contenteditable="true" @input="updateEditor()" class="min-h-[280px] rounded-xl border border-slate-700 bg-white p-5 text-sm leading-7 text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"></div>
                    <textarea name="html_template" class="hidden" x-model="editorHtml" required></textarea>
                    <p class="mt-2 text-[11px] text-slate-500">Contoh alur: Menimbang → Mengingat → MEMUTUSKAN → Menetapkan.</p>
                </div>
                <div class="rounded-xl border border-slate-700 bg-white p-4">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">Pratinjau</p>
                    <iframe title="Pratinjau template" class="h-[280px] w-full rounded border border-slate-200 bg-white" sandbox
                        :srcdoc="previewHtml || '<p style=&quot;color:#64748b;font-family:sans-serif&quot;>Mulai menulis isi dokumen.</p>'"></iframe>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="<?php echo e(route('templates.index')); ?>" class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-sm transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all shadow-lg shadow-indigo-600/30">
                Update Template SK
            </button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\sip-sk-utara\resources\views\templates\edit.blade.php ENDPATH**/ ?>