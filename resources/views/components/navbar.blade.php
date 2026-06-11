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
            {{ $pageContents['navbar']['brand_name'] ?? ($siteSettings['logo_text'] ?? 'JTIFY') }}
        </a>
    </div>

    <!-- TENGAH: Nav pill -->
    <div id="navPill" class="flex items-center gap-1 backdrop-blur-md border rounded-full p-1 transition-all duration-400">

        <a href="{{ route('home') }}"
           class="nav-link {{ request()->routeIs('home') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 10.5L12 3l9 7.5V21a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1v-10.5z"/>
            </svg>
            <span class="hidden sm:block">{{ $pageContents['navbar']['menu_home'] ?? 'Beranda' }}</span>
        </a>

        <a href="{{ route('tips') }}"
           class="nav-link {{ request()->routeIs('tips') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 3h14a1 1 0 011 1v17l-8-4-8 4V4a1 1 0 011-1z"/>
            </svg>
            <span class="hidden sm:block">{{ $pageContents['navbar']['menu_tips'] ?? 'Tips' }}</span>
        </a>

        <a href="{{ route('tentang') }}"
           class="nav-link {{ request()->routeIs('tentang') ? 'nav-active' : '' }}
                  flex items-center justify-center px-3 sm:px-5 lg:px-8 py-2.5 rounded-full
                  font-semibold text-sm sm:text-base transition-all duration-300">
            <svg class="w-5 h-5 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5V18a4 4 0 00-5-3.87M17 20H7m10 0v-2c0-.653-.084-1.287-.24-1.89M7 20H2V18a4 4 0 015-3.87M7 20v-2c0-.653.084-1.287.24-1.89m0 0a5.002 5.002 0 019.52 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="hidden sm:block">{{ $pageContents['navbar']['menu_tentang'] ?? 'Tentang Kami' }}</span>
        </a>

    </div>

    <!-- KANAN: Guest → Login | Auth → Pill -->
    @guest
        <a href="{{ route('login') }}"
           id="navLogin"
           class="px-4 sm:px-6 lg:px-10 py-2.5 sm:py-3 rounded-full font-semibold
                  text-sm sm:text-base shadow-lg shrink-0
                  hover:-translate-y-1 hover:shadow-2xl active:scale-95
                  transition-all duration-400">
            {{ $pageContents['navbar']['login_label'] ?? 'Login' }}
        </a>
    @endguest

    @auth
    <div class="flex items-center shrink-0 relative">

        {{-- Oval pill: Notif + Divider + Avatar + Nama + Chevron --}}
        <div class="profile-pill flex items-center gap-2 px-2 py-1.5 rounded-full
                    border font-semibold text-sm transition-all duration-300 cursor-pointer">

            {{-- Icon notif (klik = buka notif dropdown) --}}
            <div class="relative" onclick="interceptNotif(event)">
                <div class="w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"
                               stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span id="notifDot" class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full {{ (auth()->check() && auth()->user()->userNotifications()->where('is_read', false)->exists()) ? '' : 'hidden' }}"></span>
                </div>
            </div>

            {{-- Divider --}}
            <span class="pill-divider w-px h-5 opacity-30"></span>

            {{-- Avatar + Nama + Chevron (klik = buka profile dropdown) --}}
            <div class="flex items-center gap-2" onclick="interceptProfile(event)">
                <div class="profile-avatar w-7 h-7 rounded-full flex items-center justify-center
                            font-bold text-xs shrink-0">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                </div>

                <svg id="pillChevron" width="14" height="14" viewBox="0 0 24 24" fill="none"
                     class="mr-1 transition-transform duration-300 opacity-70">
                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        {{-- Dropdown notifikasi --}}
        <div id="notifDropdown"
             class="hidden absolute right-0 top-14 w-80 bg-white rounded-2xl
                    shadow-[0_8px_40px_rgba(0,0,0,0.15)] border border-gray-100 z-50 overflow-hidden">

            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                <span class="font-bold text-sm text-[#1A2E5A]">Notifikasi</span>
                @if(auth()->check() && auth()->user()->userNotifications()->exists())
                <button onclick="hapusSemuaNotif()"
                        class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors">
                    Hapus semua
                </button>
                @endif
            </div>

            <div id="notifList" class="max-h-72 overflow-y-auto divide-y divide-gray-50
                                       [&::-webkit-scrollbar]:w-1.5
                                       [&::-webkit-scrollbar-track]:bg-gray-50
                                       [&::-webkit-scrollbar-thumb]:bg-gray-200
                                       [&::-webkit-scrollbar-thumb]:rounded-full">
                @php
                    if (auth()->check()) {
                        \App\Models\Notification::generateBookmarkReminders(auth()->id());
                    }
                    $notifs = auth()->check() ? auth()->user()->userNotifications()->latest()->take(10)->get() : collect();
                @endphp

                @forelse($notifs as $i => $n)
                <div id="notif-{{ $i }}"
                     data-id="{{ $n->id }}"
                     data-read="{{ $n->is_read ? 'true' : 'false' }}"
                     class="flex items-start gap-3 px-4 py-3
                            {{ $n->is_read ? 'bg-white' : 'bg-blue-50' }}
                            transition-colors">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-[#1A2E5A] truncate">{{ $n->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $n->message }}</p>
                    </div>
                    <button onclick="toggleNotifAction({{ $n->id }}, this, {{ $i }})"
                            class="flex-shrink-0 mt-0.5 transition-colors"
                            title="{{ $n->is_read ? 'Hapus notifikasi' : 'Tandai dibaca' }}">
                        @if($n->is_read)
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-400">
                                <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        @else
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-green-500">
                                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        @endif
                    </button>
                </div>
                @empty
                <p class="text-center text-xs text-gray-400 py-6">
                    Tidak ada notifikasi
                </p>
                @endforelse
            </div>
        </div>

        {{-- Dropdown profil (Diposisikan sejajar di sini) --}}
        <div id="profileDropdown"
             class="profile-dropdown absolute right-0 top-14 w-56 bg-white
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
                    {{ $pageContents['navbar']['profile_setting_label'] ?? 'Setting Profile' }}
                </a>

                {{-- Bookmark --}}
                <a href="{{ route('bookmark') }}"
                   class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    {{ $pageContents['navbar']['profile_bookmark_label'] ?? 'Bookmark' }}
                </a>

                {{-- Disukai --}}
                <a href="{{ route('peminatan') }}"
                   class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 opacity-60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    {{ $pageContents['navbar']['profile_disukai_label'] ?? 'Disukai' }}
                </a>

                @if(auth()->user()?->isAdmin() || auth()->user()?->isCollaborator())
                {{-- Admin Dashboard --}}
                <a href="/admin"
                   class="dropdown-item flex items-center gap-3 px-4 py-2.5 text-sm font-medium transition-colors duration-200" style="color: #3b82f6;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                    Admin Dashboard
                </a>
                @endif

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
                        {{ $pageContents['navbar']['logout_label'] ?? 'Log Out' }}
                    </button>
                </form>
            </div>

        </div>

        {{-- Overlay --}}
        <div id="profileOverlay" class="fixed inset-0 z-40 hidden"
             onclick="closeAllDropdowns()"></div>

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
    .nav-transparent #navLogin {
        background: #2D3A6B;
        color: white;
    }
    .nav-transparent .profile-pill {
        background: rgba(255,255,255,0.15);
        border-color: rgba(255,255,255,0.35);
        color: rgba(255,255,255,0.90);
    }
    .nav-transparent .profile-pill:hover {
        background: rgba(255,255,255,0.25);
    }
    .nav-transparent .profile-avatar {
        background: rgba(255,255,255,0.25);
        color: white;
    }
    .nav-transparent .pill-divider { background: white; }

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
    .nav-solid #navLogin {
        background: #1A2E5A;
        color: white;
    }
    .nav-solid .profile-pill {
        background: rgba(26,46,90,0.08);
        border-color: rgba(26,46,90,0.18);
        color: #1A2E5A;
    }
    .nav-solid .profile-pill:hover {
        background: rgba(26,46,90,0.14);
    }
    .nav-solid .profile-avatar {
        background: #1A2E5A;
        color: white;
    }
    .nav-solid .pill-divider { background: white; }

    /* ══════════════════════════════════
        DROPDOWN STYLES
    ══════════════════════════════════ */
    .profile-dropdown {
        background: white;
        border-color: rgba(26,46,90,0.10);
    }
    .dropdown-header { border-color: rgba(26,46,90,0.08); }
    .dropdown-item { color: #1A2E5A; }
    .dropdown-item:hover {
        background: rgba(26,46,90,0.06);
        color: #1A2E5A;
    }
    .dropdown-logout { color: #dc2626; }
    .dropdown-logout:hover {
        background: rgba(220,38,38,0.06);
        color: #dc2626;
    }
    .profile-dropdown.open {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Chevron rotate saat dropdown terbuka */
    .profile-pill.pill-open #pillChevron {
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

/* ── Tutup semua dropdown ── */
function closeAllDropdowns() {
    document.getElementById('profileDropdown')?.classList.remove('open');
    document.getElementById('profileOverlay')?.classList.add('hidden');
    document.getElementById('notifDropdown')?.classList.add('hidden');
    document.querySelector('.profile-pill')?.classList.remove('pill-open');
}

/* ── Klik icon notif → buka notif dropdown ── */
function interceptNotif(e) {
    e.stopPropagation();
    const notifDD = document.getElementById('notifDropdown');
    const isOpen  = !notifDD.classList.contains('hidden');
    closeAllDropdowns();
    if (!isOpen) {
        notifDD.classList.remove('hidden');
        document.getElementById('profileOverlay').classList.remove('hidden');
        document.querySelector('.profile-pill').classList.add('pill-open');
    }
}

/* ── Klik avatar/nama/chevron → buka profile dropdown ── */
function interceptProfile(e) {
    e.stopPropagation();
    const profileDD = document.getElementById('profileDropdown');
    const isOpen    = profileDD.classList.contains('open');
    closeAllDropdowns();
    if (!isOpen) {
        profileDD.classList.add('open');
        document.getElementById('profileOverlay').classList.remove('hidden');
        document.querySelector('.profile-pill').classList.add('pill-open');
    }
}

/* ESC tutup semua */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeAllDropdowns();
});

/* ── Notifikasi actions ── */
function toggleNotifAction(id, btn, index) {
    const item = document.getElementById('notif-' + index);
    const isRead = item.dataset.read === 'true';

    if (!isRead) {
        // Tandai dibaca via AJAX
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                item.dataset.read = 'true';
                item.classList.remove('bg-blue-50');
                item.classList.add('bg-white');
                btn.title = 'Hapus notifikasi';
                btn.innerHTML = `
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="text-red-400">
                        <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                `;
                updateNotifDot();
            }
        })
        .catch(err => console.error('Error marking notification as read:', err));
    } else {
        // Hapus via AJAX
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                item.style.transition = 'opacity .2s, transform .2s';
                item.style.opacity = '0';
                item.style.transform = 'translateX(8px)';

                setTimeout(() => {
                    item.remove();
                    updateNotifDot();
                    // If no notifications left in list, show empty state
                    const remainingItems = document.querySelectorAll('#notifList [id^="notif-"]');
                    if (remainingItems.length === 0) {
                        document.getElementById('notifList').innerHTML = `
                            <p class="text-center text-xs text-gray-400 py-6">
                                Tidak ada notifikasi
                            </p>
                        `;
                        // Hide Hapus Semua button
                        const clearBtn = document.querySelector('button[onclick="hapusSemuaNotif()"]');
                        if (clearBtn) clearBtn.remove();
                    }
                }, 200);
            }
        })
        .catch(err => console.error('Error deleting notification:', err));
    }
}

// Tambahan sinkronisasi notif dot
function hapusSemuaNotif() {
    fetch('/notifications/clear', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('notifList').innerHTML = `
                <p class="text-center text-xs text-gray-400 py-6">
                    Tidak ada notifikasi
                </p>
            `;
            // Remove Hapus Semua button
            const clearBtn = document.querySelector('button[onclick="hapusSemuaNotif()"]');
            if (clearBtn) clearBtn.remove();
            updateNotifDot();
        }
    })
    .catch(err => console.error('Error clearing notifications:', err));
}

function updateNotifDot() {
    const notifDot = document.getElementById('notifDot');
    const unreadNotif = document.querySelector('#notifList [data-read="false"]');

    if (unreadNotif) {
        notifDot?.classList.remove('hidden');
    } else {
        notifDot?.classList.add('hidden');
    }
}
</script>