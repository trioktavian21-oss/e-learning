<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SmartStudy</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        .glass-nav {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0c4a6e 0%, #075985 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex">
    <x-loading-overlay />



    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex flex-col w-72 sidebar-gradient text-white sticky top-0 h-screen overflow-y-auto">
        <div class="p-8 flex-grow">
            <div class="flex items-center space-x-3 mb-12">
                <div class="w-10 h-10 bg-brand-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-xl font-bold tracking-tight">SmartStudy Admin</span>
            </div>

            <!-- Profile Section -->
            @php
                $user = auth()->user();
                $initial = strtoupper(substr($user->name ?? 'A', 0, 1));
            @endphp
            <div class="mb-12 text-center">
                <div class="relative inline-block mb-4">
                    @if($user && $user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                             alt="Profile" 
                             class="w-24 h-24 rounded-full border-4 border-white/20 object-cover shadow-2xl">
                    @else
                        <div class="w-24 h-24 rounded-full border-4 border-white/20 bg-brand-400 flex items-center justify-center text-3xl font-bold text-white shadow-2xl">
                            {{ $initial }}
                        </div>
                    @endif
                    <div class="absolute bottom-1 right-1 w-5 h-5 bg-emerald-500 border-4 border-brand-900 rounded-full"></div>
                </div>
                <h3 class="font-bold text-lg mb-1">{{ $user->name ?? 'Admin' }}</h3>
                <p class="text-brand-300 text-sm font-medium">Administrator</p>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-semibold text-sm">Kelola User</span>
                </a>
                <a href="{{ route('admin.absensi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.absensi.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.absensi.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    <span class="font-semibold text-sm">Absensi</span>
                </a>
                <a href="{{ route('admin.tugas.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.tugas.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.tugas.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path></svg>
                    <span class="font-semibold text-sm">Tugas & Materi</span>
                </a>
                <a href="{{ route('admin.absensi.scan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.absensi.scan') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.absensi.scan') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16M4 16h16M4 20h4m4 0h4m-4-8V4m0 8h.01"></path></svg>
                    <span class="font-semibold text-sm">Scan Presensi</span>
                </a>
                <a href="{{ route('admin.tugas_kumpul.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.tugas_kumpul.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.tugas_kumpul.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-semibold text-sm">Pengumpulan</span>
                </a>
            </nav>
        </div>

        <!-- Logout Section -->
        <div class="p-6 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-white/10 hover:bg-rose-600 rounded-xl text-sm font-bold transition group">
                    <svg class="w-5 h-5 text-brand-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div x-data="{ mobileMenu: false }" class="flex-grow min-h-screen flex flex-col w-full">
        <!-- Mobile Sidebar (Drawer) -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-0 z-50 lg:hidden" x-cloak>
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="mobileMenu = false"></div>
            
            <!-- Sidebar Content -->
            <div class="relative flex flex-col w-80 max-w-[80%] h-full sidebar-gradient text-white shadow-2xl">
                <div class="p-8 flex-grow overflow-y-auto">
                    <div class="flex items-center justify-between mb-12">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-brand-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <span class="text-xl font-bold tracking-tight">SmartStudy Admin</span>
                        </div>
                        <button @click="mobileMenu = false" class="p-2 hover:bg-white/10 rounded-lg transition">
                            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <!-- Profile Section (Mobile) -->
                    <div class="mb-12 text-center">
                        <div class="relative inline-block mb-4">
                            @if($user && $user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile" class="w-20 h-20 rounded-full border-4 border-white/20 object-cover">
                            @else
                                <div class="w-20 h-20 rounded-full border-4 border-white/20 bg-brand-400 flex items-center justify-center text-2xl font-bold text-white">
                                    {{ $initial }}
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-base mb-1">{{ $user->name ?? 'Admin' }}</h3>
                        <p class="text-brand-300 text-xs font-medium uppercase tracking-widest">Administrator</p>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="font-semibold text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="font-semibold text-sm">Kelola User</span>
                        </a>
                        <a href="{{ route('admin.absensi.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.absensi.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.absensi.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span class="font-semibold text-sm">Absensi</span>
                        </a>
                        <a href="{{ route('admin.tugas.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.tugas.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.tugas.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            <span class="font-semibold text-sm">Tugas & Materi</span>
                        </a>
                        <a href="{{ route('admin.absensi.scan') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.absensi.scan') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.absensi.scan') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16M4 16h16M4 20h4m4 0h4m-4-8V4m0 8h.01"></path></svg>
                            <span class="font-semibold text-sm">Scan Presensi</span>
                        </a>
                        <a href="{{ route('admin.tugas_kumpul.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.tugas_kumpul.*') ? 'bg-white text-brand-900 shadow-lg' : 'hover:bg-white/10 transition group' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('admin.tugas_kumpul.*') ? 'text-brand-600' : 'text-brand-300 group-hover:text-white transition' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-semibold text-sm">Pengumpulan</span>
                        </a>
                    </nav>
                </div>
                
                <div class="p-6 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center space-x-2 w-full px-4 py-3 bg-white/10 hover:bg-rose-600 rounded-xl text-xs font-bold transition">
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200 lg:px-12 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button @click="mobileMenu = true" class="lg:hidden p-2 -ml-2 hover:bg-slate-100 rounded-xl text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight lg:block hidden">@yield('page_title', 'Overview')</h1>
                <div class="lg:hidden flex items-center space-x-2">
                    <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight">Admin</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-bold text-slate-900 leading-none">{{ $user->name ?? 'Admin' }}</span>
                    <span class="text-xs text-slate-500 font-medium">Main Admin Role</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 overflow-hidden">
                    @if($user && $user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-brand-600 font-bold text-sm">{{ $initial }}</span>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="lg:p-12 p-6 flex-grow">
            <div class="max-w-7xl mx-auto">
                {{-- Global Alerts --}}
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
            &copy; {{ date('Y') }} SmartStudy Admin Central. All rights reserved.
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
