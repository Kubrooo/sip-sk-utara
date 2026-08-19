@extends('layouts.app')

@section('title', 'Buat Draf Pengajuan SK Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Buat Draf Pengajuan SK Baru</h1>
            <p class="text-sm text-slate-400 mt-1">Inisiasi draf Surat Keputusan untuk Kelurahan {{ Auth::user()->kelurahan_name ?? Auth::user()->name }}</p>
        </div>
        <a href="{{ route('submissions.index') }}" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-medium transition-colors">
            &larr; Batal
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Template Switcher Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
        <label for="template_selector" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">Pilih Jenis Template SK</label>
        <select id="template_selector" onchange="window.location.href='{{ route('submissions.create') }}?template_id=' + this.value"
            class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white font-medium text-sm focus:ring-2 focus:ring-indigo-500">
            @foreach($templates as $tpl)
                <option value="{{ $tpl->id }}" {{ $selectedTemplate->id == $tpl->id ? 'selected' : '' }}>
                    [{{ $tpl->code }}] {{ $tpl->title }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Form Input Dinamis -->
    <form method="POST" action="{{ route('submissions.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="template_id" value="{{ $selectedTemplate->id }}">

        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Isi Bidang Variabel Dokumen ({{ $selectedTemplate->title }})</h2>

            <div class="space-y-5">
                @foreach($selectedTemplate->dynamic_fields ?? [] as $field)
                    @php
                        $key = $field['name'] ?? '';
                        $label = $field['label'] ?? $key;
                        $type = $field['type'] ?? 'text';
                        $required = !empty($field['required']);
                        $options = $field['options'] ?? [];
                    @endphp

                    <div>
                        <label for="field_{{ $key }}" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                            {{ $label }}
                            @if($required)
                                <span class="text-rose-400 font-bold">*</span>
                            @endif
                        </label>

                        @if($type === 'textarea')
                            <textarea name="field_values[{{ $key }}]" id="field_{{ $key }}" rows="4" {{ $required ? 'required' : '' }}
                                class="w-full p-4 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">{{ old('field_values.' . $key) }}</textarea>

                        @elseif($type === 'select')
                            <select name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }}
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Pilih {{ $label }} --</option>
                                @foreach($options as $opt)
                                    <option value="{{ $opt }}" {{ old('field_values.' . $key) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>

                        @elseif($type === 'date')
                            <input type="date" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        @elseif($type === 'number')
                            <input type="number" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        @else
                            <input type="text" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('submissions.index') }}" class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-sm transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all shadow-lg shadow-indigo-600/30">
                Simpan Draf Permohonan
            </button>
        </div>
    </form>
</div>
@endsection
