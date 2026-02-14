@extends('layouts.user')

@section('title', 'Riwayat Presensi')
@section('header', 'Riwayat Kehadiran')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Summary Header -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">Catatan Kehadiran</h2>
                    <p class="text-sm text-slate-500 font-medium italic mt-1">Data riwayat absensi harian Anda di Learning Hub.</p>
                </div>
                <div class="flex items-center space-x-2 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-black text-slate-400 font-bold uppercase tracking-widest">Sistem Presensi Aktif</span>
                </div>
        </div>
    </div>

    @if($presensis->isEmpty())
        <div class="bg-white p-16 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-lg font-black text-slate-900 mb-1">Belum Ada Data</h3>
            <p class="text-xs text-slate-400 font-medium">Anda belum memiliki riwayat presensi yang tercatat saat ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($presensis as $presensi)
                @php
                    $status = strtolower($presensi->aksi);
                    $config = [
                        'hadir' => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-100', 'text' => 'text-emerald-700', 'badge' => 'bg-emerald-500/10 text-emerald-600', 'icon' => 'check-circle'],
                        'sakit' => ['bg' => 'bg-indigo-50', 'border' => 'border-indigo-100', 'text' => 'text-indigo-700', 'badge' => 'bg-indigo-500/10 text-indigo-600', 'icon' => 'thermometer'],
                        'izin'  => ['bg' => 'bg-amber-50', 'border' => 'border-amber-100', 'text' => 'text-amber-700', 'badge' => 'bg-amber-500/10 text-amber-600', 'icon' => 'clock'],
                        'alpa'  => ['bg' => 'bg-rose-50', 'border' => 'border-rose-100', 'text' => 'text-rose-700', 'badge' => 'bg-rose-500/10 text-rose-600', 'icon' => 'x-circle'],
                    ][$status] ?? ['bg' => 'bg-slate-50', 'border' => 'border-slate-100', 'text' => 'text-slate-700', 'badge' => 'bg-slate-500/10 text-slate-600', 'icon' => 'info'];
                @endphp
                <div class="bg-white p-6 rounded-[2rem] border-2 border-slate-50 shadow-lg shadow-slate-200/30 hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">Waktu Presensi</span>
                            <span class="text-sm font-black text-slate-900">{{ $presensi->tanggal->format('d M Y') }}</span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $presensi->jam }} WIB</span>
                        </div>
                        <div class="w-12 h-12 {{ $config['bg'] }} rounded-2xl flex items-center justify-center {{ $config['text'] }} shadow-sm group-hover:scale-110 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-xl {{ $config['badge'] }} text-[10px] font-black uppercase tracking-widest ring-1 ring-inset {{ str_replace('bg-', 'ring-', $config['badge']) }}/20">
                            {{ ucfirst($presensi->aksi) }}
                        </span>
                    </div>

                    <div class="pt-4 border-t border-slate-50">
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Keterangan Tambahan</span>
                        <p class="text-xs text-slate-500 font-medium italic min-h-[2.5rem] line-clamp-2">
                            {{ $presensi->keterangan ?? 'Tidak ada catatan tambahan.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 py-6 bg-white/50 rounded-3xl border border-slate-100/50">
            {{ $presensis->links() }}
        </div>
    @endif
</div>
@endsection
