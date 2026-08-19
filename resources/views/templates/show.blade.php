@extends('layouts.app')

@section('title', 'Detail Template SK - ' . $template->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <span class="font-mono text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                {{ $template->code }}
            </span>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-2">{{ $template->title }}</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('templates.edit', $template) }}" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold transition-colors">
                Edit Template
            </a>
            <a href="{{ route('templates.index') }}" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-medium transition-colors">
                &larr; Kembali
            </a>
        </div>
    </div>

    <!-- Dynamic Fields Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
        <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Daftar Variabel Input Dinamis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($template->dynamic_fields ?? [] as $field)
                <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/80 space-y-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-white text-sm">{{ $field['label'] ?? '' }}</span>
                        <span class="font-mono text-xs text-indigo-400">@{{ {{ $field['name'] ?? '' }} }}</span>
                    </div>
                    <div class="text-xs text-slate-400 flex gap-2 pt-1">
                        <span class="px-2 py-0.5 rounded bg-slate-800 border border-slate-700 uppercase font-mono text-[10px]">Tipe: {{ $field['type'] ?? 'text' }}</span>
                        @if(!empty($field['required']))
                            <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 border border-rose-500/30 font-semibold text-[10px]">Wajib</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Preview Raw Template Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
        <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Struktur HTML Template Body</h2>
        <pre class="p-4 rounded-xl bg-slate-900 border border-slate-700/80 font-mono text-xs text-slate-300 overflow-x-auto whitespace-pre-wrap leading-relaxed">{{ $template->html_template }}</pre>
    </div>
</div>
@endsection
