@extends('layouts.app')

@section('title', 'Detail Permohonan SK - ' . $submission->tracking_code)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center justify-between bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl gap-4">
        <div>
            <div class="flex items-center gap-3">
                <span class="font-mono text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                    {{ $submission->tracking_code }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $submission->status->badgeClass() }}">
                    {{ $submission->status->label() }}
                </span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight mt-2">{{ $submission->template->title ?? 'Surat Keputusan' }}</h1>
            <p class="text-xs text-slate-400 mt-1">Diajukan oleh: <strong class="text-slate-200">{{ $submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name }}</strong> • Pada {{ $submission->created_at->translatedFormat('d F Y H:i') }}</p>
        </div>

        <div class="flex flex-wrap gap-2">
            @if($submission->status === App\Enums\SubmissionStatus::DRAFT_KELURAHAN && Auth::user()->hasRole('admin_kelurahan'))
                <a href="{{ route('submissions.edit', $submission) }}" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white text-xs font-semibold transition-colors">
                    Edit Draf
                </a>
                <form action="{{ route('submissions.submit', $submission) }}" method="POST" class="inline-block" onsubmit="return confirm('Ajukan Draf SK ini ke Kecamatan untuk verifikasi teknis?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold transition-all shadow-lg shadow-indigo-600/30">
                        🚀 Ajukan ke Kecamatan
                    </button>
                </form>
            @endif

            <a href="{{ route('submissions.pdf', $submission) }}" target="_blank" class="px-4 py-2 rounded-xl bg-emerald-600/20 hover:bg-emerald-600/40 text-emerald-300 text-xs font-semibold transition-colors border border-emerald-500/30">
                📄 Preview / Unduh PDF
            </a>

            <a href="{{ route('submissions.index') }}" class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                &larr; Kembali
            </a>
        </div>
    </div>

    <!-- Alert Success/Error -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- Catatan Revisi / Penolakan (If Exists) -->
    @if($submission->revision_notes)
        <div class="p-5 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-200 space-y-1">
            <h4 class="font-bold text-sm text-amber-400 flex items-center gap-2">
                ⚠️ Catatan Revisi / Penolakan Terakhir:
            </h4>
            <p class="text-sm leading-relaxed">{{ $submission->revision_notes }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Field Values Detail (Left 2 Columns) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
                <h2 class="text-lg font-semibold text-white border-b border-slate-700/60 pb-3">Isi Variabel Dokumen SK</h2>
                <div class="space-y-4">
                    @foreach($submission->template->dynamic_fields ?? [] as $field)
                        @php
                            $key = $field['name'] ?? '';
                            $label = $field['label'] ?? $key;
                            $val = $submission->field_values[$key] ?? '-';
                        @endphp
                        <div class="p-4 rounded-xl bg-slate-900/60 border border-slate-700/80">
                            <span class="block text-xs uppercase font-semibold text-slate-400 mb-1">{{ $label }}</span>
                            <span class="text-sm text-white font-medium whitespace-pre-line">{{ is_array($val) ? implode(', ', $val) : $val }}</span>
                        </div>
                    @endforeach
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
                        <strong class="text-sm font-mono text-indigo-400">{{ $submission->sk_number ?? 'Belum Diterbitkan' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Penandatangan TTE:</span>
                        <strong class="text-sm text-white">{{ $submission->approver->name ?? '-' }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Waktu Pengesahan TTE:</span>
                        <strong class="text-sm text-white">{{ $submission->approved_at ? $submission->approved_at->translatedFormat('d F Y H:i') : '-' }}</strong>
                    </div>
                    @if($submission->tte_hash)
                        <div>
                            <span class="text-slate-400 block">SHA-256 Hash Verification:</span>
                            <code class="text-[10px] font-mono text-emerald-400 break-all block bg-slate-900 p-2 rounded border border-slate-700 mt-1">
                                {{ $submission->tte_hash }}
                            </code>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Audit Trail Log Timeline -->
            <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 shadow-xl space-y-4">
                <h3 class="text-base font-semibold text-white border-b border-slate-700/60 pb-3">Audit Trail Log</h3>
                <div class="space-y-4 relative before:absolute before:inset-0 before:left-3.5 before:w-0.5 before:bg-slate-700">
                    @forelse($submission->logs as $log)
                        <div class="relative pl-8 space-y-1">
                            <div class="absolute left-1.5 top-1.5 w-4 h-4 rounded-full bg-indigo-500 ring-4 ring-slate-800"></div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-white uppercase">{{ $log->action }}</span>
                                <span class="text-[10px] text-slate-400">{{ $log->created_at->translatedFormat('d/m/y H:i') }}</span>
                            </div>
                            <p class="text-xs text-slate-300">{{ $log->notes }}</p>
                            <span class="text-[10px] text-indigo-400 font-medium block">Oleh: {{ $log->user->name ?? 'Sistem' }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500">Belum ada riwayat audit trail.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
