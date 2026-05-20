<nav class="fixed top-0 z-50 w-full
    flex items-center justify-between
    px-4 sm:px-6 md:px-10 lg:px-16
    py-5">

    <!-- KIRI: Logo -->
    <div class="flex items-center gap-3 shrink-0">
        <svg class="w-7 h-7 text-white opacity-70" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>

        <span class="text-white font-bold text-xl sm:text-2xl opacity-70">
            JTIFY
        </span>
    </div>

    <!-- TENGAH: NAV -->
    <div class="flex items-center gap-1
        bg-white/20 backdrop-blur-md border border-white/30
        rounded-full p-1">

        <!-- BERANDA -->
        <a 
            href="{{ url('/') }}"
            class="{{ request()->is('/') 
                ? 'bg-white text-blue-900 shadow-sm' 
                : 'text-white hover:bg-white/20' 
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
            class="{{ request()->is('bookmark') 
                ? 'bg-white text-blue-900 shadow-sm' 
                : 'text-white hover:bg-white/20' 
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
            class="{{ request()->is('recruitment') 
                ? 'bg-white text-blue-900 shadow-sm' 
                : 'text-white hover:bg-white/20' 
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
    class="bg-[#2D3A6B] text-white
    px-4 sm:px-6 lg:px-10
    py-2.5 sm:py-3
    rounded-full font-semibold
    text-sm sm:text-base
    shadow-lg shrink-0

    hover:-translate-y-1
    hover:shadow-2xl
    active:scale-95

    transition-all duration-300 ease-out">

    Login
    </a>

</nav>