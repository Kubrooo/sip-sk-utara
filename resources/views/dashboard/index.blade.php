<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - SIP-SK Pekalongan Utara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen">
    <!-- Top Navbar -->
    <header class="border-b border-slate-800 bg-slate-950/80 backdrop-blur px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold ring-1 ring-indigo-500/30">
                SK
            </div>
            <div>
                <h1 class="font-bold text-white leading-tight">SIP-SK Pekalongan Utara</h1>
                <p class="text-xs text-slate-400">Dashboard Manajemen Produk Hukum SK</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="text-xs text-indigo-400 font-mono">{{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-rose-600/20 hover:text-rose-300 text-slate-300 text-xs font-semibold border border-slate-700 transition-all">
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6 sm:p-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
            <p class="text-sm text-slate-400 mt-1">Sistem Informasi Pembuatan Surat Keputusan (Produk Hukum Kecamatan Pekalongan Utara).</p>
        </div>

        <!-- Role Badges & Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/60 shadow-xl">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Peran Anda</p>
                <p class="text-xl font-bold text-indigo-400 mt-2">{{ Auth::user()->roles->pluck('name')->first() }}</p>
                <p class="text-xs text-slate-500 mt-1">Akses & otorisasi aktif</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/60 shadow-xl">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Wilayah / Instansi</p>
                <p class="text-xl font-bold text-emerald-400 mt-2">{{ Auth::user()->kelurahan_name ? 'Kel. ' . Auth::user()->kelurahan_name : 'Kecamatan Pekalongan Utara' }}</p>
                <p class="text-xs text-slate-500 mt-1">Wilayah kerja aplikasi</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/60 shadow-xl">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Template SK Aktif</p>
                <p class="text-xl font-bold text-purple-400 mt-2">{{ \App\Models\SkTemplate::where('is_active', true)->count() }} Template</p>
                <p class="text-xs text-slate-500 mt-1">Siap digunakan draf</p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/60 shadow-xl">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Permohonan</p>
                <p class="text-xl font-bold text-amber-400 mt-2">{{ \App\Models\SkSubmission::count() }} Permohonan</p>
                <p class="text-xs text-slate-500 mt-1">Draf & verifikasi</p>
            </div>
        </div>

        <!-- Action Section -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-2xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Navigasi Modul Tim Developer</h3>
            <p class="text-sm text-slate-400 mb-6">Pilih modul tugas sesuai pembagian branch tim proyek SIP-SK-Utara:</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700/80">
                    <h4 class="font-bold text-indigo-400 mb-1">Developer 1 (Core & Workflow)</h4>
                    <p class="text-xs text-slate-400 mb-3">Backend Core, Migrasi Database, Models, Seeders & Workflow Engine.</p>
                    <span class="inline-block px-2.5 py-1 rounded bg-indigo-500/20 text-indigo-300 text-[11px] font-mono">Status: Completed & Synced</span>
                </div>

                <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700/80">
                    <h4 class="font-bold text-purple-400 mb-1">Developer 2 (Template & PDF Engine)</h4>
                    <p class="text-xs text-slate-400 mb-3">CRUD Template SK, Form Generator, Dompdf A4 & TTE QR Code Generator.</p>
                    <span class="inline-block px-2.5 py-1 rounded bg-purple-500/20 text-purple-300 text-[11px] font-mono">Branch: feature/template-pdf-tte</span>
                </div>

                <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700/80">
                    <h4 class="font-bold text-emerald-400 mb-1">Developer 3 (Frontend UI & Verifikasi)</h4>
                    <p class="text-xs text-slate-400 mb-3">Dashboard UI Responsive, Approval Modals & Portal Verifikasi Keaslian Publik.</p>
                    <span class="inline-block px-2.5 py-1 rounded bg-emerald-500/20 text-emerald-300 text-[11px] font-mono">Branch: feature/dashboard-verification-ui</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
