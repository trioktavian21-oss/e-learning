@extends('layouts.admin')

@section('title', 'Daftar Tugas')
@section('page_title', 'Manajemen Tugas')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Modul & Tugas</h2>
            <p class="text-sm text-slate-500 font-medium">Unggah dan kelola materi pembelajaran untuk setiap kelas</p>
        </div>
        <a href="{{ route('admin.tugas.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-bold transition shadow-lg shadow-brand-600/30 group">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Tugas Baru
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <form action="{{ route('admin.tugas.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-64">
                <label for="kelas" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Filter Kelas</label>
                <div class="relative">
                    <select name="kelas" id="kelas" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-3 appearance-none font-medium">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelasOptions as $kelasOption)
                            <option value="{{ $kelasOption }}" {{ request('kelas') == $kelasOption ? 'selected' : '' }}>
                                {{ $kelasOption }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold transition">
                Terapkan
            </button>
            @if(request('kelas'))
                <a href="{{ route('admin.tugas.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition">
                    Reset
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
                        <th class="px-6 py-5 font-bold tracking-wider">Materi / Tugas</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Kelas</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">File Lampiran</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Tanggal Dibuat</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($tugas as $item)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100 group-hover:rotate-6 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div class="text-slate-900 font-bold max-w-xs truncate" title="{{ $item->judul }}">{{ $item->judul }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center px-6 py-5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600">
                                {{ $item->kelas }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <a href="{{ route('tugas_files.show', basename($item->file)) }}" target="_blank" class="inline-flex items-center text-brand-600 hover:text-brand-700 font-bold transition decoration-none">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                Buka File
                            </a>
                        </td>
                        <td class="px-6 py-5 text-center text-slate-400 text-xs font-medium">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-5 text-right">
                            <form action="{{ route('admin.tugas.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tugas ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Hapus Tugas">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span>Belum ada data tugas yang diunggah.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $tugas->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endsection
