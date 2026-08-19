@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Premium Hero Banner -->
    <div class="glass-card p-8 md:p-10 rounded-3xl relative overflow-hidden shadow-2xl border border-indigo-500/20">
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-gradient-to-br from-indigo-500/20 via-indigo-600/10 to-transparent blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-3 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Sistem Aktif &amp; Siap Digunakan
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Selamat Datang, <span class="bg-gradient-to-r from-white via-slate-100 to-indigo-200 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Sistem Informasi Pembuatan Surat Keputusan (SIP-SK) Produk Hukum Kecamatan Pekalongan Utara. Kelola alur pengajuan, verifikasi teknis, hingga pengesahan TTE Camat secara digital.
                </p>
            </div>

            @role('admin_kelurahan')
            <div class="shrink-0">
                <a href="{{ route('submissions.create') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-bold text-sm transition-all duration-200 shadow-xl shadow-indigo-600/30 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Buat Pengajuan SK Baru</span>
                </a>
            </div>
            @endrole
        </div>
    </div>

    <!-- Stat Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <!-- Draf Kelurahan -->
        <div class="glass-card glass-card-hover p-6 rounded-2xl space-y-4 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Draf Kelurahan</span>
                <div class="w-8 h-8 rounded-xl bg-slate-800 border border-slate-700/60 flex items-center justify-center text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-white tracking-tight">{{ $stats['draft'] }}</div>
                <span class="text-[11px] text-slate-400 mt-1 block">Draf belum diajukan</span>
            </div>
        </div>

        <!-- Review Kecamatan -->
        <div class="glass-card glass-card-hover p-6 rounded-2xl space-y-4 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Verifikasi Kec.</span>
                <div class="w-8 h-8 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-amber-300 tracking-tight">{{ $stats['review_kecamatan'] }}</div>
                <span class="text-[11px] text-slate-400 mt-1 block">Menunggu verifikasi teknis</span>
            </div>
        </div>

        <!-- Review Hukum -->
        <div class="glass-card glass-card-hover p-6 rounded-2xl space-y-4 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Penomoran Setda</span>
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                </div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-blue-300 tracking-tight">{{ $stats['review_hukum'] }}</div>
                <span class="text-[11px] text-slate-400 mt-1 block">Menunggu nomor resmi</span>
            </div>
        </div>

        <!-- Ready Approval -->
        <div class="glass-card glass-card-hover p-6 rounded-2xl space-y-4 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-purple-400">Siap TTE Camat</span>
                <div class="w-8 h-8 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-purple-300 tracking-tight">{{ $stats['ready_approval'] }}</div>
                <span class="text-[11px] text-slate-400 mt-1 block">Menunggu pengesahan</span>
            </div>
        </div>

        <!-- Approved TTE -->
        <div class="glass-card glass-card-hover p-6 rounded-2xl space-y-4 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Disetujui TTE</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-emerald-300 tracking-tight">{{ $stats['approved'] }}</div>
                <span class="text-[11px] text-slate-400 mt-1 block">SK Terbit &amp; Sah</span>
            </div>
        </div>
    </div>

    <!-- Recent Submissions Data Table Card -->
    <div class="glass-card rounded-3xl p-6 md:p-8 space-y-5 shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-800/80 pb-5">
            <div>
                <h2 class="text-lg font-extrabold text-white tracking-tight">Pengajuan SK Terkini</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftar permohonan SK produk hukum yang baru dimasukkan atau diubah</p>
            </div>
            <a href="{{ route('submissions.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-colors">
                <span>Lihat Semua Permohonan</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/80 text-[11px] font-bold uppercase tracking-wider text-slate-400 rounded-xl border-b border-slate-800">
                    <tr>
                        <th class="px-5 py-3.5 rounded-l-xl">Kode Tracking</th>
                        <th class="px-5 py-3.5">Nomor SK Resmi</th>
                        <th class="px-5 py-3.5">Kelurahan Pengaju</th>
                        <th class="px-5 py-3.5">Jenis Template</th>
                        <th class="px-5 py-3.5">Status Alur</th>
                        <th class="px-5 py-3.5 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($recentSubmissions as $sub)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4 font-mono text-xs font-bold text-indigo-400">
                                {{ $sub->tracking_code }}
                            </td>
                            <td class="px-5 py-4 font-mono text-xs font-semibold text-slate-200">
                                {{ $sub->sk_number ?? 'Belum Terbit' }}
                            </td>
                            <td class="px-5 py-4 text-xs font-medium text-slate-200">
                                {{ $sub->kelurahan->kelurahan_name ?? $sub->kelurahan->name }}
                            </td>
                            <td class="px-5 py-4 text-xs font-bold text-white max-w-xs truncate">
                                {{ $sub->template->title ?? '-' }}
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold border {{ $sub->status->badgeClass() }}">
                                    {{ $sub->status->label() }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('submissions.show', $sub) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold transition-colors border border-slate-700/60">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 space-y-2">
                                <svg class="w-10 h-10 mx-auto text-slate-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-sm font-medium">Belum ada riwayat permohonan SK.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
