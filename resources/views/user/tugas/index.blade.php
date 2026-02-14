@extends('layouts.user')

@section('title', 'Tugas Saya')
@section('header', 'Materi & Tugas')

@section('content')
<div class="space-y-10 animate-fade-in group/container">
    <!-- Page Header & Stats -->
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-grow bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-brand-500 rounded-full blur-[100px] opacity-10 -ml-32 -mt-32"></div>
            <div class="relative z-10">
                <h2 class="text-3xl font-black text-slate-900 tracking-tight mb-2">Kurikulum Kelas {{ auth()->user()->kelas }}</h2>
                <p class="text-slate-500 font-medium italic">Tinjau progres belajar Anda dan selesaikan tantangan yang tersedia.</p>
            </div>
            <div class="hidden md:flex items-center space-x-3 bg-brand-50 px-6 py-4 rounded-3xl border border-brand-100 shadow-sm relative z-10">
                <div class="w-10 h-10 bg-brand-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-brand-600/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-brand-400 uppercase tracking-widest leading-none mb-1">Status Akademik</span>
                    <span class="text-sm font-black text-brand-900 leading-none">Aktif Progress</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden relative group/chart">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-2 h-8 bg-brand-600 rounded-full"></div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight">Analisis Grafik Nilai</h3>
            </div>
            <div class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] italic">Visualisasi Progres</div>
        </div>
        <div class="h-[300px] w-full">
            <canvas id="activityChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Assignment Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($tugasList as $tugas)
            @php
                $isSubmitted = isset($tugasKumpulUser[$tugas->id]);
                $kumpul = $isSubmitted ? $tugasKumpulUser[$tugas->id] : null;
                $nilai = $kumpul ? (float) $kumpul->nilai : null;
                
                $borderClass = 'border-slate-100';
                $accentClass = 'bg-slate-50 text-slate-400';
                
                if ($isSubmitted) {
                    if ($nilai !== null) {
                        if ($nilai >= 85) { $borderClass = 'border-emerald-200'; $accentClass = 'bg-emerald-50 text-emerald-600'; }
                        elseif ($nilai >= 70) { $borderClass = 'border-brand-200'; $accentClass = 'bg-brand-50 text-brand-600'; }
                        else { $borderClass = 'border-rose-200'; $accentClass = 'bg-rose-50 text-rose-600'; }
                    } else {
                        $borderClass = 'border-brand-100'; 
                        $accentClass = 'bg-brand-50 text-brand-600';
                    }
                }
            @endphp
            <div class="bg-white rounded-[2.5rem] border-2 {{ $borderClass }} p-8 shadow-lg shadow-slate-200/40 flex flex-col hover:shadow-2xl hover:-translate-y-2 transition duration-500 relative overflow-hidden group/card">
                <!-- Status Badge -->
                <div class="absolute top-6 right-6">
                    @if($isSubmitted)
                        <span class="inline-flex items-center px-3 py-1 {{ $accentClass }} rounded-full text-[9px] font-black uppercase tracking-widest shadow-sm border border-current/10">
                            {{ $nilai !== null ? 'Dinilai' : 'Dikumpul' }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-500 rounded-full text-[9px] font-black uppercase tracking-widest shadow-sm border border-rose-100">
                            Terlambat?
                        </span>
                    @endif
                </div>

                <div class="w-14 h-14 {{ $accentClass }} rounded-2xl flex items-center justify-center mb-6 shadow-inner transition group-hover/card:rotate-6 duration-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>

                <h3 class="text-xl font-black text-slate-900 tracking-tight leading-7 mb-2 h-14 overflow-hidden">{{ $tugas->judul }}</h3>
                <div class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6">
                    Materi Diupload: <span class="text-slate-500">{{ $tugas->created_at->format('d M Y') }}</span>
                </div>

                <div class="mt-auto space-y-4">
                    <a href="{{ url('tugas_files/' . basename($tugas->file)) }}" target="_blank" class="flex items-center justify-between p-4 bg-slate-50 text-slate-700 rounded-2xl font-bold text-xs border border-slate-100 hover:bg-slate-100 transition group/dl">
                        <span>Unduh Materi</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover/dl:translate-y-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </a>

                    @if($isSubmitted)
                        <div class="p-6 {{ $accentClass }} rounded-3xl border border-current/5">
                            @if($nilai !== null)
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[9px] font-black uppercase tracking-widest opacity-60">Skor Perolehan</span>
                                    <span class="text-xl font-black">{{ $nilai }}%</span>
                                </div>
                                <div class="w-full bg-current/10 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-current h-full rounded-full" style="width: {{ $nilai }}%"></div>
                                </div>
                            @else
                                <div class="flex items-center space-x-2 italic text-[10px] font-medium">
                                    <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    <span>Menunggu penilaian pengajar...</span>
                                </div>
                            @endif

                            @if($kumpul->komentar)
                                <div class="mt-4 pt-4 border-t border-current/10">
                                    <span class="text-[9px] font-black uppercase tracking-widest block mb-1 opacity-60">Catatan Guru:</span>
                                    <p class="text-[10px] italic leading-relaxed">{{ $kumpul->komentar }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('user.tugas.upload', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            <label class="block group/upload cursor-pointer relative">
                                <div class="w-full flex items-center justify-center p-4 bg-brand-50 border-2 border-dashed border-brand-200 rounded-2xl hover:bg-brand-100/50 hover:border-brand-400 transition-all duration-300">
                                    <input type="file" name="file" class="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-10" accept=".pdf,.doc,.docx,.zip" required onchange="const fileName = this.files[0].name; this.closest('label').querySelector('.fname').textContent = fileName; this.closest('label').querySelector('.fname').classList.add('text-brand-700'); this.closest('label').querySelector('.fname').classList.remove('text-brand-500');">
                                    <div class="text-center">
                                        <span class="fname text-[10px] font-black text-brand-500 uppercase tracking-widest group-hover/upload:scale-105 transition block">Pilih File Tugas</span>
                                        <span class="text-[8px] text-brand-400 font-medium">PDF, DOCX, ZIP (Max 5MB)</span>
                                    </div>
                                </div>
                            </label>
                            @error('file')
                                <p class="text-[10px] text-rose-500 font-bold italic ml-2 mt-1">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-lg shadow-brand-600/30 transition active:scale-95">
                                Kumpulkan Sekarang
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12 py-6">
        {{ $tugasList->links() }}
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('activityChart').getContext('2d');
    const tugasData = @json(
        $tugasList->map(fn($t) => [
            'judul' => $t->judul,
            'nilai' => isset($tugasKumpulUser[$t->id]) ? (float)$tugasKumpulUser[$t->id]->nilai : 0
        ])
    );

    const labels = tugasData.map(t => t.judul.length > 20 ? t.judul.substring(0,20)+'...' : t.judul).reverse();
    const dataNilai = tugasData.map(t => t.nilai).reverse();

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.4)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Performa Nilai',
                data: dataNilai,
                borderColor: '#0284c7',
                borderWidth: 4,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#0284c7',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 9,
                pointHoverBackgroundColor: '#1e40af',
                pointHoverBorderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { size: 12, weight: 'bold', family: 'Inter' },
                    bodyFont: { size: 12, family: 'Inter' },
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) { return 'Skor: ' + context.parsed.y + '%'; }
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#94a3b8', font: { size: 10, weight: 'bold', family: 'Inter' } },
                    grid: { display: false }
                },
                y: {
                    min: 0, max: 100,
                    ticks: { color: '#94a3b8', font: { size: 10, weight: 'bold', family: 'Inter' }, stepSize: 20 },
                    grid: { color: 'rgba(241, 245, 249, 1)', drawBorder: false }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
