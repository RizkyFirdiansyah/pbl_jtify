<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lomba</title>
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%);
            min-height: 100vh;
        }
        /* Custom gradient colors from Figma */
        .bg-btn-gradient {
            background: linear-gradient(123.03deg, #606EB2 11.1%, #313B6D 56.83%);
        }
    </style>
</head>
<body class="antialiased text-[#898383] relative overflow-x-hidden">

    <!-- ========================================== -->
    <!-- Back Button -->
    <div class="absolute top-[40px] left-6 lg:left-20 z-50">
        <button onclick="history.back()" class="w-[50px] h-[50px] bg-[#486284] hover:bg-[#313B6D] text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg hover:-translate-x-1 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
    </div>
    <!-- ========================================== -->

    <x-header />

    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-[120px] pb-32">
        
        <!-- Hero Title Section -->
        <div class="w-full flex justify-center mb-16 relative z-10">
            <h1 class="text-center font-bold text-[48px] lg:text-[56px] leading-[1.2] text-[#486284] drop-shadow-sm">
                Detail Lengkap <br> Kompetisi Lomba
            </h1>
        </div>

        <!-- Info Bar Section -->
        <div class="w-full bg-white/90 border border-[#898383]/30 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6 relative z-10 backdrop-blur-sm">
            
            <div class="flex flex-wrap md:flex-nowrap items-center w-full justify-between gap-6 md:gap-0">
                <!-- Tanggal -->
                <div class="flex-1 flex items-center gap-4">
                    <div class="text-[#696262]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383] tracking-wide">Tanggal</div>
                        <div class="text-[19px] font-medium text-[#273266]">tgl-bln-thn</div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <!-- Anggota Tim -->
                <div class="flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13M16 3.13C16.8604 3.35031 17.623 3.85071 18.1676 4.55232C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89318 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383] tracking-wide">Anggota Tim</div>
                        <div class="text-[19px] font-medium text-[#273266]">Jumlah Orang</div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <!-- Kategori Lomba -->
                <div class="flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2ZM2 17L12 22L22 17M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383] tracking-wide">Kategori Lomba</div>
                        <div class="text-[19px] font-medium text-[#273266]">Nama Kategori</div>
                    </div>
                </div>
            </div>

            <!-- Tenggat Pendaftaran -->
            <div class="mt-6 md:mt-0 bg-[#FFB8B8] border border-[#DA7171] rounded-xl px-4 py-3 flex items-center gap-4 shrink-0 min-w-max">
                <div class="bg-white rounded-lg w-[42px] h-[42px] flex flex-col justify-center items-center shadow-sm">
                    <span class="text-[19px] font-medium text-[#1E1E1E] leading-none">H-X</span>
                    <span class="text-[7px] font-bold text-[#555555] uppercase mt-1 tracking-wide">Hari</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-bold text-white tracking-widest uppercase mb-1">Tenggat Pendaftaran</span>
                    <span class="text-[19px] font-bold text-[#EE2828] leading-none">tgl-bln-thn</span>
                </div>
            </div>

        </div>

        <!-- Main Content Area -->
        <div class="mt-20 flex flex-col lg:flex-row gap-16 lg:gap-24 items-start">
            
            <!-- Poster Card (Left) -->
            <div class="w-full lg:w-1/3 flex justify-center lg:justify-start">
                <div class="w-[300px] h-[400px] bg-[#DDE0E4] rounded-xl shadow-xl relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300">
                    <!-- Placeholder Icon -->
                    <div class="absolute inset-0 flex items-center justify-center bg-[#85A8F8]/20">
                        <svg class="w-[60px] h-[60px] text-[#486284] group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Description (Right) -->
            <div class="w-full lg:w-2/3 flex flex-col">
                <h1 class="text-[30px] font-semibold text-[#486284] mb-8 text-center lg:text-left">Deskripsi Kompetisi</h1>
                
                <div class="text-[15px] text-[#898383] text-justify space-y-6 leading-relaxed">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-14 flex flex-wrap items-center gap-6 justify-center lg:justify-start">
                    
                    <!-- Button Daftar -->
                    <button class="bg-btn-gradient text-white font-bold text-[20px] px-10 py-3 rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                        Daftar Sekarang
                    </button>

                    <!-- Icon Buttons -->
                    <div class="flex gap-4">
                        <button class="w-[46px] h-[46px] rounded-full bg-btn-gradient flex justify-center items-center text-white shadow-md hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        </button>
                        <button class="w-[46px] h-[46px] rounded-full bg-btn-gradient flex justify-center items-center text-white shadow-md hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                        <button class="w-[46px] h-[46px] rounded-full bg-btn-gradient flex justify-center items-center text-white shadow-md hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Related/Gallery Cards Section -->
        <div class="mt-32 w-full px-2 mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#486284]">Lomba Menarik Lainnya</h2>
                <p class="text-sm md:text-base text-gray-500 mt-1">Temukan kompetisi lain yang mungkin Anda minati</p>
            </div>
            <a href="#" class="hidden md:flex text-[#007DFB] font-medium hover:underline items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div id="gallery-slider" class="w-full overflow-x-auto pb-8" style="scrollbar-width: none; -ms-overflow-style: none;">
            <!-- Sembunyikan scrollbar bawaan untuk tampilan lebih rapi -->
            <style>
                .overflow-x-auto::-webkit-scrollbar {
                    display: none;
                }
            </style>
            
            <div class="flex gap-4 lg:gap-6 w-max px-2">
                @for ($i = 1; $i <= 6; $i++)
                <!-- Card {{ $i }} -->
                <div style="height: 380px; width: 320px;" class="bookmark-card shrink-0 bg-[#E5E7EB] rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group cursor-pointer overflow-hidden flex flex-col justify-end border border-gray-100">
                    <!-- Center Placeholder Icon -->
                    <div class="absolute inset-0 flex items-center justify-center bg-[#E5E7EB] group-hover:bg-[#D1D5DB] transition-colors duration-500 z-0">
                        <svg class="w-16 h-16 text-[#486284]/40 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                        </svg>
                    </div>

                    <!-- Content Overlay on Hover -->
                    <div class="bg-gradient-to-t from-[#273266] via-[#273266]/80 to-transparent p-6 pt-16 flex flex-col justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 relative">
                        <span class="bg-[#FFB8B8] text-[#EE2828] text-[10px] font-bold px-2 py-1 rounded-md w-max mb-2 uppercase tracking-wider">LOMBA</span>
                        <h3 class="text-white font-semibold text-[17px] line-clamp-1 leading-snug">Event Lomba Menarik {{ $i }}</h3>
                        <p class="text-white/70 text-[13px] mt-1.5 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Segera Hadir
                        </p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Script untuk Auto Scroll Horizontal -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const slider = document.getElementById('gallery-slider');
                let isPaused = false;

                function autoScroll() {
                    if (!isPaused) {
                        slider.scrollLeft += 1;
                        // Kembali ke awal jika sudah mencapai ujung kanan
                        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 1) {
                            // Opsional: kita bisa buat jadi 0, tapi akan sedikit 'melompat'.
                            // Ini cara sederhana untuk infinite scroll tanpa menggandakan elemen DOM.
                            slider.scrollLeft = 0;
                        }
                    }
                    requestAnimationFrame(autoScroll);
                }

                // Jeda scroll saat mouse di atas kotak atau saat disentuh
                slider.addEventListener('mouseenter', () => isPaused = true);
                slider.addEventListener('mouseleave', () => isPaused = false);
                slider.addEventListener('touchstart', () => isPaused = true);
                slider.addEventListener('touchend', () => isPaused = false);

                // Mulai animasi
                autoScroll();
            });
        </script>

    </main>

    <!-- ========================================== -->
    <!-- [FOOTER WRAPPER] -->
    <x-footer />
    <!-- ========================================== -->

</body>
</html>
