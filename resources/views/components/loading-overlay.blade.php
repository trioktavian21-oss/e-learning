<div id="page-loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/60 backdrop-blur-md transition-opacity duration-500 pointer-events-none opacity-0">
    <div class="perspective-container">
        <div class="cube-3d">
            <div class="cube-face front"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
            <div class="cube-face back"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
            <div class="cube-face right"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
            <div class="cube-face left"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
            <div class="cube-face top"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
            <div class="cube-face bottom"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg></div>
        </div>
    </div>
</div>

<style>
    .perspective-container {
        perspective: 1000px;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cube-3d {
        width: 60px;
        height: 60px;
        position: relative;
        transform-style: preserve-3d;
        animation: rotateCube 3s infinite linear;
    }

    .cube-face {
        position: absolute;
        width: 60px;
        height: 60px;
        background: rgba(14, 165, 233, 0.9);
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 24px;
        color: white;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.2);
        backdrop-filter: blur(5px);
    }

    .front  { transform: rotateY(0deg) translateZ(30px); }
    .back   { transform: rotateY(180deg) translateZ(30px); }
    .right  { transform: rotateY(90deg) translateZ(30px); }
    .left   { transform: rotateY(-90deg) translateZ(30px); }
    .top    { transform: rotateX(90deg) translateZ(30px); }
    .bottom { transform: rotateX(-90deg) translateZ(30px); }

    @keyframes rotateCube {
        from { transform: rotateX(0deg) rotateY(0deg); }
        to { transform: rotateX(360deg) rotateY(360deg); }
    }
</style>

<script>
    window.addEventListener('beforeunload', function () {
        const loader = document.getElementById('page-loader');
        if (loader) {
            loader.classList.remove('pointer-events-none', 'opacity-0');
            loader.classList.add('opacity-100');
        }
    });

    // Handle links
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a');
        if (link && 
            link.href && 
            !link.href.includes('#') && 
            !link.target && 
            link.hostname === window.location.hostname &&
            !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.altKey) {
            
            // Additional check for logout or specific excluding classes
            if (!link.classList.contains('no-loader')) {
                // We show it on beforeunload mainly, but some clicks might need it sooner
                // or if beforeunload is too late. However, beforeunload is most reliable.
            }
        }
    });

    // Handle forms
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('form');
        if (form && !form.classList.contains('no-loader')) {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.classList.remove('pointer-events-none', 'opacity-0');
                loader.classList.add('opacity-100');
            }
        }
    });

    // Hide loader if page is restored from cache (back/forward button)
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.classList.add('pointer-events-none', 'opacity-0');
                loader.classList.remove('opacity-100');
            }
        }
    });
</script>
