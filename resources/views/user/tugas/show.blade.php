@extends('layouts.user')

@section('title', 'Detail Tugas - ' . $tugas->judul)
@section('header', 'Tinjau Tugas')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in">
    <!-- Breadcrumb -->
    <nav class="flex text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="{{ route('user.dashboard') }}" class="hover:text-blue-600 transition">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('user.tugas.index') }}" class="hover:text-blue-600 transition">Tugas</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900">Detail</span>
    </nav>

    <!-- Main Assignment Card -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500 rounded-full blur-[100px] opacity-10 -mr-32 -mt-32"></div>
        
        <div class="p-8 md:p-12 relative z-10">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-8 mb-10">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-4 py-1.5 bg-blue-50 text-blue-600 rounded-xl text-[10px] font-black uppercase tracking-widest border border-blue-100 shadow-sm">
                        Materi Belajar
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">{{ $tugas->judul }}</h2>
                    <div class="flex items-center space-x-4 text-xs font-bold text-slate-400">
                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> Kelas {{ $tugas->kelas }}</span>
                        <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $tugas->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <a href="{{ Storage::url($tugas->file) }}" target="_blank" class="flex items-center justify-center space-x-3 px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl transition active:scale-95 group">
                    <svg class="w-5 h-5 group-hover:translate-y-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>Download Materi</span>
                </a>
            </div>

            @if(session('success'))
                <div class="flex items-center space-x-3 bg-emerald-50 border-2 border-emerald-100 p-6 rounded-3xl mb-10 text-emerald-700 animate-bounce-subtle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-black uppercase tracking-wider">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Submission Area -->
            <div class="bg-slate-50 rounded-[2rem] border border-slate-100 p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-slate-900 tracking-tight uppercase tracking-widest">Progress Koleksi</h3>
                    @if($tugasKumpul)
                        <span class="px-4 py-1.5 bg-emerald-500/10 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-emerald-500/20">Terkirim</span>
                    @else
                        <span class="px-4 py-1.5 bg-rose-500/10 text-rose-600 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-rose-500/20">Menanti</span>
                    @endif
                </div>

                @if($tugasKumpul)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="bg-white p-6 rounded-3xl border border-slate-200/50 shadow-sm relative group">
                            <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest block mb-4">File Terunggah</span>
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-600 truncate mr-4 italic">Berhasil dikirimkan</span>
                                <a href="{{ Storage::url($tugasKumpul->file) }}" target="_blank" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-3xl border border-slate-200/50 shadow-sm">
                            <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest block mb-1">Skor Akhir</span>
                            <div class="flex items-baseline space-x-2">
                                <span class="text-3xl font-black text-slate-900">{{ $tugasKumpul->nilai ?? '--' }}</span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">/ 100</span>
                            </div>
                            @if($tugasKumpul->komentar)
                                <div class="mt-4 pt-4 border-t border-slate-50 italic text-[10px] text-slate-400">
                                    "{{ $tugasKumpul->komentar }}"
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <form action="{{ route('user.tugas.upload', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">
                             {{ $tugasKumpul ? 'Ganti Berkas Pengumpulan' : 'Mulai Pengumpulan Berkas' }}
                        </h4>
                        
                        <label class="block group/upload cursor-pointer">
                            <div class="w-full flex flex-col items-center justify-center p-10 bg-white border-2 border-dashed border-slate-200 rounded-[2rem] hover:bg-white hover:border-blue-400 transition-all duration-300 shadow-sm group-hover/upload:shadow-inner">
                                <svg class="w-12 h-12 text-slate-200 group-hover/upload:text-blue-500 mb-4 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <input type="file" name="file" class="hidden" accept=".pdf,.doc,.docx,.zip" required onchange="this.closest('label').querySelector('.fname').textContent = this.files[0].name ">
                                <div class="text-center">
                                    <span class="fname text-sm font-black text-slate-400 uppercase tracking-widest group-hover/upload:text-slate-900 transition block">Pilih File Tugas</span>
                                    <span class="text-[10px] text-slate-300 font-medium">PDF, DOC, DOCX atau ZIP (Max 5MB)</span>
                                </div>
                            </div>
                        </label>
                        @error('file')
                            <p class="text-rose-600 text-[10px] font-black uppercase tracking-widest mt-2 ml-4">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white rounded-[1.5rem] font-black text-xs uppercase tracking-[0.3em] shadow-xl shadow-blue-600/20 transition active:scale-95">
                            Kompilasi & Kirim Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
