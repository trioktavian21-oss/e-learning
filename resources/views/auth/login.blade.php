<x-guest-layout>
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-600 rounded-[2rem] shadow-2xl shadow-brand-600/40 mb-6 text-white transition-transform hover:rotate-12 duration-500">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none mb-3">Selamat Datang.</h1>
            <p class="text-slate-500 font-medium tracking-wide">Akses portal belajar masa depan Anda.</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8 sm:p-12 relative overflow-hidden group">
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <x-validation-errors class="mb-6" />

            @if (session('status'))
                <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-700 text-[10px] font-black uppercase tracking-widest text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-8">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 block">Identitas Email</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                            class="block w-full pl-14 pr-5 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                            placeholder="admin@smartstudy.com">
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-2">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block">Sandi Rahasia</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[9px] font-black text-brand-600 uppercase tracking-widest hover:text-brand-700 transition">Lupa?</a>
                        @endif
                    </div>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pl-14 pr-5 py-5 bg-slate-50 border-2 border-slate-100 rounded-3xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center px-2">
                    <label class="flex items-center cursor-pointer group/check">
                        <input type="checkbox" name="remember" class="w-5 h-5 border-2 border-slate-200 rounded-lg text-brand-600 focus:ring-brand-600/20 transition cursor-pointer">
                        <span class="ml-3 text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover/check:text-slate-600 transition tracking-[0.1em]">Ingat Perangkat Saya</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-6 bg-slate-900 hover:bg-slate-800 text-white rounded-3xl font-black text-xs uppercase tracking-[0.4em] shadow-2xl shadow-slate-900/30 transition-all active:scale-95 group/btn">
                        Autentikasi Sekarang
                    </button>
                </div>
            </form>

            @if (Route::has('register'))
                <div class="mt-12 pt-8 border-t border-slate-50 text-center">
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">
                        Belum punya hak akses? 
                        <a href="{{ route('register') }}" class="text-brand-600 hover:underline transition ml-2">Daftar Akun Baru</a>
                    </p>
                </div>
            @endif
        </div>

        <footer class="mt-12 text-center">
            <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] italic">
                &copy; {{ date('Y') }} SmartStudy E-Learning System. All rights reserved.
            </p>
        </footer>
    </div>
</x-guest-layout>
