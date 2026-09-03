@extends('layouts.app')

@section('title', 'Edit Draf SK - ' . $submission->tracking_code)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <span class="font-mono text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                {{ $submission->tracking_code }}
            </span>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-2">Edit Draf Permohonan SK</h1>
            <p class="text-sm text-slate-400 mt-1">Jenis Template: {{ $template->title }}</p>
        </div>
        <a href="{{ route('submissions.show', $submission) }}" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-medium transition-colors">
            &larr; Kembali
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

    <form method="POST" action="{{ route('submissions.update', $submission) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-5">
            <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Perbarui Nilai Bidang Variabel</h2>

            <div class="space-y-5">
                @foreach($template->dynamic_fields ?? [] as $field)
                    @php
                        $key = $field['name'] ?? '';
                        $label = $field['label'] ?? $key;
                        $type = $field['type'] ?? 'text';
                        $required = !empty($field['required']);
                        $options = $field['options'] ?? [];
                        $currentValue = $submission->field_values[$key] ?? '';
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
                                class="w-full p-4 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">{{ old('field_values.' . $key, $currentValue) }}</textarea>

                        @elseif($type === 'select')
                            <select name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }}
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Pilih {{ $label }} --</option>
                                @foreach($options as $opt)
                                    <option value="{{ $opt }}" {{ old('field_values.' . $key, $currentValue) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>

                        @elseif($type === 'date')
                            <input type="date" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key, $currentValue) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        @elseif($type === 'number')
                            <input type="number" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key, $currentValue) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">

                        @else
                            <input type="text" name="field_values[{{ $key }}]" id="field_{{ $key }}" {{ $required ? 'required' : '' }} value="{{ old('field_values.' . $key, $currentValue) }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-indigo-500">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('submissions.show', $submission) }}" class="px-5 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-semibold text-sm transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all shadow-lg shadow-indigo-600/30">
                Update Draf Permohonan
            </button>
        </div>
    </form>
</div>
@endsection
