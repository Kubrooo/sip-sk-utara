<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Sistem - SIP-SK Pekalongan Utara</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-login {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glow-halo {
            position: absolute;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, rgba(0, 0, 0, 0) 70%);
            pointer-events: none;
        }
    </style>
</head>
<body class="h-full bg-slate-950 text-slate-100 flex items-center justify-center p-4 relative overflow-hidden select-none" x-data="{
    fillAccount(email) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = 'password123';
    }
}">

    <!-- Background Halo Effect -->
    <div class="glow-halo top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>

    <div class="w-full max-w-md relative z-10 space-y-6">

        <!-- Logo Header -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-800 text-white shadow-xl shadow-indigo-600/30 ring-1 ring-indigo-400/40">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">SIP-SK Pekalongan Utara</h1>
                <p class="text-xs text-slate-400 mt-1 font-medium">Sistem Informasi Pembuatan Surat Keputusan Produk Hukum</p>
            </div>
        </div>

        <!-- Login Card -->
        <div class="glass-login rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
            
            @if ($errors->any())
                <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs leading-relaxed">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-2">Email Akun Resmi</label>
                    <input type="email" name="email" id="email" required placeholder="email@pekalonganutara.go.id" value="{{ old('email') }}"
                        class="w-full px-4 py-3.5 rounded-2xl bg-slate-900/90 border border-slate-700/80 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-bold uppercase tracking-wider text-slate-300 mb-2">Kata Sandi (Password)</label>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="w-full px-4 py-3.5 rounded-2xl bg-slate-900/90 border border-slate-700/80 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded-md bg-slate-900 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                        <span class="font-medium text-slate-300">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-4 px-4 rounded-2xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-bold text-sm transition-all duration-200 shadow-xl shadow-indigo-600/30 active:scale-[0.98]">
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Quick Demo Accounts Switcher -->
            <div class="pt-6 border-t border-slate-800/80 space-y-3">
                <p class="text-[11px] font-bold uppercase tracking-wider text-indigo-400 text-center">Akun Pengujian Demo (Klik untuk Isi Otomatis):</p>
                <div class="grid grid-cols-1 gap-2 text-xs">
                    <button type="button" @click="fillAccount('kelurahan.krapyak@pekalonganutara.go.id')"
                        class="text-left px-3.5 py-2.5 rounded-xl bg-slate-900/80 hover:bg-indigo-600/20 border border-slate-800 hover:border-indigo-500/40 text-slate-200 transition-all flex justify-between items-center group">
                        <span class="font-medium group-hover:text-indigo-300">🏛️ Admin Kelurahan Krapyak</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 text-slate-400">admin_kelurahan</span>
                    </button>
                    <button type="button" @click="fillAccount('admin.kecamatan@pekalonganutara.go.id')"
                        class="text-left px-3.5 py-2.5 rounded-xl bg-slate-900/80 hover:bg-amber-600/20 border border-slate-800 hover:border-amber-500/40 text-slate-200 transition-all flex justify-between items-center group">
                        <span class="font-medium group-hover:text-amber-300">🏢 Admin Kecamatan Pekalongan Utara</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 text-slate-400">admin_kecamatan</span>
                    </button>
                    <button type="button" @click="fillAccount('hukum.setda@pekalonganutara.go.id')"
                        class="text-left px-3.5 py-2.5 rounded-xl bg-slate-900/80 hover:bg-blue-600/20 border border-slate-800 hover:border-blue-500/40 text-slate-200 transition-all flex justify-between items-center group">
                        <span class="font-medium group-hover:text-blue-300">⚖️ Bagian Hukum Setda</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 text-slate-400">bagian_hukum</span>
                    </button>
                    <button type="button" @click="fillAccount('camat@pekalonganutara.go.id')"
                        class="text-left px-3.5 py-2.5 rounded-xl bg-slate-900/80 hover:bg-purple-600/20 border border-slate-800 hover:border-purple-500/40 text-slate-200 transition-all flex justify-between items-center group">
                        <span class="font-medium group-hover:text-purple-300">✍️ Camat Pekalongan Utara</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-800 text-slate-400">camat</span>
                    </button>
                </div>
            </div>

        </div>

        <p class="text-center text-xs text-slate-500">
            &copy; 2026 Pemerintah Kecamatan Pekalongan Utara. All rights reserved.
        </p>
    </div>
</body>
</html>
