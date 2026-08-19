<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Keaslian Surat Keputusan - Pekalongan Utara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl space-y-6">

        <!-- Header Brand -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600/20 text-indigo-400 mb-2 ring-1 ring-indigo-500/30">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Portal Verifikasi Keaslian SK</h1>
            <p class="text-xs text-slate-400">Pemerintah Kecamatan Pekalongan Utara, Kota Pekalongan</p>
        </div>

        @if($submission)
            <!-- Valid Official Document Card -->
            <div class="bg-slate-900 border border-emerald-500/40 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-emerald-950/40 space-y-6">

                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-emerald-300">DOKUMEN RESMI TERDAFTAR</h3>
                        <p class="text-xs text-emerald-400/80">Dokumen Surat Keputusan ini terverifikasi asli di database resmi Kecamatan Pekalongan Utara.</p>
                    </div>
                </div>

                <div class="space-y-4 divide-y divide-slate-800 text-sm">
                    <div class="pt-2">
                        <span class="text-xs text-slate-400 block uppercase font-semibold">Nomor SK Resmi</span>
                        <strong class="text-base font-mono text-indigo-400">{{ $submission->sk_number }}</strong>
                    </div>

                    <div class="pt-3">
                        <span class="text-xs text-slate-400 block uppercase font-semibold">Judul Produk Hukum</span>
                        <span class="text-base font-semibold text-white">{{ $submission->template->title }}</span>
                    </div>

                    <div class="pt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-slate-400 block uppercase font-semibold">Kelurahan Pengaju</span>
                            <span class="text-slate-200 font-medium">{{ $submission->kelurahan->kelurahan_name ?? $submission->kelurahan->name }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block uppercase font-semibold">Tanggal Pengesahan TTE</span>
                            <span class="text-slate-200 font-medium">{{ $submission->approved_at ? $submission->approved_at->translatedFormat('d F Y H:i') : '-' }}</span>
                        </div>
                    </div>

                    <div class="pt-3">
                        <span class="text-xs text-slate-400 block uppercase font-semibold">Pejabat Penandatangan TTE</span>
                        <span class="text-slate-200 font-medium">{{ $submission->approver->name ?? 'Camat Pekalongan Utara' }}</span>
                        <span class="text-xs text-slate-400 block">NIP: {{ $submission->approver->nip ?? '-' }}</span>
                    </div>

                    <div class="pt-3">
                        <span class="text-xs text-slate-400 block uppercase font-semibold">Kode Hash Keamanan SHA-256</span>
                        <code class="text-[10px] font-mono text-emerald-400 break-all block bg-slate-950 p-2.5 rounded-xl border border-slate-800 mt-1">
                            {{ $submission->tte_hash }}
                        </code>
                    </div>
                </div>

                @if(Auth::check())
                    <div class="pt-4 text-center">
                        <a href="{{ route('submissions.pdf', $submission) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-sm transition-all shadow-lg shadow-emerald-600/30">
                            📄 Unduh Dokumen Asli (PDF)
                        </a>
                    </div>
                @endif
            </div>
        @else
            <!-- Invalid / Not Found Document Card -->
            <div class="bg-slate-900 border border-rose-500/40 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-rose-950/40 space-y-6 text-center">
                <div class="w-16 h-16 rounded-full bg-rose-500/10 border border-rose-500/30 text-rose-400 mx-auto flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg text-rose-300">DOKUMEN TIDAK DITEMUK ATAU TIDAK VALID</h3>
                    <p class="text-xs text-slate-400 mt-1">Kode Hash TTE QR Code tidak cocok dengan arsip dokumen resmi mana pun.</p>
                </div>
                <div class="pt-2">
                    <code class="text-[11px] font-mono text-slate-500 bg-slate-950 p-2 rounded-lg border border-slate-800 break-all">
                        Hash: {{ $hash }}
                    </code>
                </div>
            </div>
        @endif

        <p class="text-center text-xs text-slate-500">
            &copy; 2026 Pemerintah Kecamatan Pekalongan Utara. All rights reserved.
        </p>

    </div>

</body>
</html>
