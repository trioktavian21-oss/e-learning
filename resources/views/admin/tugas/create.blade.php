@extends('layouts.admin')

@section('title', 'Unggah Tugas')
@section('page_title', 'Unggah Materi & Tugas')

@section('content')
<div class="max-w-2xl mx-auto animate-fade-in-up">
    <!-- Form Card -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-slate-900 p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
            <div class="relative z-10 flex items-center space-x-4">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-brand-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black tracking-tight">E-Learning Cloud</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Unggah Berkas Baru</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            @if ($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border border-rose-100 rounded-2xl animate-shake">
                    <div class="flex items-center space-x-2 text-rose-600 mb-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        <span class="text-xs font-black uppercase tracking-wider">Terjadi Kesalahan</span>
                    </div>
                    <ul class="text-xs text-rose-500 font-bold space-y-1 ml-6 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Kelas Selection -->
                <div>
                    <label for="kelas" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Target Kelas</label>
                    <div class="relative group">
                        <select name="kelas" id="kelas" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 block p-4 appearance-none font-bold transition group-hover:border-slate-300">
                            <option value="">-- ILIH KELAS --</option>
                            @foreach ($kelasOptions as $kelas)
                                <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>Kelas {{ $kelas }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Judul Input -->
                <div>
                    <label for="judul" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul Materi / Tugas</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Contoh: Modul 1 - Algoritma Dasar" required class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 block p-4 font-bold transition placeholder:text-slate-300 placeholder:font-medium hover:border-slate-300">
                </div>

                <!-- File Upload -->
                <div>
                    <label for="file" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Berkas Lampiran</label>
                    <div class="relative group flex items-center justify-center w-full">
                        <label for="file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-slate-200 border-dashed rounded-[2rem] cursor-pointer bg-slate-50 group-hover:bg-slate-100 group-hover:border-brand-300 transition duration-300 overflow-hidden relative">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-slate-400 group-hover:text-brand-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-1 text-xs font-black text-slate-500 uppercase tracking-widest group-hover:text-brand-600 transition fname">Klik untuk Unggah</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">PDF, DOC, ZIP (Max 5MB)</p>
                            </div>
                            <input type="file" name="file" id="file" required class="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-10" onchange="const fileName = this.files[0].name; this.closest('label').querySelector('.fname').textContent = fileName; this.closest('label').querySelector('.fname').classList.add('text-brand-600');" />
                        </label>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('admin.tugas.index') }}" class="flex-grow inline-flex items-center justify-center px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-black transition text-sm uppercase tracking-widest">
                        Batal
                    </a>
                    <button type="submit" class="flex-[2] inline-flex items-center justify-center px-8 py-4 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-black transition shadow-xl shadow-brand-600/40 text-sm uppercase tracking-widest group">
                        <span>Konfirmasi Unggah</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
