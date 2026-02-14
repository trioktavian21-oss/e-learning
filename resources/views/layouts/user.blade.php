<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Learning Hub') - E-Learning</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        slate: {
                            750: '#2d3748',
                            850: '#1a202c'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none; }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0c4a6e 0%, #075985 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex">

    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex flex-col w-72 sidebar-gradient text-white sticky top-0 h-screen overflow-y-auto">
        <div class="p-8 flex-grow">
            <div class="flex items-center space-x-3 mb-12">
                <div class="w-10 h-10 bg-brand-500 rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-brand-500/30">E</div>
                <span class="text-xl font-bold tracking-tight">Learning Hub</span>
            </div>

            <!-- Profile Section -->
            @php
                $user = auth()->user();
                $initial = strtoupper(substr($user->name ?? 'S', 0, 1));
            @endphp
            <div class="mb-12 text-center group">
                <div class="relative inline-block mb-4">
                    <a href="{{ route('profile.index') }}" class="block">
                        @if($user && $user->profile_photo_url && !str_contains($user->profile_photo_url, 'ui-avatars'))
                            <img src="{{ $user->profile_photo_url }}" alt="Profile" class="w-24 h-24 rounded-full border-4 border-white/20 object-cover shadow-2xl">
                        @else
                            <div class="w-24 h-24 rounded-full border-4 border-white/20 bg-brand-400 flex items-center justify-center text-3xl font-bold text-white shadow-2xl">
                                {{ $initial }}
                            </div>
                        @endif
                    </a>
                    <div class="absolute bottom-1 right-1 w-5 h-5 bg-emerald-500 border-4 border-brand-900 rounded-full"></div>
                </div>
                <h3 class="font-bold text-lg mb-1">{{ $user->name ?? 'Student' }}</h3>
                <p class="text-brand-300 text-sm font-medium">Siswa Pelajar</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.dashboard') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group text-white/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('user.dashboard') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>
                <a href="{{ route('user.presensi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.presensi.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group text-white/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('user.presensi.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-semibold text-sm">Presensi Saya</span>
                </a>
                <a href="{{ route('user.tugas.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('user.tugas.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group text-white/80 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('user.tugas.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <span class="font-semibold text-sm">Tugas Saya</span>
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-6 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-white/10 hover:bg-rose-600 rounded-xl text-sm font-bold transition group">
                    <svg class="w-5 h-5 text-brand-300 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow min-h-screen flex flex-col w-full">
        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200 lg:px-12 px-6 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight lg:block hidden">@yield('header', 'Learning Hub')</h1>
                <div class="lg:hidden flex items-center space-x-2">
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg">E</div>
                    <span class="text-lg font-bold tracking-tight">Portal</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-bold text-slate-900 leading-none">{{ $user->name ?? 'Student' }}</span>
                    <span class="text-xs text-slate-500 font-medium">Mahasiswa Terdaftar</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 overflow-hidden shadow-sm">
                    @if($user && $user->profile_photo_url && !str_contains($user->profile_photo_url, 'ui-avatars'))
                        <img src="{{ $user->profile_photo_url }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-brand-600 font-bold text-sm">{{ $initial }}</span>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="lg:p-12 p-6 flex-grow">
            <div class="max-w-7xl mx-auto">
                {{-- Session Alerts --}}
                @if(session('success'))
                    <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 rounded-3xl flex items-center space-x-4 animate-fade-in shadow-lg shadow-emerald-500/10">
                        <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none mb-1">Berhasil</p>
                            <p class="text-sm font-bold text-emerald-900">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-8 p-6 bg-rose-50 border border-rose-100 rounded-3xl flex items-center space-x-4 animate-fade-in shadow-lg shadow-rose-500/10">
                        <div class="w-10 h-10 bg-rose-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-rose-500/20 flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-rose-600 uppercase tracking-widest leading-none mb-1">Terjadi Kesalahan</p>
                            <ul class="text-sm font-bold text-rose-900">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="px-12 py-6 text-center text-slate-400 text-xs border-t border-slate-200 mt-auto">
            &copy; {{ date('Y') }} Learning Hub. Empowering Knowledge.
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
