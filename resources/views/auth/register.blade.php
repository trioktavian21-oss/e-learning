<x-guest-layout>
    <div class="w-full max-w-lg">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-brand-600 rounded-[2rem] shadow-2xl shadow-brand-600/40 mb-6 text-white transition-transform hover:rotate-12 duration-500">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none mb-3">Daftar Akun.</h1>
            <p class="text-slate-500 font-medium tracking-wide">Mulai perjalanan akademik cerdas Anda.</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white p-8 sm:p-12 relative overflow-hidden group">
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <x-validation-errors class="mb-6" />

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 block">Nama Lengkap</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            class="block w-full pl-14 pr-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                            placeholder="Contoh: Muhammad Rafli">
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 block">Alamat Email</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                            class="block w-full pl-14 pr-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                            placeholder="nama@smartstudy.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 block">Sandi Rahasia</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="block w-full pl-14 pr-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 block">Konfirmasi Sandi</label>
                        <div class="relative group/input">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300 group-focus-within/input:text-brand-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="block w-full pl-14 pr-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold placeholder:text-slate-300 focus:bg-white focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 transition-all outline-none" 
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="px-2">
                        <label class="flex items-start cursor-pointer group/check">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="terms" id="terms" required class="w-5 h-5 border-2 border-slate-200 rounded-lg text-brand-600 focus:ring-brand-600/20 transition cursor-pointer">
                            </div>
                            <div class="ml-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                                Saya setuju dengan <a target="_blank" href="{{ route('terms.show') }}" class="text-brand-600 hover:text-brand-700 underline transition tracking-[0.1em]">Syarat Layanan</a> dan <a target="_blank" href="{{ route('policy.show') }}" class="text-brand-600 hover:text-brand-700 underline transition tracking-[0.1em]">Kebijakan Privasi</a>
                            </div>
                        </label>
                    </div>
                @endif

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-[0.4em] shadow-2xl shadow-slate-900/30 transition-all active:scale-95 group/btn">
                        Daftar Akun Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-12 pt-8 border-t border-slate-50 text-center">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">
                    Sudah memiliki hak akses? 
                    <a href="{{ route('login') }}" class="text-brand-600 hover:underline transition ml-2">Masuk ke Portal</a>
                </p>
            </div>
        </div>

        <footer class="mt-12 text-center">
            <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] italic">
                &copy; {{ date('Y') }} SmartStudy E-Learning System. All rights reserved.
            </p>
        </footer>
    </div>
</x-guest-layout>
