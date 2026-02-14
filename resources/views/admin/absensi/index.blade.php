@extends('layouts.admin')

@section('title', 'Daftar Presensi')
@section('page_title', 'Rekap Presensi')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Data Kehadiran</h2>
            <p class="text-sm text-slate-500 font-medium">Pantau absensi harian seluruh pengguna</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.absensi.scan') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-2xl font-bold transition shadow-lg shadow-indigo-600/30 group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16M4 16h16M4 20h4m4 0h4m-4-8V4m0 8h.01"></path></svg>
                Scan QR Code
            </a>
            <a href="{{ route('admin.absensi.export', ['kelas' => request('kelas'), 'tanggal' => request('tanggal')]) }}" class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-2xl font-bold transition shadow-lg shadow-emerald-600/30 group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </a>
            <a href="{{ route('admin.absensi.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-bold transition shadow-lg shadow-brand-600/30 group">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Input Manual
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <form action="{{ route('admin.absensi.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
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
            <div>
                <label for="tanggal" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Filter Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-3 font-medium" />
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-grow px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-xl font-bold transition">
                    Filter
                </button>
                @if(request('kelas') || request('tanggal'))
                    <a href="{{ route('admin.absensi.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 font-bold tracking-wider">Nama Pengguna</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Kelas</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Waktu</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-center">Status</th>
                        <th class="px-6 py-5 font-bold tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($presensis as $p)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold border border-slate-200">
                                    {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                </div>
                                <div class="text-slate-900 font-bold">{{ $p->user->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600">
                                {{ $p->user->kelas ?? 'Lintas Kelas' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="text-slate-900 font-bold">{{ $p->tanggal->format('d M Y') }}</div>
                            <div class="text-slate-400 text-xs font-medium">{{ $p->jam }}</div>
                        </td>
                        <td class="px-6 py-5 text-center px-6 py-5">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $p->aksi === 'masuk' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-rose-50 text-rose-600 border border-rose-100' }} capitalize">
                                {{ $p->aksi }}
                            </span>
                        </td>
                        <td class="px-6 py-5 italic text-slate-400 font-medium">
                            {{ $p->keterangan ?? 'Tanpa catatan' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-medium">
                            Tidak ada data presensi yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $presensis->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endsection
