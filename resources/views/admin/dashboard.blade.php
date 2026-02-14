@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Header -->
    <div class="relative overflow-hidden bg-brand-600 rounded-3xl p-8 text-white shadow-2xl shadow-brand-600/20">
        <div class="relative z-10">
            <div class="inline-flex items-center space-x-2 px-3 py-1 bg-white/10 rounded-full text-xs font-semibold mb-4 backdrop-blur-sm border border-white/10">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span>Sistem Aktif & Terpantau</span>
            </div>
            <h2 class="text-3xl font-extrabold mb-2">Selamat datang kembali, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-brand-100 max-w-2xl opacity-90 leading-relaxed">
                Panel admin E-Learning siap membantu Anda mengelola data pengguna, absensi, dan tugas dengan lebih efisien hari ini.
            </p>
        </div>
        <!-- Decorative abstract shape -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Users Card -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 group hover:border-brand-500/50 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">+12%</span>
            </div>
            <h4 class="text-slate-500 text-sm font-semibold mb-1">Total Pengguna</h4>
            <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $jumlahUser }}</div>
            <p class="text-slate-400 text-xs mt-3 font-medium">Siswa & Guru terdaftar</p>
        </div>

        <!-- Assignments Card -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 group hover:border-brand-500/50 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <span class="text-xs font-bold text-indigo-500 bg-indigo-50 px-2 py-1 rounded-lg">Update</span>
            </div>
            <h4 class="text-slate-500 text-sm font-semibold mb-1">Materi & Tugas</h4>
            <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalTugas }}</div>
            <p class="text-slate-400 text-xs mt-3 font-medium">Total tugas diunggah</p>
        </div>

        <!-- Attendance Card -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 group hover:border-brand-500/50 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-cyan-50 rounded-2xl flex items-center justify-center text-cyan-600 group-hover:scale-110 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-xs font-bold text-cyan-500 bg-cyan-50 px-2 py-1 rounded-lg">Hari Ini</span>
            </div>
            <h4 class="text-slate-500 text-sm font-semibold mb-1">Presensi</h4>
            <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $presensiHariIni }}</div>
            <p class="text-slate-400 text-xs mt-3 font-medium">Siswa hadir hari ini</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900 tracking-tight">Tren Aktivitas Pembelajaran</h3>
                <p class="text-sm text-slate-500 font-medium">Statistik harian tugas dan absensi</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 bg-brand-500 rounded-full"></span>
                    <span class="text-xs font-bold text-slate-600">Tugas</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-3 h-3 bg-emerald-500 rounded-full"></span>
                    <span class="text-xs font-bold text-slate-600">Absensi</span>
                </div>
            </div>
        </div>
        <div class="h-80 w-full">
            <canvas id="aktivitasChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('aktivitasChart').getContext('2d');
        
        // Gradient for Tugas
        const tugasGradient = ctx.createLinearGradient(0, 0, 0, 400);
        tugasGradient.addColorStop(0, 'rgba(14, 165, 233, 0.2)');
        tugasGradient.addColorStop(1, 'rgba(14, 165, 233, 0)');

        // Gradient for Absensi
        const absensiGradient = ctx.createLinearGradient(0, 0, 0, 400);
        absensiGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
        absensiGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Tugas',
                        data: {!! json_encode($dataTugas) !!},
                        borderColor: '#0ea5e9',
                        borderWidth: 3,
                        backgroundColor: tugasGradient,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0ea5e9',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Absensi',
                        data: {!! json_encode($dataAbsensi) !!},
                        borderColor: '#10b981',
                        borderWidth: 3,
                        backgroundColor: absensiGradient,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f1f5f9' },
                        ticks: { font: { family: 'Inter', weight: '500' }, color: '#94a3b8' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', weight: '500' }, color: '#94a3b8' }
                    }
                }
            }
        });
    });
</script>
@endsection
