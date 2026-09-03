<!DOCTYPE html>
<html lang="id" class="h-full">
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full flex flex-col justify-between select-none overflow-x-hidden min-h-screen transition-colors duration-300" 
      :class="darkMode ? 'bg-[#08091a] text-slate-100' : 'bg-slate-50 text-slate-900'"
      x-data="{
          darkMode: localStorage.getItem('theme') === 'light' ? false : true,
          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
          },
          showPassword: false,
          fillAccount(email) {
              document.getElementById('email').value = email;
              document.getElementById('password').value = 'password123';
          }
      }">

    <div class="min-h-screen w-full flex flex-col lg:flex-row relative">
        
        <!-- Left Side: Hero / Wave Section -->
        <div class="relative lg:w-5/12 xl:w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-900 to-[#0c0d28] p-8 lg:p-16 flex flex-col justify-between overflow-hidden min-h-[420px] lg:min-h-screen">
            
            <!-- Curved Wave Overlay on Desktop -->
            <svg class="absolute top-0 bottom-0 -right-1 h-full w-28 lg:w-36 pointer-events-none z-10 hidden lg:block transition-colors duration-300" 
                 :class="darkMode ? 'text-[#08091a]' : 'text-slate-50'"
                 preserveAspectRatio="none" viewBox="0 0 100 100">
                <path d="M 100 0 C 30 25, 80 50, 20 75 C 5 88, 50 96, 100 100 Z" fill="currentColor"></path>
            </svg>

            <!-- Background Decorative Glow Shapes -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Top Header on Left -->
            <div class="relative z-20 space-y-3">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs text-indigo-100 font-medium">
                    <span class="w-2 h-2 rounded-full bg-indigo-300 animate-pulse"></span>
                    Sistem Informasi Resmi
                </div>
                <p class="text-indigo-200 text-sm font-medium tracking-wide">Selamat Datang Kembali!</p>
                <h1 class="text-3xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    SIP-SK Pekalongan Utara
                </h1>
                <p class="text-indigo-200/80 text-xs lg:text-sm max-w-md leading-relaxed">
                    Sistem Pembuatan Surat Keputusan & Produk Hukum Daerah Kecamatan Pekalongan Utara.
                </p>
            </div>

            <!-- Feature Highlights List -->
            <div class="relative z-20 my-8 lg:my-0 space-y-4 max-w-md">
                <!-- Feature 1: Analytics -->
                <div class="flex items-center gap-4 p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 transition-all duration-300 shadow-lg shadow-black/10">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/25 border border-indigo-300/30 flex items-center justify-center text-indigo-200 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Lacak Status Real-Time</h4>
                        <p class="text-indigo-100/70 text-xs mt-0.5">Pantau alur verifikasi & persetujuan SK secara terintegrasi</p>
                    </div>
                </div>

                <!-- Feature 2: Security -->
                <div class="flex items-center gap-4 p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 transition-all duration-300 shadow-lg shadow-black/10">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/25 border border-indigo-300/30 flex items-center justify-center text-indigo-200 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Keamanan & Proteksi</h4>
                        <p class="text-indigo-100/70 text-xs mt-0.5">Proteksi dokumen resmi & verifikasi terenkripsi</p>
                    </div>
                </div>

                <!-- Feature 3: Speed -->
                <div class="flex items-center gap-4 p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 transition-all duration-300 shadow-lg shadow-black/10">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/25 border border-indigo-300/30 flex items-center justify-center text-indigo-200 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-bold text-sm">Proses Cepat & Efisien</h4>
                        <p class="text-indigo-100/70 text-xs mt-0.5">Pengajuan, validasi, hingga penerbitan tanpa hambatan</p>
                    </div>
                </div>
            </div>

            <!-- Footer note on left -->
            <div class="relative z-20 hidden lg:block text-xs text-indigo-200/60 font-medium">
                &copy; <?php echo e(date('Y')); ?> Pemerintah Kecamatan Pekalongan Utara. All rights reserved.
            </div>
        </div>

        <!-- Right Side: Login Form Section -->
        <div class="relative lg:w-7/12 xl:w-1/2 flex flex-col justify-center items-center p-6 lg:p-12 z-20 min-h-screen transition-colors duration-300"
             :class="darkMode ? 'bg-[#08091a]' : 'bg-slate-50'">
            
            <!-- Top Right Corner Bar (Theme Toggle + Sign In Badge) -->
            <div class="absolute top-6 right-6 flex items-center gap-3">
                <!-- Theme Toggle Button -->
                <button type="button" @click="toggleTheme()" 
                        class="p-2.5 rounded-full transition-all duration-200 focus:outline-none flex items-center justify-center shadow-sm"
                        :class="darkMode ? 'bg-slate-900 text-amber-400 border border-slate-800 hover:bg-slate-800' : 'bg-white text-indigo-600 border border-slate-200 hover:bg-slate-100'"
                        :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                    <!-- Sun Icon (Shown in Dark Mode) -->
                    <svg x-show="darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <!-- Moon Icon (Shown in Light Mode) -->
                    <svg x-show="!darkMode" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <span class="px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm transition-colors duration-300"
                      :class="darkMode ? 'bg-indigo-950/80 border border-indigo-500/30 text-indigo-300' : 'bg-indigo-100 border border-indigo-200 text-indigo-700'">
                    Sign In
                </span>
            </div>

            <div class="w-full max-w-md space-y-6 my-auto pt-10 lg:pt-0">
                
                <!-- Circular Icon Badge Header -->
                <div class="flex flex-col items-center text-center space-y-3">
                    <div class="relative flex items-center justify-center w-20 h-20 rounded-full transition-colors duration-300"
                         :class="darkMode ? 'bg-indigo-950/80 border-2 border-indigo-500/40 text-indigo-400 shadow-xl shadow-indigo-950/60' : 'bg-indigo-100 border-2 border-indigo-300 text-indigo-600 shadow-xl shadow-indigo-200/50'">
                        <div class="absolute inset-0 rounded-full bg-indigo-500/10 animate-ping opacity-25"></div>
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight transition-colors duration-300"
                            :class="darkMode ? 'text-white' : 'text-slate-900'">Login to your account</h2>
                        <p class="text-xs mt-1.5 transition-colors duration-300"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">Enter your credentials to continue</p>
                    </div>
                </div>

                <!-- Error Messages Alert -->
                <?php if($errors->any()): ?>
                    <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs leading-relaxed">
                        <div class="font-semibold mb-1 text-rose-200">Gagal Masuk:</div>
                        <ul class="list-disc list-inside space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="<?php echo e(route('login.store')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <!-- Email Field -->
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-semibold transition-colors duration-300"
                               :class="darkMode ? 'text-slate-300' : 'text-slate-700'">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required 
                                placeholder="Enter your email address" 
                                value="<?php echo e(old('email')); ?>"
                                class="w-full pl-11 pr-4 py-3.5 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium transition-all shadow-sm"
                                :class="darkMode ? 'bg-slate-900 text-white placeholder-slate-500 border-slate-800' : 'bg-white text-slate-900 placeholder-slate-400 border-slate-300'">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-semibold transition-colors duration-300"
                               :class="darkMode ? 'text-slate-300' : 'text-slate-700'">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required 
                                placeholder="Enter your password"
                                class="w-full pl-11 pr-11 py-3.5 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium transition-all shadow-sm"
                                :class="darkMode ? 'bg-slate-900 text-white placeholder-slate-500 border-slate-800' : 'bg-white text-slate-900 placeholder-slate-400 border-slate-300'">
                            
                            <!-- Toggle Show/Hide Password -->
                            <button type="button" @click="showPassword = !showPassword" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 013.682-.963c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m-1.74 1.74a3 3 0 11-4.243-4.243M9.878 9.878l4.242 4.242M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember me & Forgot password -->
                    <div class="flex items-center justify-between text-xs py-1">
                        <label class="flex items-center gap-2 cursor-pointer transition-colors"
                               :class="darkMode ? 'text-slate-300 hover:text-white' : 'text-slate-700 hover:text-slate-900'">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 focus:ring-offset-0"
                                   :class="darkMode ? 'bg-slate-800 border-slate-700' : 'bg-white border-slate-300'">
                            <span class="font-medium">Remember me</span>
                        </label>
                        <a href="javascript:void(0)" @click="fillAccount('admin.kecamatan@pekalonganutara.go.id')" 
                           class="transition-colors font-medium"
                           :class="darkMode ? 'text-slate-400 hover:text-blue-400' : 'text-slate-500 hover:text-blue-600'">
                            Forgot password ?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-bold text-sm transition-all duration-200 shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2">
                        <span>Continue</span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative flex items-center justify-center my-4">
                    <div class="border-t w-full transition-colors duration-300"
                         :class="darkMode ? 'border-slate-800' : 'border-slate-300'"></div>
                    <span class="px-3 text-xs font-medium absolute transition-colors duration-300"
                          :class="darkMode ? 'bg-[#08091a] text-slate-500' : 'bg-slate-50 text-slate-400'">or</span>
                </div>

                <!-- Quick Demo Accounts Option -->
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="w-full py-3.5 px-4 rounded-xl font-semibold text-sm transition-all duration-200 border shadow-sm flex items-center justify-center gap-2.5"
                        :class="darkMode ? 'bg-slate-900 hover:bg-slate-800 text-slate-200 border-slate-800' : 'bg-white hover:bg-slate-100 text-slate-700 border-slate-300'">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z"/>
                        </svg>
                        <span>Pilih Akun Demo (Quick Fill)</span>
                        <svg class="w-4 h-4 ml-auto text-slate-400 transform transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Demo Options Menu -->
                    <div x-show="open" x-cloak 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="mt-2 p-2 rounded-xl border shadow-xl space-y-1.5 z-30 relative transition-colors duration-300"
                         :class="darkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200'">
                        <button type="button" @click="fillAccount('kelurahan.krapyak@pekalonganutara.go.id'); open = false;"
                            class="w-full text-left px-3.5 py-2.5 rounded-xl transition-all flex justify-between items-center group text-xs"
                            :class="darkMode ? 'bg-slate-800/80 hover:bg-indigo-600/20 text-slate-100' : 'bg-slate-50 hover:bg-indigo-100/60 text-slate-900 border border-slate-200 shadow-2xs'">
                            <span class="font-bold group-hover:text-indigo-600 transition-colors">🏛️ Admin Kelurahan Krapyak</span>
                            <span class="font-mono text-[10px] font-bold px-2 py-0.5 rounded"
                                  :class="darkMode ? 'bg-slate-800 text-indigo-300 border border-indigo-500/30' : 'bg-indigo-100 text-indigo-800 border border-indigo-200'">admin_kelurahan</span>
                        </button>
                        <button type="button" @click="fillAccount('admin.kecamatan@pekalonganutara.go.id'); open = false;"
                            class="w-full text-left px-3.5 py-2.5 rounded-xl transition-all flex justify-between items-center group text-xs"
                            :class="darkMode ? 'bg-slate-800/80 hover:bg-amber-600/20 text-slate-100' : 'bg-slate-50 hover:bg-amber-100/60 text-slate-900 border border-slate-200 shadow-2xs'">
                            <span class="font-bold group-hover:text-amber-700 transition-colors">🏢 Admin Kecamatan (Verifikator) Pekalongan Utara</span>
                            <span class="font-mono text-[10px] font-bold px-2 py-0.5 rounded"
                                  :class="darkMode ? 'bg-slate-800 text-amber-400 border border-amber-500/30' : 'bg-amber-100 text-amber-900 border border-amber-300'">admin_kecamatan</span>
                        </button>
                        <button type="button" @click="fillAccount('hukum.setda@pekalonganutara.go.id'); open = false;"
                            class="w-full text-left px-3.5 py-2.5 rounded-xl transition-all flex justify-between items-center group text-xs"
                            :class="darkMode ? 'bg-slate-800/80 hover:bg-blue-600/20 text-slate-100' : 'bg-slate-50 hover:bg-blue-100/60 text-slate-900 border border-slate-200 shadow-2xs'">
                            <span class="font-bold group-hover:text-blue-700 transition-colors">⚖️ Bagian Hukum Setda</span>
                            <span class="font-mono text-[10px] font-bold px-2 py-0.5 rounded"
                                  :class="darkMode ? 'bg-slate-800 text-blue-300 border border-blue-500/30' : 'bg-blue-100 text-blue-900 border border-blue-200'">bagian_hukum</span>
                        </button>
                        <button type="button" @click="fillAccount('camat@pekalonganutara.go.id'); open = false;"
                            class="w-full text-left px-3.5 py-2.5 rounded-xl transition-all flex justify-between items-center group text-xs"
                            :class="darkMode ? 'bg-slate-800/80 hover:bg-purple-600/20 text-slate-100' : 'bg-slate-50 hover:bg-purple-100/60 text-slate-900 border border-slate-200 shadow-2xs'">
                            <span class="font-bold group-hover:text-purple-700 transition-colors">✍️ Camat Pekalongan Utara</span>
                            <span class="font-mono text-[10px] font-bold px-2 py-0.5 rounded"
                                  :class="darkMode ? 'bg-slate-800 text-purple-300 border border-purple-500/30' : 'bg-purple-100 text-purple-900 border border-purple-200'">camat</span>
                        </button>
                    </div>
                </div>

                <!-- Footer Help Link -->
                <div class="text-center pt-2">
                    <p class="text-xs transition-colors duration-300"
                       :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        Need help ? <a href="mailto:admin@pekalonganutara.go.id" class="text-blue-500 hover:text-blue-600 font-semibold transition-colors">Contact admin</a>
                    </p>
                </div>

            </div>

        </div>

    </div>

</body>
</html>
<?php /**PATH D:\sip-sk-utara\resources\views/auth/login.blade.php ENDPATH**/ ?>