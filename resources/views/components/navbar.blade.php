<nav id="mainNav" class="fixed top-0 z-50 w-full
    flex items-center justify-between
    px-4 sm:px-6 md:px-10 lg:px-16
    py-5
    transition-all duration-400">

    <!-- KIRI: Logo -->
    <div class="flex items-center gap-3 shrink-0">
        <svg class="nav-icon w-7 h-7 transition-colors duration-400"
             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <a href="{{ route('home') }}" class="nav-logo font-bold text-xl sm:text-2xl transition-colors duration-400">
            JTIFY
        </a>
    </div>

    <!-- TENGAH: Nav pill -->
    <div id="navPill" class="flex items-center gap-1 backdrop-blur-md border rounded-full p-1 transition-all duration-400">

        <!-- Beranda -->
        <a href="{{ route('home') }}"
           class="nav-link {{ request()->routeIs('home') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10.5L12 3l9 7.5V21a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-10.5z"/>
            </svg>
            <span class="hidden sm:block">Beranda</span>
        </a>

        <!-- Tips -->
        <a href="{{ route('tips') }}"
           class="nav-link {{ request()->routeIs('tips') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 3h14a1 1 0 011 1v17l-8-4-8 4V4a1 1 0 011-1z"/>
            </svg>
            <span class="hidden sm:block">Tips</span>
        </a>

        <!-- Tentang Kami -->
        <a href="{{ route('tentang') }}"
           class="nav-link {{ request()->routeIs('tentang') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5V18a4 4 0 00-5-3.87M17 20H7m10 0v-2c0-.653-.084-1.287-.24-1.89M7 20H2V18a4 4 0 015-3.87M7 20v-2c0-.653.084-1.287.24-1.89m0 0a5.002 5.002 0 019.52 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="hidden sm:block">Tentang Kami</span>
        </a>

    </div>

    <!-- KANAN: Guest → Login | Auth → Profile dropdown -->
    @guest
        <a href="{{ route('login') }}"
           id="navLogin"
           class="px-4 sm:px-6 lg:px-10 py-2.5 sm:py-3 rounded-full font-semibold
                  text-sm sm:text-base shadow-lg shrink-0
                  hover:-translate-y-1 hover:shadow-2xl active:scale-95
                  transition-all duration-400">
            Login
        </a>
    @endguest

    @auth
        <!-- Profile Dropdown Wrapper -->
        <div class="relative shrink-0" id="profileDropdownWrapper">

            <!-- Trigger Button -->
            <button
                id="profileBtn"
                onclick="toggleProfileDropdown()"
                class="profile-btn flex items-center gap-2 sm:gap-3
                       px-2 sm:px-3 py-1.5 sm:py-2 rounded-full
                       font-semibold text-sm sm:text-base
                       shadow-lg transition-all duration-400
                       hover:-translate-y-0.5 hover:shadow-xl active:scale-95">

                {{-- Avatar: inisial nama --}}
                <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full
                            flex items-center justify-center
                            bg-white/30 text-inherit font-bold text-sm ring-2 ring-white/60">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>

                {{-- Nama (hidden di mobile sangat kecil) --}}
                <span class="hidden sm:block max-w-[120px] truncate">
                    {{ auth()->user()?->name ?? 'User' }}
                </span>

                {{-- Chevron --}}
                <svg id="profileChevron"
                     class="w-4 h-4 opacity-70 transition-transform duration-300"
                     fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileDropdown"
                 class="profile-dropdown absolute right-0 mt-3 w-56
                        rounded-2xl shadow-2xl border overflow-hidden
                        opacity-0 invisible translate-y-2
                        transition-all duration-300 ease-out z-50">

                {{-- Header: nama & email --}}
                <div class="dropdown-header px-4 py-3 border-b">
                    <p class="font-bold text-sm truncate">{{ auth()->user()?->name ?? 'User' }}</p>
                    <p class="text-xs opacity-60 truncate mt-0.5">{{ auth()->user()?->email ?? '' }}</p>
                </div>

                {{-- Menu items --}}
                <div class="py-1.5">

                    {{-- Setting Profile --}}
                    <a href="{{ route('profile') }}"
                       class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Setting Profile
                    </a>

                    {{-- Bookmark --}}
                    <a href="{{ route('bookmark') }}"
                       class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        Bookmark
                    </a>

                    {{-- Notifikasi --}}
                    <a href="{{ route('peminatan') }}"
                       class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        Notifikasi
                    </a>

                </div>

                {{-- Divider + Logout --}}
                <div class="border-t py-1.5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="dropdown-item dropdown-logout w-full flex items-center gap-3
                                       px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- Overlay transparan untuk menutup dropdown saat klik luar --}}
        <div id="profileOverlay"
             class="fixed inset-0 z-40 hidden"
             onclick="closeProfileDropdown()">
        </div>
    @endauth

</nav>

<style>
    /* ══════════════════════════════════
       NAV TRANSPARENT (di atas hero)
    ══════════════════════════════════ */
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

    /* Login button – transparent mode */
    .nav-transparent #navLogin {
        background: #2D3A6B;
        color: white;
    }

    /* Profile button – transparent mode */
    .nav-transparent .profile-btn {
        background: rgba(255,255,255,0.20);
        color: white;
        border: 1px solid rgba(255,255,255,0.35);
    }
    .nav-transparent .profile-btn:hover {
        background: rgba(255,255,255,0.30);
    }

    /* ══════════════════════════════════
       NAV SOLID (setelah scroll)
    ══════════════════════════════════ */
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

    /* Login button – solid mode */
    .nav-solid #navLogin {
        background: #1A2E5A;
        color: white;
    }

    /* Profile button – solid mode */
    .nav-solid .profile-btn {
        background: #1A2E5A;
        color: white;
        border: 1px solid transparent;
    }
    .nav-solid .profile-btn:hover {
        background: #162750;
    }

    /* ══════════════════════════════════
       DROPDOWN STYLES
    ══════════════════════════════════ */
    .profile-dropdown {
        background: white;
        border-color: rgba(26,46,90,0.10);
    }

    .dropdown-header {
        border-color: rgba(26,46,90,0.08);
    }

    .dropdown-item {
        color: #1A2E5A;
    }

    .dropdown-item:hover {
        background: rgba(26,46,90,0.06);
        color: #1A2E5A;
    }

    .dropdown-logout {
        color: #dc2626;
    }

    .dropdown-logout:hover {
        background: rgba(220,38,38,0.06);
        color: #dc2626;
    }

    /* Dropdown open state */
    .profile-dropdown.open {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    #profileChevron.rotated {
        transform: rotate(180deg);
    }
</style>

<script>
/* ── Scroll: transparent / solid ── */
(function () {
    const nav = document.getElementById('mainNav');

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

    applyNavState();
    window.addEventListener('scroll', applyNavState, { passive: true });
    document.addEventListener('DOMContentLoaded', applyNavState);
})();

/* ── Profile dropdown toggle ── */
function toggleProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    const chevron  = document.getElementById('profileChevron');
    const overlay  = document.getElementById('profileOverlay');

    const isOpen = dropdown.classList.contains('open');

    if (isOpen) {
        closeProfileDropdown();
    } else {
        dropdown.classList.add('open');
        chevron.classList.add('rotated');
        overlay.classList.remove('hidden');
    }
}

function closeProfileDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    const chevron  = document.getElementById('profileChevron');
    const overlay  = document.getElementById('profileOverlay');

    if (dropdown) dropdown.classList.remove('open');
    if (chevron)  chevron.classList.remove('rotated');
    if (overlay)  overlay.classList.add('hidden');
}

/* Tutup dropdown saat tekan Escape */
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeProfileDropdown();
});
</script>