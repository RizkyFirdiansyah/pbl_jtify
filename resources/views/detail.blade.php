<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - UI/UX Design Competition</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] overflow-x-hidden">

    {{-- ================================
         STICKY BACK BUTTON
    ================================= --}}
    <a href="javascript:history.back()" 
       class="fixed top-24 left-4 md:left-10 z-50 w-12 h-12 bg-[#44567A] text-white rounded-full flex items-center justify-center shadow-lg hover:scale-105 hover:bg-[#2D3A61] transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>


    {{-- NAVBAR (Contoh) --}}
    @include('components.navbar')


    {{-- ================================
         PANGGIL HEADER DETAIL
    ================================= --}}
    @include('components.header-detail', [
        'kategori'      => 'Lomba',
        'title'         => 'UI/UX Design Competition Tingkat Nasional 2026',
    ])


    {{-- ================================
         KONTEN UTAMA DETAIL (INI CONTOHHH AJAAA YAAAA)
    ================================= --}}
    <main class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 pb-24">
        
        <div class="bg-white rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-gray-100 p-4 md:p-5 mb-10 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-0 divide-y md:divide-y-0 md:divide-x divide-gray-100">
            
            <div class="flex-1 w-full text-center py-2 md:py-0 flex flex-col items-center justify-center">
                <div class="flex items-center gap-1.5 text-gray-500 mb-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Tanggal</span>
                </div>
                <p class="font-bold text-[#1A2E5A] text-sm md:text-base">10 Mei 2026</p>
            </div>

            <div class="flex-1 w-full text-center py-2 md:py-0 flex flex-col items-center justify-center">
                <div class="flex items-center gap-1.5 text-gray-500 mb-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Anggota Tim</span>
                </div>
                <p class="font-bold text-[#1A2E5A] text-sm md:text-base">2-3 Orang</p>
            </div>

            <div class="flex-1 w-full text-center py-2 md:py-0 flex flex-col items-center justify-center">
                <div class="flex items-center gap-1.5 text-gray-500 mb-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span class="text-xs font-semibold uppercase tracking-wider">Kategori Lomba</span>
                </div>
                <p class="font-bold text-[#1A2E5A] text-sm md:text-base">Hackathon</p>
            </div>

            <div class="flex-1 w-full flex justify-center py-2 md:py-0 px-2 md:px-6">
                <div class="bg-[#FFAFA3] rounded-xl px-4 py-2 w-full flex items-center gap-3">
                    <div class="bg-white text-[#D94141] rounded-lg p-2 font-black text-center shadow-sm w-12 flex-shrink-0 leading-none">
                        <span class="block text-xl">07</span>
                        <span class="block text-[8px] uppercase mt-1 tracking-wider">Hari</span>
                    </div>
                    <div class="text-[#8A1A1A] text-left">
                        <span class="block text-[9px] sm:text-[10px] font-bold uppercase tracking-wide">Tutup Pendaftaran dalam</span>
                        <span class="block text-xs sm:text-sm font-black mt-0.5">27 MEI 2026</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-14 bg-white rounded-3xl p-6 md:p-10 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100 mb-12">
            
            <div class="w-full lg:w-5/12 flex-shrink-0">
                <div class="w-full aspect-[3/4] bg-[#E2E8F0] rounded-2xl flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#94A3B8]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <div class="w-full lg:w-7/12 flex flex-col justify-center">
                
                <h2 class="text-2xl md:text-3xl font-bold text-[#2A3B66] mb-6">Deskripsi Kompetisi</h2>
                
                <div class="text-gray-500 text-sm md:text-base leading-relaxed space-y-5 mb-10 text-justify">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 md:gap-4 mt-auto">
                    
                    <button class="bg-[#3B4C7E] text-white font-medium text-sm md:text-base px-8 py-3.5 rounded-full hover:bg-[#2D3A61] transition-colors flex-1 sm:flex-none text-center shadow-md">
                        Daftar Sekarang
                    </button>
                    
                    <button class="w-12 h-12 bg-[#3B4C7E] text-white rounded-full flex items-center justify-center hover:bg-[#2D3A61] transition-colors shadow-md flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    </button>

                    <button class="w-12 h-12 bg-[#3B4C7E] text-white rounded-full flex items-center justify-center hover:bg-[#2D3A61] transition-colors shadow-md flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>

                    <button class="w-12 h-12 bg-[#3B4C7E] text-white rounded-full flex items-center justify-center hover:bg-[#2D3A61] transition-colors shadow-md flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </button>

                </div>
            </div>

        </div>

        <div class="bg-white rounded-3xl p-6 md:p-10 shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-gray-100">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                
                @for($i=0; $i<4; $i++)
                <div class="w-full aspect-[3/4] bg-[#E2E8F0] rounded-xl flex items-center justify-center">
                    <svg class="w-10 h-10 text-[#94A3B8]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endfor

            </div>
        </div>

    </main>

    {{-- FOOTER (Contoh) --}}
    @include('components.footer')

</body>
</html>