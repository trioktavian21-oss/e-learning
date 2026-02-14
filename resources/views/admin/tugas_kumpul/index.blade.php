@extends('layouts.admin')

@section('title', 'Daftar Tugas Kumpul')
@section('page_title', 'Pengumpulan Tugas')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Berkas Dikumpulkan</h2>
            <p class="text-sm text-slate-500 font-medium">Tinjau dan beri penilaian untuk tugas yang telah dikirim siswa</p>
        </div>
        <a href="{{ route('admin.tugas_kumpul.export', ['kelas' => request('kelas')]) }}" class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-bold transition shadow-lg shadow-emerald-600/30 group">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Excel
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <form method="GET" action="{{ route('admin.tugas_kumpul.index') }}" class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-64">
                <label for="kelas_filter" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Filter Berdasarkan Kelas</label>
                <div class="relative">
                    <select name="kelas" id="kelas_filter" onchange="this.form.submit()" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-3 appearance-none font-medium">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelasOptions as $kelas)
                            <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                Kelas {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
            @if(request('kelas'))
                <a href="{{ route('admin.tugas_kumpul.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition">
                    Reset Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 font-bold tracking-wider">Identitas Tugas & Siswa</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Berkas</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Nilai</th>
                        <th class="px-6 py-5 font-bold tracking-wider">Komentar Guru</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($kumpuls as $kumpul)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-5">
                            <div class="text-slate-900 font-bold mb-1">{{ $kumpul->tugas->judul }}</div>
                            <div class="flex items-center text-slate-400 text-xs font-medium italic">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $kumpul->user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('tugas_files.show', basename($kumpul->file)) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-brand-50 text-brand-600 hover:text-brand-700 rounded-xl text-xs font-black uppercase tracking-wider transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Lihat Berkas
                            </a>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($kumpul->nilai !== null)
                                <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-500 text-white font-black text-sm shadow-lg shadow-brand-500/30">
                                    {{ $kumpul->nilai }}
                                </div>
                            @else
                                <span class="text-slate-300 font-bold italic text-xs">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 max-w-xs">
                            <p class="text-xs text-slate-500 font-medium italic line-clamp-2" title="{{ $kumpul->komentar }}">
                                {{ $kumpul->komentar ?? 'Tidak ada komentar.' }}
                            </p>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <a href="{{ route('admin.tugas_kumpul.edit', $kumpul->id) }}" class="inline-flex items-center px-6 py-3 bg-brand-600 hover:bg-brand-500 text-white rounded-xl text-xs font-black uppercase tracking-widest transition shadow-lg shadow-brand-600/20 group">
                                <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Beri Nilai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <svg class="w-16 h-16 text-slate-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <span>Maaf, belum ada tugas yang dikumpulkan untuk filter ini.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $kumpuls->links() }}
        </div>
    </div>
</div>
@endsection
