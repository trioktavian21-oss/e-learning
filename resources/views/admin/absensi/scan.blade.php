@extends('layouts.admin')

@section('title', 'Scan Absensi')
@section('page_title', 'QR Scanner Kehadiran')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header Section -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Scanner QR Code</h2>
        <p class="text-sm text-slate-500 font-medium">Arahkan QR Code siswa ke kamera untuk mencatat kehadiran otomatis</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <!-- Left Column: Scanner -->
        <div class="bg-black/95 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-b from-brand-500/10 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center">
                <!-- Camera Viewport -->
                <div class="relative w-full aspect-video md:max-w-md bg-slate-900 rounded-3xl overflow-hidden border-4 border-slate-800 shadow-inner group-hover:border-brand-500/30 transition duration-500">
                    <video id="video" class="w-full h-full object-cover transform scale-x-[-1]"></video>
                    
                    <!-- Scanner Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 sm:w-64 sm:h-64 border-2 border-brand-400 opacity-20 relative">
                            <div class="absolute -top-1 -left-1 w-6 h-6 border-t-4 border-l-4 border-brand-500 rounded-tl-lg"></div>
                            <div class="absolute -top-1 -right-1 w-6 h-6 border-t-4 border-r-4 border-brand-500 rounded-tr-lg"></div>
                            <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-4 border-l-4 border-brand-500 rounded-bl-lg"></div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-4 border-r-4 border-brand-500 rounded-br-lg"></div>
                            <div class="absolute top-0 left-0 w-full h-0.5 bg-brand-500 shadow-[0_0_15px_#0ea5e9] animate-scanline"></div>
                        </div>
                    </div>
                </div>

                <div id="result" class="mt-6 text-sm font-bold tracking-wide transition-all duration-300"></div>

                <div class="flex flex-col sm:flex-row gap-4 mt-8 w-full md:max-w-md">
                    <button id="startButton" class="flex-grow inline-flex items-center justify-center px-8 py-4 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-black transition shadow-xl shadow-brand-600/40">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                        MULAI SCAN
                    </button>
                </div>

                <div class="mt-8 pt-8 border-t border-white/10 w-full md:max-w-md">
                    <label for="uploadQRCode" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1 text-center">Atau Unggah Gambar</label>
                    <input type="file" id="uploadQRCode" accept="image/*" class="w-full text-sm text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:bg-white/10 file:text-white hover:file:bg-white/20 transition cursor-pointer" />
                </div>
            </div>
        </div>

        <!-- Right Column: Results & List -->
        <div class="space-y-6">
            <!-- Scanned User Info -->
            <div id="scannedUserContainer" class="hidden animate-fade-in-up">
                <div class="bg-emerald-50 border border-emerald-100 rounded-3xl p-6 shadow-xl shadow-emerald-500/10">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-emerald-900 leading-tight">Konfirmasi Kehadiran</h3>
                            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Siswa Teridentifikasi</p>
                        </div>
                    </div>
                    <div class="space-y-3 bg-white/50 rounded-2xl p-4 border border-emerald-200/50">
                        <div class="flex justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase">Nama</span>
                            <span id="scannedUserName" class="text-sm font-black text-slate-900"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase">NISN</span>
                            <span id="scannedUserNisn" class="text-sm font-black text-slate-900 font-mono"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs font-bold text-slate-500 uppercase">Status</span>
                            <span id="scannedUserStatus" class="inline-flex px-2 py-1 rounded-lg bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance List -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 uppercase tracking-wider text-xs">Daftar Kehadiran Hari Ini</h3>
                    <span class="text-[10px] font-black text-brand-600 bg-brand-50 px-2 py-1 rounded-lg uppercase italic">{{ date('d M Y') }}</span>
                </div>
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full text-sm text-left">
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($users as $user)
                                @php
                                    $hadirHariIni = $user->presensis->isNotEmpty() && $user->presensis->first()->aksi === 'hadir';
                                @endphp
                                <tr data-user-id="{{ $user->id }}" class="hover:bg-slate-50 transition group">
                                    <td class="px-6 py-4">
                                        <div class="text-slate-900 font-bold text-sm">{{ $user->name }}</div>
                                        <div class="text-slate-400 text-xs font-medium">{{ $user->nisn }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right status-kehadiran">
                                        @if($hadirHariIni)
                                            <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">Hadir</span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase bg-slate-50 text-slate-400 border border-slate-100">Absen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes scanline {
        0%, 100% { top: 0; }
        50% { top: 100%; }
    }
    .animate-scanline {
        animation: scanline 3s linear infinite;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('video');
        const result = document.getElementById('result');
        const startButton = document.getElementById('startButton');
        const uploadInput = document.getElementById('uploadQRCode');
        const scannedUserContainer = document.getElementById('scannedUserContainer');

        let scanning = false;
        let isProcessing = false;
        let videoStream;
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        startButton.addEventListener('click', () => {
            scanning ? stopScan() : startScan();
        });

        uploadInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            readQRCodeFromFile(file);
        });

        function readQRCodeFromFile(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    
                    // Scale down if image is too large for jsQR
                    const maxDim = 1000;
                    let width = img.width;
                    let height = img.height;
                    if (width > maxDim || height > maxDim) {
                        const ratio = Math.min(maxDim / width, maxDim / height);
                        width *= ratio;
                        height *= ratio;
                    }
                    
                    canvas.width = width;
                    canvas.height = height;
                    context.drawImage(img, 0, 0, width, height);
                    const imageData = context.getImageData(0, 0, width, height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);
                    
                    if (code) {
                        const scannedData = code.data.trim();
                        console.log("QR Code Scanned from File:", scannedData);
                        isProcessing = true;
                        sendToServer(scannedData);
                    } else {
                        result.className = 'mt-6 text-sm font-bold text-rose-500 uppercase tracking-widest';
                        result.textContent = "Gagal membaca QR Code dari gambar. Pastikan gambar jelas.";
                    }
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }

        async function startScan() {
            try {
                // Attempt 1: Preferred camera
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
                handleStream(stream);
            } catch (err) {
                console.warn("Attempt 1 (front camera) failed:", err);
                try {
                    // Attempt 2: Fallback to any camera
                    const fallbackStream = await navigator.mediaDevices.getUserMedia({ video: true });
                    handleStream(fallbackStream);
                } catch (fallbackErr) {
                    console.error("All camera access attempts failed:", fallbackErr);
                    showCameraError(fallbackErr);
                }
            }
        }

        function handleStream(stream) {
            scanning = true;
            startButton.innerHTML = '<span class="flex items-center"><svg class="w-5 h-5 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd"></path></svg> BERHENTI SCAN</span>';
            startButton.className = 'flex-grow inline-flex items-center justify-center px-8 py-4 bg-rose-600 hover:bg-rose-500 text-white rounded-2xl font-black transition shadow-xl shadow-rose-600/40';
            videoStream = stream;
            video.srcObject = stream;
            video.setAttribute('playsinline', true);
            
            // Catch play interruptions (AbortError)
            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    console.warn("Video play interrupted or failed:", error);
                });
            }
            tick();
        }

        function showCameraError(err) {
            result.className = 'mt-6 text-sm font-bold text-rose-500 uppercase tracking-widest';
            
            if (err.name === 'NotReadableError' || err.name === 'TrackStartError') {
                result.innerHTML = `
                    <div class="bg-rose-50 border border-rose-100 p-4 rounded-2xl text-rose-800 normal-case font-normal text-left">
                        <strong class="block mb-1 font-black uppercase text-xs tracking-wider">Kamera Tidak Dapat Diakses (Device in use)</strong>
                        <p class="mb-2 text-xs">Aplikasi lain mungkin sedang menggunakan kamera Anda (Zoom, WhatsApp Desktop, dll).</p>
                        <ul class="list-disc ml-4 space-y-1 text-[11px] font-bold">
                            <li>Tutup aplikasi lain yang menggunakan kamera</li>
                            <li>Pastikan browser memiliki izin di pengaturan Windows/macOS</li>
                            <li>Coba muat ulang halaman atau restart browser</li>
                        </ul>
                    </div>
                `;
            } else if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                result.textContent = 'Izin kamera ditolak. Harap izinkan akses kamera di browser.';
            } else {
                result.textContent = 'Gagal akses kamera: ' + err.message;
            }
        }

        function stopScan() {
            scanning = false;
            startButton.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg> MULAI SCAN';
            startButton.className = 'flex-grow inline-flex items-center justify-center px-8 py-4 bg-brand-600 hover:bg-brand-500 text-white rounded-2xl font-black transition shadow-xl shadow-brand-600/40';
            video.pause();
            if (videoStream) {
                videoStream.getTracks().forEach(t => t.stop());
                videoStream = null;
            }
            video.srcObject = null;
        }

        function tick() {
            if (!scanning || isProcessing) return;

            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height);

                if (code) {
                    const scannedData = code.data.trim();
                    console.log("QR Code Scanned:", scannedData);
                    isProcessing = true;
                    // stopScan(); // REMOVED: keep camera active
                    sendToServer(scannedData);
                    return; 
                }
            }
            requestAnimationFrame(tick);
        }

        function sendToServer(userId) {
            result.className = 'mt-6 text-sm font-bold text-brand-400 animate-pulse uppercase tracking-widest';
            result.textContent = 'MEMPROSES DATA...';
            
            // Generate URL: switch to relative if current host doesn't match APP_URL
            let targetUrl = "{{ route('admin.absensi.scan.store') }}";
            
            // Force HTTPS if the current page is HTTPS
            if (window.location.protocol === 'https:' && targetUrl.startsWith('http:')) {
                targetUrl = targetUrl.replace('http:', 'https:');
            }
            
            const currentHost = window.location.host;
            const urlObj = new URL(targetUrl);
            if (urlObj.host !== currentHost) {
                // If there's a mismatch (likely local vs production), use relative path
                targetUrl = urlObj.pathname + urlObj.search;
                console.warn("Domain mismatch detected. Using relative URL:", targetUrl);
            }
            
            fetch(targetUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(async res => {
                const text = await res.text();
                let json = null;
                try {
                    json = JSON.parse(text);
                } catch(e) {}
                
                if (!res.ok) throw { status: res.status, body: json, raw: text };
                return json;
            })
            .then(data => {
                result.className = 'mt-6 text-sm font-bold text-emerald-500 uppercase tracking-widest';
                result.textContent = data.message;

                scannedUserContainer.classList.remove('hidden');
                document.getElementById('scannedUserName').textContent = data.user.name;
                document.getElementById('scannedUserNisn').textContent = data.user.nisn;
                document.getElementById('scannedUserStatus').textContent = data.user.status;

                const statusCell = document.querySelector(`tr[data-user-id="${data.user.id}"] .status-kehadiran`);
                if (statusCell) {
                    statusCell.innerHTML = `<span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">Hadir</span>`;
                }
            })
            .catch(err => {
                console.error("Scan Process Error:", err);
                let msg = 'Gagal memproses QR';
                
                if (err.status) {
                    if (err.status === 404 && err.body && err.body.message) {
                        msg = err.body.message; // "User tidak ditemukan"
                    } else if (err.status === 419) {
                        msg = "Sesi kadaluarsa, silakan refresh halaman.";
                    } else {
                        msg = `Error Server (${err.status})`;
                    }
                }
                
                result.className = 'mt-6 text-sm font-bold text-rose-500 uppercase tracking-widest';
                result.textContent = msg;
            })
            .finally(() => {
                // Cooldown 3 seconds before next scan
                setTimeout(() => {
                    isProcessing = false;
                    if (scanning) {
                        result.className = 'mt-6 text-sm font-bold text-brand-500 animate-pulse uppercase tracking-widest';
                        result.textContent = 'SIAP SCAN BERIKUTNYA...';
                    }
                }, 3000);
            });
        }
    });
</script>
@endsection
