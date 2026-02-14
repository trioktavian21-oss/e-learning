@extends('layouts.admin')

@section('title', 'Beri Nilai Tugas')
@section('page_title', 'Penilaian Tugas')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-in-up">
    <!-- Grading Form Card -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-indigo-900 p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
            <div class="relative z-10 flex items-center space-x-4">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-indigo-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black tracking-tight">Formulir Penilaian</h2>
                    <p class="text-xs font-bold text-indigo-300 uppercase tracking-widest">Berikan umpan balik & skor</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('admin.tugas_kumpul.update', $tugasKumpul->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nilai Input -->
                <div>
                    <label for="nilai" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Skor / Nilai</label>
                    <div class="relative">
                        <input type="text" name="nilai" id="nilai" value="{{ old('nilai', $tugasKumpul->nilai) }}" placeholder="Misal: 95, A+, Sangat Baik" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 block p-4 font-bold transition placeholder:text-slate-300 placeholder:font-medium hover:border-slate-300">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    @error('nilai')
                        <p class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-wider ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Komentar Textarea -->
                <div>
                    <label for="komentar" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Umpan Balik (Komentar)</label>
                    <textarea name="komentar" id="komentar" rows="5" placeholder="Berikan saran atau kritik yang membangun untuk siswa..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-[2rem] focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 block p-4 font-medium transition placeholder:text-slate-300 hover:border-slate-300">{{ old('komentar', $tugasKumpul->komentar) }}</textarea>
                    @error('komentar')
                        <p class="mt-2 text-[10px] font-bold text-rose-500 uppercase tracking-wider ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('admin.tugas_kumpul.index') }}" class="flex-grow inline-flex items-center justify-center px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-black transition text-sm uppercase tracking-widest">
                        Batalkan
                    </a>
                    <button type="submit" class="flex-[2] inline-flex items-center justify-center px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-black transition shadow-xl shadow-indigo-600/40 text-sm uppercase tracking-widest group">
                        <span>Simpan Penilaian</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
