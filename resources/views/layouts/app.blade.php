<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'SmartStudy Portal') }}</title>

    <!-- Fonts -->
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
                        }
                    }
                }
            }
        }
    </script>

    <!-- Styles -->
    @livewireStyles
</head>
<body class="antialiased bg-slate-50 text-slate-900 font-sans selection:bg-blue-100 selection:text-blue-900">
    <div class="min-h-screen relative">
        <!-- Background Decorations -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_top_right,rgba(59,130,246,0.03),transparent_40%)]"></div>
        </div>

        @livewire('navigation-menu')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-100 shadow-sm shadow-slate-200/20">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-1 h-6 bg-blue-600 rounded-full"></div>
                            {{ $header }}
                        </div>
                    </div>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </main>

        <footer class="py-12 border-t border-slate-100 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} SmartStudy E-Learning System. All rights reserved.
            </div>
        </footer>
    </div>

    @stack('modals')
    <style>
        [x-cloak] { display: none; }
    </style>

    @livewireScripts
</body>
</html>
