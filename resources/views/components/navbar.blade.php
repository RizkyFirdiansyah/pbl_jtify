<nav id="mainNav" class="fixed top-0 z-50 w-full
    flex items-center justify-between
    px-4 sm:px-6 md:px-10 lg:px-16
    py-5
    transition-all duration-400">

    <!-- KIRI: Logo -->
    <div class="flex items-center gap-3 shrink-0">
        <svg class="nav-icon w-7 h-7 transition-colors duration-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>

        <span class="nav-logo font-bold text-xl sm:text-2xl transition-colors duration-400">
            JTIFY
        </span>
    </div>

    <!-- TENGAH: NAV -->
    <div id="navPill" class="flex items-center gap-1
        backdrop-blur-md border
        rounded-full p-1
        transition-all duration-400">

        <!-- BERANDA -->
        <a 
            href="{{ url('/') }}"
            class="nav-link {{ request()->is('/')
                ? 'nav-active'
                : ''
            }}
            flex items-center justify-center
            px-3 sm:px-5 lg:px-8
            py-2.5 rounded-full
            font-semibold text-sm sm:text-base
            transition-all duration-300"
        >
            <!-- ICON MOBILE -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 sm:hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 10.5L12 3l9 7.5V21a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-10.5z"/>
            </svg>

            <!-- TEXT DESKTOP -->
            <span class="hidden sm:block">Beranda</span>
        </a>

        <!-- BOOKMARK -->
        <a 
            href="{{ url('/bookmark') }}"
            class="nav-link {{ request()->is('bookmark')
                ? 'nav-active'
                : ''
            }}
            flex items-center justify-center
            px-3 sm:px-5 lg:px-8
            py-2.5 rounded-full
            font-semibold text-sm sm:text-base
            transition-all duration-300"
        >
            <!-- ICON MOBILE -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 sm:hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 3h14a1 1 0 011 1v17l-8-4-8 4V4a1 1 0 011-1z"/>
            </svg>

            <!-- TEXT DESKTOP -->
            <span class="hidden sm:block">Bookmark</span>
        </a>

        <!-- RECRUITMENT -->
        <a 
            href="{{ url('/recruitment') }}"
            class="nav-link {{ request()->is('recruitment')
                ? 'nav-active'
                : ''
            }}
            flex items-center justify-center
            px-3 sm:px-5 lg:px-8
            py-2.5 rounded-full
            font-semibold text-sm sm:text-base
            transition-all duration-300"
        >
            <!-- ICON MOBILE -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 sm:hidden"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5V18a4 4 0 00-5-3.87M17 20H7m10 0v-2c0-.653-.084-1.287-.24-1.89M7 20H2V18a4 4 0 015-3.87M7 20v-2c0-.653.084-1.287.24-1.89m0 0a5.002 5.002 0 019.52 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>

            <!-- TEXT DESKTOP -->
            <span class="hidden sm:block">Recruitment</span>
        </a>

    </div>

    <!-- KANAN: LOGIN -->
    <a href="{{ url('/login') }}"
    id="navLogin"
    class="px-4 sm:px-6 lg:px-10
    py-2.5 sm:py-3
    rounded-full font-semibold
    text-sm sm:text-base
    shadow-lg shrink-0
    hover:-translate-y-1
    hover:shadow-2xl
    active:scale-95
    transition-all duration-400">
        Login
    </a>

</nav>

<style>
    /* ── STATE: Transparan (di atas header bergambar) ── */
    .nav-transparent #navPill {
        background: rgba(255,255,255,0.18);
        border-color: rgba(255,255,255,0.30);
    }
    .nav-transparent .nav-logo,
    .nav-transparent .nav-icon  { color: rgba(255,255,255,0.85); }
    .nav-transparent .nav-link  { color: rgba(255,255,255,0.85); }
    .nav-transparent .nav-link:hover { background: rgba(255,255,255,0.20); }
    .nav-transparent .nav-active {
        background: white;
        color: #1e3a5f;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
    }
    .nav-transparent #navLogin {
        background: #2D3A6B;
        color: white;
    }

    /* ── STATE: Solid (setelah scroll / halaman tanpa hero) ── */
    .nav-solid {
        background: rgba(255,255,255,0.96);
        backdrop-filter: blur(16px);
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }
    .nav-solid #navPill {
        background: rgba(26,46,90,0.07);
        border-color: rgba(26,46,90,0.12);
    }
    .nav-solid .nav-logo,
    .nav-solid .nav-icon  { color: #1A2E5A; }
    .nav-solid .nav-link  { color: #1A2E5A; }
    .nav-solid .nav-link:hover { background: rgba(26,46,90,0.08); }
    .nav-solid .nav-active {
        background: #1A2E5A;
        color: white;
        box-shadow: 0 2px 8px rgba(26,46,90,0.30);
    }
    .nav-solid #navLogin {
        background: #1A2E5A;
        color: white;
    }
</style>

<script>
(function () {
    const nav = document.getElementById('mainNav');

    // Deteksi apakah halaman ini punya hero/header bergambar gelap di atas
    // (homepage dan halaman dengan header-konten SVG biru-gelap).
    // Jika tidak ada elemen header bergambar, langsung solid.
    function hasHeroHeader() {
        return !!(
            document.querySelector('header[style*="background-image"]') ||
            document.querySelector('header[style*="header-konten"]')
        );
    }

    function applyNavState() {
        const scrolled = window.scrollY > 60;
        const hasHero  = hasHeroHeader();

        if (!hasHero || scrolled) {
            nav.classList.remove('nav-transparent');
            nav.classList.add('nav-solid');
        } else {
            nav.classList.remove('nav-solid');
            nav.classList.add('nav-transparent');
        }
    }

    // Jalankan segera (sebelum paint) agar tidak ada flash
    applyNavState();

    window.addEventListener('scroll', applyNavState, { passive: true });

    // Untuk halaman yang load lebih lambat (Vite), jalankan ulang setelah DOM selesai
    document.addEventListener('DOMContentLoaded', applyNavState);
})();
</script>