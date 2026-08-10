<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIP-SK Pekalongan Utara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4" x-data="{
    fillAccount(email) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = 'password123';
    }
}">
    <div class="w-full max-w-md">
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600/20 text-indigo-400 mb-4 ring-1 ring-indigo-500/30">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">SIP-SK Pekalongan Utara</h1>
            <p class="text-sm text-slate-400 mt-1">Sistem Informasi Pembuatan Surat Keputusan (Produk Hukum)</p>
        </div>

        <!-- Card Container -->
        <div class="bg-slate-800/80 border border-slate-700/60 backdrop-blur-xl rounded-2xl p-6 sm:p-8 shadow-2xl shadow-indigo-950/50">
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
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
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Email Akun</label>
                    <input type="email" name="email" id="email" required placeholder="email@pekalonganutara.go.id" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Kata Sandi</label>
                    <input type="password" name="password" id="password" required placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm">
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm transition-all duration-200 shadow-lg shadow-indigo-600/30 active:scale-[0.98]">
                    Masuk ke Sistem
                </button>
            </form>

            <!-- Quick Demo Accounts Switcher -->
            <div class="mt-8 pt-6 border-t border-slate-700/60">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-3 text-center">Akun Pengujian Demo (Klik untuk Isi):</p>
                <div class="grid grid-cols-1 gap-2 text-xs">
                    <button type="button" @click="fillAccount('kelurahan.krapyak@pekalonganutara.go.id')"
                        class="text-left px-3 py-2 rounded-lg bg-slate-900/60 hover:bg-slate-700 border border-slate-700/50 text-slate-300 transition-colors flex justify-between items-center">
                        <span>🏛️ Admin Kelurahan Krapyak</span>
                        <span class="text-[10px] text-slate-500">admin_kelurahan</span>
                    </button>
                    <button type="button" @click="fillAccount('admin.kecamatan@pekalonganutara.go.id')"
                        class="text-left px-3 py-2 rounded-lg bg-slate-900/60 hover:bg-slate-700 border border-slate-700/50 text-slate-300 transition-colors flex justify-between items-center">
                        <span>🏢 Admin Kecamatan Pekalongan Utara</span>
                        <span class="text-[10px] text-slate-500">admin_kecamatan</span>
                    </button>
                    <button type="button" @click="fillAccount('hukum.setda@pekalonganutara.go.id')"
                        class="text-left px-3 py-2 rounded-lg bg-slate-900/60 hover:bg-slate-700 border border-slate-700/50 text-slate-300 transition-colors flex justify-between items-center">
                        <span>⚖️ Bagian Hukum (Setda)</span>
                        <span class="text-[10px] text-slate-500">bagian_hukum</span>
                    </button>
                    <button type="button" @click="fillAccount('camat@pekalonganutara.go.id')"
                        class="text-left px-3 py-2 rounded-lg bg-slate-900/60 hover:bg-slate-700 border border-slate-700/50 text-slate-300 transition-colors flex justify-between items-center">
                        <span>✍️ Camat Pekalongan Utara</span>
                        <span class="text-[10px] text-slate-500">camat</span>
                    </button>
                </div>
            </div>

        </div>

        <p class="text-center text-xs text-slate-500 mt-6">
            &copy; 2026 Pemerintah Kecamatan Pekalongan Utara. All rights reserved.
        </p>
    </div>
</body>
</html>
