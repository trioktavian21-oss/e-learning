<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Learning Portal') }}</title>

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
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            }
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-out forwards',
                            'blob': 'blob 7s infinite',
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0', transform: 'translateY(10px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' },
                            },
                            blob: {
                                '0%': { transform: 'translate(0px, 0px) scale(1)' },
                                '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                                '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                                '100%': { transform: 'translate(0px, 0px) scale(1)' },
                            },
                        }
                    }
                }
            }
        </script>

        <!-- Styles -->
        @livewireStyles
        <style>
            [x-cloak] { display: none; }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 relative overflow-x-hidden min-h-screen">
        <!-- Background Decorations -->
        <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-400/10 rounded-full blur-[120px] animate-blob"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-400/10 rounded-full blur-[120px] animate-blob" style="animation-delay: 2s"></div>
            <div class="absolute top-[40%] left-[30%] w-[20%] h-[20%] bg-sky-400/5 rounded-full blur-[80px] animate-blob" style="animation-delay: 4s"></div>
        </div>

        <div class="min-h-screen flex flex-col items-center justify-center p-6 sm:p-12 animate-fade-in">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
