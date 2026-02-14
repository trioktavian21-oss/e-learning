<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SmartStudy - Cerdas Bersama Kami</title>
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
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hero-gradient {
            background: radial-gradient(circle at 20% 30%, #4f46e5 0%, transparent 40%),
                        radial-gradient(circle at 80% 70%, #0ea5e9 0%, transparent 40%),
                        linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 flex flex-col min-h-screen">
    <x-loading-overlay />

    <!-- Navigation -->
    <nav x-data="{ mobileMenu: false }" class="fixed top-0 w-full z-50 glass">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-brand-500 rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-500/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-white">SmartStudy</span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" class="text-sm font-bold text-slate-300 hover:text-white transition uppercase tracking-widest">Fitur</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 rounded-2xl text-sm font-black transition border border-white/10 uppercase tracking-widest">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-black text-slate-300 hover:text-white transition uppercase tracking-widest">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-brand-600 hover:bg-brand-500 rounded-2xl text-sm font-black transition shadow-xl shadow-brand-600/40 uppercase tracking-widest">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Toggle -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 text-slate-300 hover:text-white transition">
                    <svg x-show="!mobileMenu" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenu" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden border-t border-white/10 bg-slate-900/95 backdrop-blur-xl" x-cloak>
            <div class="px-6 py-8 space-y-6">
                <a href="#fitur" @click="mobileMenu = false" class="block text-lg font-bold text-slate-300 hover:text-white transition capitalize">Fitur Platform</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block px-6 py-4 bg-white/5 rounded-2xl text-lg font-bold text-center border border-white/10">Ke Dashboard</a>
                    @else
                        <div class="grid grid-cols-2 gap-4 pt-4">
                            <a href="{{ route('login') }}" class="flex items-center justify-center px-6 py-4 bg-slate-800 rounded-2xl font-bold transition">Masuk</a>
                            <a href="{{ route('register') }}" class="flex items-center justify-center px-6 py-4 bg-brand-600 rounded-2xl font-bold transition">Daftar</a>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow">
        <section class="hero-gradient min-h-[90vh] flex items-center pt-20 px-6">
            <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 animate-fade-in-up">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 bg-brand-500/10 border border-brand-500/20 rounded-full text-brand-400 text-xs font-semibold tracking-wide uppercase">
                        <span>✨ Platform Pembelajaran Masa Depan</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight">
                        Transformasikan <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-indigo-400">Cara Anda Belajar</span>
                    </h1>
                    <p class="text-lg text-slate-400 max-w-xl leading-relaxed">
                        Aplikasi yang memudahkan pengelolaan absensi dan pembelajaran dengan teknologi terkini. Cepat, efisien, dan menyenangkan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('register') }}" class="flex items-center justify-center px-8 py-4 bg-brand-600 hover:bg-brand-500 rounded-2xl text-lg font-bold transition shadow-2xl shadow-brand-600/40 group">
                            Mulai Belajar 
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="#fitur" class="flex items-center justify-center px-8 py-4 bg-slate-800/50 hover:bg-slate-800 rounded-2xl text-lg font-bold border border-slate-700 transition">
                            Lihat Fitur
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block relative">
                    <!-- Decorative element looking like a modern dashboard preview -->
                    <div class="glass p-4 rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 transition duration-500">
                        <div class="w-full h-80 bg-slate-900 rounded-2xl flex items-center justify-center overflow-hidden">
                            <div class="grid grid-cols-2 gap-4 w-full p-8">
                                <div class="h-24 bg-brand-500/20 rounded-xl border border-brand-500/30 animate-pulse"></div>
                                <div class="h-24 bg-indigo-500/20 rounded-xl border border-indigo-500/30 animate-pulse delay-75"></div>
                                <div class="h-40 col-span-2 bg-slate-800 rounded-xl border border-slate-700 animate-pulse delay-150 text-xs text-slate-500 p-4">
                                    <div class="h-2 w-1/2 bg-slate-700 rounded mb-2"></div>
                                    <div class="h-2 w-3/4 bg-slate-700 rounded mb-2"></div>
                                    <div class="h-2 w-1/4 bg-slate-700 rounded mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-500/30 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-500/30 rounded-full blur-3xl"></div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section id="fitur" class="py-24 px-6 bg-slate-950">
            <div class="max-w-7xl mx-auto">
                <div class="text-center space-y-4 mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold">Kenapa Memilih SmartStudy?</h2>
                    <p class="text-slate-400 max-w-2xl mx-auto">Dirancang untuk memberikan pengalaman belajar terbaik dengan fitur-fitur unggulan yang intuitif.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="glass p-8 rounded-3xl hover:border-brand-500/50 transition group">
                        <div class="w-12 h-12 bg-brand-600/20 rounded-2xl flex items-center justify-center mb-6 text-brand-400 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Absensi Real-time</h3>
                        <p class="text-slate-400">Pantau kehadiran siswa secara instan dengan sistem pelaporan yang akurat dan otomatis.</p>
                    </div>
                    <div class="glass p-8 rounded-3xl hover:border-brand-500/50 transition group">
                        <div class="w-12 h-12 bg-indigo-600/20 rounded-2xl flex items-center justify-center mb-6 text-indigo-400 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Materi Terstruktur</h3>
                        <p class="text-slate-400">Akses materi pembelajaran yang tertata rapi sesuai kurikulum yang berlaku kapanpun dan dimanapun.</p>
                    </div>
                    <div class="glass p-8 rounded-3xl hover:border-brand-500/50 transition group">
                        <div class="w-12 h-12 bg-cyan-600/20 rounded-2xl flex items-center justify-center mb-6 text-cyan-400 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04 inter t-4.016 11.955 11.955 0 01-3.868 8.084c.15.22.315.432.495.636A11.955 11.955 0 0112 21.056a11.955 11.955 0 018.991-9.352 12.02 12.02 0 01.495-.636 11.955 11.955 0 01-3.868-8.084z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Aman & Terpercaya</h3>
                        <p class="text-slate-400">Data Anda aman bersama kami dengan enkripsi tingkat tinggi dan sistem backup berlapis.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 py-12 px-6 border-t border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0">
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="w-6 h-6 bg-brand-500 rounded flex items-center justify-center text-white text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="text-lg font-bold">SmartStudy</span>
                </div>
                <p class="text-slate-500 text-sm max-w-xs">&copy; {{ date('Y') }} SmartStudy. Membangun masa depan melalui pendidikan digital.</p>
            </div>
            
            <div class="flex space-x-6">
                <a href="#" class="text-slate-500 hover:text-brand-400 transition">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="text-slate-500 hover:text-brand-400 transition">
                    <span class="sr-only">GitHub</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.43.372.805 1.102.805 2.222 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                </a>
                <a href="#" class="text-slate-500 hover:text-brand-400 transition">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>

