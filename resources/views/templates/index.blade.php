@extends('layouts.app')

@section('title', 'Kelola Template SK')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-800/80 p-6 rounded-2xl border border-slate-700/60 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Kelola Template SK</h1>
            <p class="text-sm text-slate-400 mt-1">Daftar jenis & struktur dokumen Surat Keputusan produk hukum kecamatan</p>
        </div>
        <div>
            <a href="{{ route('templates.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold transition-all shadow-lg shadow-indigo-600/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Template Baru
            </a>
        </div>
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

    <!-- Templates Table Card -->
    <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/60 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/60">
                    <tr>
                        <th class="px-6 py-4">Kode Template</th>
                        <th class="px-6 py-4">Judul Dokumen SK</th>
                        <th class="px-6 py-4">Bidang Dinamis</th>
                        <th class="px-6 py-4">Jumlah Pengajuan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/60">
                    @forelse($templates as $template)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-semibold text-indigo-400">
                                {{ $template->code }}
                            </td>
                            <td class="px-6 py-4 font-medium text-white">
                                {{ $template->title }}
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-400">
                                <span class="px-2.5 py-1 rounded-full bg-slate-900 border border-slate-700 font-semibold text-slate-300">
                                    {{ count($template->dynamic_fields ?? []) }} Variabel
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-400">
                                {{ $template->submissions_count }} Dokumen
                            </td>
                            <td class="px-6 py-4">
                                @if($template->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-700 text-slate-400 border border-slate-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('templates.show', $template) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-medium transition-colors">
                                    Detail
                                </a>
                                <a href="{{ route('templates.edit', $template) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 text-xs font-medium transition-colors border border-indigo-500/30">
                                    Edit
                                </a>
                                <form action="{{ route('templates.destroy', $template) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-rose-500/20 hover:bg-rose-500/40 text-rose-300 text-xs font-medium transition-colors border border-rose-500/30">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Belum ada template SK yang terdaftar. Klik "Tambah Template Baru" untuk membuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($templates->hasPages())
            <div class="px-6 py-4 border-t border-slate-700/60">
                {{ $templates->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
