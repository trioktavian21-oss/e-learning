@extends('layouts.user')

@section('title', 'Profil Saya')
@section('header', 'Identitas Siswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 animate-fade-in">
    <!-- Breadcrumb -->
    <nav class="flex text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="{{ route('user.dashboard') }}" class="hover:text-brand-600 transition">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900">Profil Saya</span>
    </nav>

    <!-- Profile Identity Card -->
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/60 overflow-hidden relative">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-600 rounded-full blur-[120px] opacity-[0.07] -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-600 rounded-full blur-[100px] opacity-[0.05] -ml-32 -mb-32"></div>
        
        <div class="relative z-10 p-8 md:p-16 flex flex-col lg:flex-row items-center lg:items-start gap-12 lg:gap-20">
            <!-- Profile Photo Section -->
            <div class="relative group">
                <div class="w-56 h-72 rounded-[2.5rem] overflow-hidden border-4 border-white shadow-2xl relative z-10 ring-1 ring-slate-100 transition duration-500 group-hover:scale-[1.02]">
                    @if($user && $user->profile_photo_url && !str_contains($user->profile_photo_url, 'ui-avatars'))
                        <img src="{{ $user->profile_photo_url }}" alt="Profile" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                            <svg class="w-20 h-20 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                </div>
                <!-- Status Overlay Icon -->
                <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-white rounded-2xl shadow-xl flex items-center justify-center text-brand-600 z-20 border border-slate-50 group-hover:rotate-12 transition duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
            </div>

            <!-- Profile Info Section -->
            <div class="flex-grow space-y-10 w-full lg:w-auto">
                <div>
                    <span class="inline-flex items-center px-4 py-1.5 bg-brand-50 text-brand-600 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border border-brand-100 shadow-sm mb-4">
                        Data Identitas
                    </span>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight leading-none mb-2">{{ $user->name }}</h2>
                    <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Siswa Pelajar Aktif • Kelas {{ $user->kelas ?? 'N/A' }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div class="space-y-1">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block">Email Akademik</span>
                        <div class="flex items-center space-x-3 text-slate-700 font-black">
                            <svg class="w-4 h-4 text-brand-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block">Nomor Induk Siswa (NISN)</span>
                        <div class="flex items-center space-x-3 text-slate-700 font-black">
                            <svg class="w-4 h-4 text-blue-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            <span>{{ $user->nisn }}</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block">Status Akun</span>
                        <div class="flex items-center space-x-2">
                             <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                             <span class="text-slate-700 font-black">Terverifikasi</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block">Bergabung Sejak</span>
                        <div class="flex items-center space-x-3 text-slate-700 font-black">
                            <svg class="w-4 h-4 text-blue-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-50 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('profile.show') }}" class="inline-flex items-center justify-center px-8 py-4 bg-brand-600 hover:bg-brand-700 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest transition shadow-xl shadow-brand-600/20 active:scale-95 group">
                        Update Profil
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Information -->
    <div class="bg-slate-900 rounded-[2.5rem] p-10 md:p-12 text-white/90 relative overflow-hidden group">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-1000"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
            <div class="w-24 h-24 bg-white/5 rounded-3xl flex items-center justify-center text-blue-400 shadow-inner ring-1 ring-white/10 shrink-0">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-black tracking-tight mb-2 uppercase">Keamanan Akun</h3>
                <p class="text-sm text-slate-400 font-medium leading-relaxed max-w-xl italic">
                    Keamanan data akademik Anda adalah prioritas utama kami. Pastikan untuk selalu menggunakan kata sandi yang kuat dan unik untuk menjaga kerahasiaan identitas digital Anda.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
