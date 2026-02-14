<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Assistant - SmartStudy</title>

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
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        #out::-webkit-scrollbar {
            width: 6px;
        }
        #out::-webkit-scrollbar-track {
            background: transparent;
        }
        #out::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        #out::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased font-sans h-screen flex flex-col overflow-hidden relative">
    <x-loading-overlay />
    
    <!-- Background Decorations -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-400/10 rounded-full blur-[120px] animate-blob"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-indigo-400/10 rounded-full blur-[120px] animate-blob" style="animation-delay: 2s"></div>
        <div class="absolute top-[30%] left-[20%] w-[30%] h-[30%] bg-sky-400/5 rounded-full blur-[100px] animate-blob" style="animation-delay: 4s"></div>
    </div>

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-brand-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-brand-600/30 group">
                <svg class="w-6 h-6 group-hover:rotate-12 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            </div>
            <div>
                <h1 class="text-lg font-black text-slate-900 tracking-tight leading-none">SmartAI Assistant</h1>
                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1"> SDN 15 Gantung Knowledge Base</p>
            </div>
        </div>
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-black uppercase tracking-widest transition group">
            <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </header>

    <!-- Chat Output Area -->
    <main class="flex-grow flex flex-col p-4 md:p-8 overflow-hidden">
        <div id="out" class="flex-grow glass-panel rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-6 md:p-10 overflow-y-auto flex flex-col gap-6 relative">
            <!-- Initial Message -->
            <div class="flex flex-col items-start max-w-[85%] animate-fade-in">
                <div class="flex items-center space-x-2 mb-2 ml-4">
                    <div class="w-6 h-6 bg-brand-100 rounded-lg flex items-center justify-center text-brand-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Asisten AI</span>
                </div>
                <div class="bg-white p-6 rounded-3xl rounded-tl-none border border-slate-100 shadow-sm text-sm font-medium leading-relaxed text-slate-700">
                    Halo, {{ auth()->user()->name }}! Saya adalah asisten cerdas Anda. Ada yang bisa saya bantu terkait pelajaran atau sekolah hari ini?
                </div>
            </div>
        </div>
    </main>

    <!-- Input Bar -->
    <footer class="p-4 md:p-8 pt-0 mt-auto relative z-10">
        <div class="max-w-4xl mx-auto glass-panel p-2 rounded-[2rem] shadow-2xl shadow-brand-600/10 flex flex-col md:flex-row gap-2 border border-white">
            <input type="text" id="pesan" placeholder="Tanyakan sesuatu tentang pelajaran..." 
                class="flex-grow px-6 py-4 bg-transparent outline-none text-slate-700 font-medium placeholder:text-slate-400">
            <button onclick="pesan()" class="bg-brand-600 hover:bg-brand-700 text-white px-8 py-4 rounded-3xl font-black text-xs uppercase tracking-[0.2em] transition-all transform active:scale-95 shadow-xl shadow-brand-600/30 flex items-center justify-center group">
                <span>Kirim Pesan</span>
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 group-hover:-translate-y-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
        </div>
        <p class="text-center text-[9px] font-black text-slate-400 tracking-[0.3em] uppercase mt-4">Powered by Gemini AI Technology</p>
    </footer>

    <script>
        const userName = "{{ auth()->user()->name }}";

        document.getElementById("pesan").addEventListener("keydown", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                pesan();
            }
        });

        function pesan() {
            const pesanInput = document.getElementById("pesan");
            const outArea = document.getElementById("out");
            const isiPesan = pesanInput.value;
            if (!isiPesan.trim()) return;

            // User Message
            const userDiv = document.createElement("div");
            userDiv.className = "flex flex-col items-end max-w-[85%] self-end animate-fade-in";
            userDiv.innerHTML = `
                <div class="flex items-center space-x-2 mb-2 mr-4">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Anda</span>
                </div>
                <div class="bg-brand-600 p-6 rounded-3xl rounded-tr-none text-white text-sm font-bold shadow-xl shadow-brand-600/20 leading-relaxed">
                    ${isiPesan}
                </div>
            `;
            outArea.appendChild(userDiv);

            // Bot Typing Indicator
            const botDiv = document.createElement("div");
            botDiv.className = "flex flex-col items-start max-w-[85%] animate-fade-in transition-all duration-500";
            botDiv.innerHTML = `
                <div class="flex items-center space-x-2 mb-2 ml-4">
                    <div class="w-6 h-6 bg-brand-100 rounded-lg flex items-center justify-center text-brand-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Asisten AI</span>
                </div>
                <div class="content-box bg-white p-6 rounded-3xl rounded-tl-none border border-slate-100 shadow-sm text-sm font-medium leading-relaxed text-slate-500 italic flex items-center">
                    <span class="flex space-x-1 mr-2"><span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce"></span><span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.2s"></span><span class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.4s"></span></span>
                    Sedang berpikir...
                </div>
            `;
            outArea.appendChild(botDiv);
            
            outArea.scrollTop = outArea.scrollHeight;
            pesanInput.value = "";

            geminiChat(isiPesan).then(balas => {
                const contentBox = botDiv.querySelector(".content-box");
                contentBox.className = "bg-white p-6 rounded-3xl rounded-tl-none border border-slate-100 shadow-sm text-sm font-medium leading-relaxed text-slate-700";
                contentBox.textContent = balas;
                outArea.scrollTop = outArea.scrollHeight;
            });
        }

        function geminiChat(prompt) {
            const Apikey = "AIzaSyCBn6mWrgbFczFQZWKj9XRMtXIosilGkas";
            return fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=${Apikey}`,
                {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify({
                        contents:[{
                            role: "user",
                            parts: [
                                {text: `Kamu adalah asisten AI yang dikhsuskan untuk SDN 15 Gantung dan hanya menjawab materi tentang sekolah dasar tidak boleh yang lain.
    Jika user menyapa (misalnya: hai, halo, pagi), balas dengan sapaan balik sambil sebut nama user: ${userName}.
    Selain itu, jawab seperti biasa.`},
                                {text: prompt}
                            ]
                        }]
                    })
                }
            )
            .then(res => res.json())
            .then(data => {
                console.log("Gemini Response:", data);
                if(data.candidates && data.candidates.length > 0) {
                    return data.candidates[0].content.parts[0].text;
                } else if (data.error) {
                    console.error("Gemini API Error:", data.error.message);
                    return "⚠️ Error API: " + data.error.message;
                } else {
                    return "⚠️ Gagal mendapatkan jawaban. Pastikan API Key valid dan memiliki kuota.";
                }
            }).catch(err => {
                console.error("Fetch Error:", err);
                return "⚠️ Terjadi kesalahan koneksi atau konfigurasi.";
            });
        }
    </script>
</body>
</html>
