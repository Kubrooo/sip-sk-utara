@extends('layouts.app')

@section('title', 'Daftar Pengajuan SK')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Daftar Pengajuan SK</h1>
            <p class="text-sm text-slate-400 mt-1">Kelola dan pantau alur verifikasi draf Surat Keputusan</p>
        </div>
        @role('admin_kelurahan')
        <div>
            <a href="{{ route('submissions.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold transition-all shadow-lg shadow-indigo-600/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengajuan SK Baru
            </a>
        </div>
        @endrole
    </div>

    <!-- Alert Messages -->
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

    <!-- Submissions Table Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/60 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/60">
                    <tr>
                        <th class="px-6 py-4">Kode Tracking</th>
                        <th class="px-6 py-4">Nomor SK</th>
                        <th class="px-6 py-4">Jenis Template</th>
                        <th class="px-6 py-4">Kelurahan Pengaju</th>
                        <th class="px-6 py-4">Status Verifikasi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    @forelse($submissions as $submission)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-indigo-400">
                                {{ $submission->tracking_code }}
                            </td>
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-200">
                                {{ $submission->sk_number ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-white">
                                {{ $submission->template->title ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-300">
                                {{ $submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $submission->status->badgeClass() }}">
                                    {{ $submission->status->label() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('submissions.show', $submission) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                                    Detail & Status
                                </a>
                                @if($submission->status === App\Enums\SubmissionStatus::APPROVED)
                                    <a href="{{ route('submissions.pdf', $submission) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600/40 text-emerald-300 text-xs font-medium transition-colors border border-emerald-500/30">
                                        📄 Unduh PDF TTE
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Belum ada permohonan SK.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($submissions->hasPages())
            <div class="px-6 py-4 border-t border-slate-700/60">
                {{ $submissions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
