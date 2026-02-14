@extends('layouts.user')

@section('title', 'Dashboard Siswa')
@section('header', 'Beranda')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Section -->
    <div class="relative overflow-hidden bg-brand-600 rounded-3xl p-8 text-white shadow-2xl shadow-brand-600/20">
        <div class="relative z-10">
            <div class="inline-flex items-center space-x-2 px-3 py-1 bg-white/10 rounded-full text-xs font-semibold mb-4 backdrop-blur-sm border border-white/10">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span>Portal Siswa Aktif</span>
            </div>
            <h2 class="text-3xl font-extrabold mb-2">Selamat datang kembali, {{ $user->name }}! 👋</h2>
            <p class="text-brand-100 max-w-2xl opacity-90 leading-relaxed font-medium">
                Senang melihatmu kembali. Teruslah belajar dan raih mimpimu hari ini. Semua materi dan tugas terupdate tersedia di bawah ini.
            </p>
        </div>
        <!-- Decorative abstract shape -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Attendance Stats -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Ringkasan Presensi</h3>
                    <a href="{{ route('user.presensi.index') }}" class="text-xs font-black text-brand-600 uppercase tracking-widest hover:text-brand-700 transition">Detail Lengkap &rarr;</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-emerald-50 p-6 rounded-3xl border border-emerald-100 text-center group hover:bg-emerald-100 transition shadow-sm">
                        <div class="text-emerald-600 mb-1"><svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div class="text-2xl font-black text-emerald-700">{{ $hadir }}</div>
                        <div class="text-[10px] font-black text-emerald-600/60 uppercase tracking-widest">Hadir</div>
                    </div>
                    <div class="bg-amber-50 p-6 rounded-3xl border border-amber-100 text-center group hover:bg-amber-100 transition shadow-sm">
                        <div class="text-amber-600 mb-1"><svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div class="text-2xl font-black text-amber-700">{{ $izin }}</div>
                        <div class="text-[10px] font-black text-amber-600/60 uppercase tracking-widest">Izin</div>
                    </div>
                    <div class="bg-indigo-50 p-6 rounded-3xl border border-indigo-100 text-center group hover:bg-indigo-100 transition shadow-sm">
                        <div class="text-indigo-600 mb-1"><svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a2 2 0 00-1.96 1.414l-.722 2.166a2 2 0 01-2.612 1.233l-2.166-.722a2 2 0 00-1.414 1.96l.477 2.387a2 2 0 00.547 1.022l1.428 1.428"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41m12.72-12.72l-1.41 1.41"></path></svg></div>
                        <div class="text-2xl font-black text-indigo-700">{{ $sakit }}</div>
                        <div class="text-[10px] font-black text-indigo-600/60 uppercase tracking-widest">Sakit</div>
                    </div>
                    <div class="bg-rose-50 p-6 rounded-3xl border border-rose-100 text-center group hover:bg-rose-100 transition shadow-sm">
                        <div class="text-rose-600 mb-1"><svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <div class="text-2xl font-black text-rose-700">{{ $alpa }}</div>
                        <div class="text-[10px] font-black text-rose-600/60 uppercase tracking-widest">Alpa</div>
                    </div>
                </div>
            </div>

            <!-- Assignments Table -->
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Daftar Nilai Tugas</h3>
                    <a href="{{ route('user.tugas.index') }}" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition">Lihat Semua &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-[10px] text-slate-400 uppercase tracking-widest bg-slate-50/50">
                            <tr>
                                <th class="px-8 py-4 font-black">Materi / Tugas</th>
                                <th class="px-8 py-4 font-black text-center">Skor</th>
                                <th class="px-8 py-4 font-black text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($daftarNilai as $tugas)
                                @php
                                    $nilai = $tugas->nilai ?? 0;
                                    $color = $nilai >= 85 ? 'text-emerald-600 bg-emerald-50' : ($nilai >= 70 ? 'text-amber-600 bg-amber-50' : 'text-rose-600 bg-rose-50');
                                @endphp
                                <tr class="hover:bg-slate-50/50 transition duration-300">
                                    <td class="px-8 py-6 font-bold text-slate-700 truncate max-w-[200px]">{{ $tugas->tugas->judul ?? 'Tiada Judul' }}</td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl {{ $color }} font-black shadow-sm ring-1 ring-inset ring-black/5">
                                            {{ $nilai }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        @if($tugas->nilai !== null)
                                            <span class="inline-flex items-center px-3 py-1 bg-emerald-500/10 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-wider">Tuntas</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-400 rounded-lg text-[10px] font-black uppercase tracking-wider italic">Proses</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-12 text-center text-slate-400 font-medium italic">
                                        Belum ada nilai yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Side: Profile & Performance -->
        <div class="space-y-8">
            <!-- Performance Card -->
            <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500 rounded-full blur-[80px] opacity-20 -mr-16 -mt-16 group-hover:scale-150 transition duration-700"></div>
                
                @php
                    $r = $rataNilai ?? null;
                    if (is_null($r)) {
                        $display = 'N/A';
                        $percent = 0;
                        $status = 'Belum Ada Penilaian';
                        $colorClass = 'from-slate-700 to-slate-800';
                        $textClass = 'text-slate-400';
                    } else {
                        $percent = round($r, 1);
                        if ($percent >= 85) { $status = 'Luar Biasa!'; $colorClass = 'from-emerald-400 to-teal-500'; $textClass = 'text-emerald-400'; }
                        elseif ($percent >= 70) { $status = 'Cukup Baik'; $colorClass = 'from-blue-400 to-indigo-500'; $textClass = 'text-blue-400'; }
                        else { $status = 'Perlu Disiplin'; $colorClass = 'from-rose-400 to-orange-500'; $textClass = 'text-rose-400'; }
                        $display = $percent . '%';
                    }
                @endphp

                <div class="relative z-10 text-center">
                    <div class="inline-block p-4 bg-white/5 rounded-3xl mb-6 shadow-inner ring-1 ring-white/10">
                        <svg class="w-10 h-10 {{ $textClass }} opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 mb-2 ml-1">Performa Belajar</h4>
                    <div class="text-6xl font-black tracking-tighter mb-2 {{ $textClass }}">{{ $display }}</div>
                    <p class="text-xs font-bold uppercase tracking-wider mb-8">{{ $status }}</p>
                    
                    <div class="w-full bg-white/5 rounded-full h-3 mb-2 p-1 relative shadow-inner overflow-hidden">
                        <div class="bg-gradient-to-r {{ $colorClass }} h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                    </div>
                    <div class="flex justify-between text-[8px] font-black text-white/20 uppercase tracking-[0.2em]">
                        <span>0%</span>
                        <span>TARGET: 100%</span>
                    </div>
                </div>
            </div>

            <!-- Quick Access / AI Gemini -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 text-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-blue-600/5 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white flex items-center justify-center mx-auto mb-6 shadow-xl shadow-blue-600/20 group-hover:scale-110 transition duration-500 rotate-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mb-2">Punya Pertanyaan?</h3>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-8">Tanyakan apa saja seputar materi pelajaran pada Asisten AI cerdas kami.</p>
                    <a href="{{ route('gemini') }}" class="inline-flex items-center justify-center w-full px-8 py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest transition shadow-lg shadow-slate-900/20 group">
                        Mulai Chat AI
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button for Mobile -->
<a href="{{ route('gemini') }}" class="lg:hidden fixed bottom-6 right-6 w-16 h-16 bg-gradient-to-br from-brand-600 to-indigo-700 text-white rounded-full flex items-center justify-center shadow-2xl shadow-brand-600/50 z-50 animate-bounce transition-transform active:scale-90">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
</a>
@endsection

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endpush
