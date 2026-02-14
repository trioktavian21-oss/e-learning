@extends('layouts.admin')

@section('title', 'Kelola User')
@section('page_title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Daftar Pengguna</h2>
            <p class="text-sm text-slate-500 font-medium">Kelola data siswa, guru, dan administrator</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-bold transition shadow-lg shadow-brand-600/30 group">
            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah User Baru
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-64">
                <label for="kelas" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Filter Kelas</label>
                <div class="relative">
                    <select name="kelas" id="kelas" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl focus:ring-brand-500 focus:border-brand-500 block p-3 appearance-none font-medium">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasOptions as $kelasOption)
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
                Terapkan Filter
            </button>
            @if(request('kelas'))
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl font-bold transition">
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
                        <th class="px-6 py-5 font-bold tracking-wider">Identitas Pengguna</th>
                        <th class="px-6 py-5 font-bold tracking-wider">Role & Kelas</th>
                        <th class="px-6 py-5 font-bold tracking-wider">NISN</th>
                        <th class="px-6 py-5 font-bold tracking-wider">Akses (QR)</th>
                        <th class="px-6 py-5 font-bold tracking-wider text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($users as $user)
                    <tr class="hover:bg-slate-50/50 transition decoration-none group">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 font-bold border border-brand-100">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-slate-900 font-bold">{{ $user->name }}</div>
                                    <div class="text-slate-400 text-xs font-medium">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $user->role === 'admin' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-brand-50 text-brand-600 border border-brand-100' }} capitalize mb-1">
                                {{ $user->role ?? '-' }}
                            </span>
                            <div class="text-slate-400 text-xs font-bold">{{ $user->kelas ?? 'Lintas Kelas' }}</div>
                        </td>
                        <td class="px-6 py-5 font-mono text-xs font-bold text-slate-600">
                            {{ $user->nisn ?? 'NRN-NOT-SET' }}
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col items-center space-y-2 p-3 bg-slate-50 rounded-2xl border border-slate-100 group-hover:bg-white transition">
                                <div id="qrcode-{{ $user->id }}" class="p-1 bg-white rounded-lg shadow-sm"></div>
                                <button data-user-id="{{ $user->id }}" class="download-btn text-[10px] font-black uppercase tracking-widest text-emerald-500 hover:text-emerald-600 transition">
                                    Unduh QR
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Edit User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengguna ini secara permanen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Hapus User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <span>Tidak ada pengguna yang ditemukan.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-6 bg-slate-50/50 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @foreach ($users as $user)
            new QRCode(document.getElementById("qrcode-{{ $user->id }}"), {
                text: "{{ $user->nisn ?? $user->id }}",
                width: 80,
                height: 80,
                colorDark: "#0c4a6e",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        @endforeach

        document.querySelectorAll('.download-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                const qrDiv = document.getElementById('qrcode-' + userId);
                const img = qrDiv.querySelector('img') || qrDiv.querySelector('canvas');
                if (!img) return alert('QR Code belum siap');

                let dataUrl = img.tagName === 'IMG' ? img.src : img.toDataURL('image/png');
                const a = document.createElement('a');
                a.href = dataUrl;
                a.download = 'qrcode-user-' + userId + '.png';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });
        });
    });
</script>
@endsection
