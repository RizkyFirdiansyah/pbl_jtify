<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Lomba</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden">

    {{-- ================================
         NAVBAR
    ================================= --}}
    @include('components.navbar')

    {{-- ================================
         HEADER
    ================================= --}}
    @include('components.header-konten', [
        'title' => 'LOMBA',
        'subtitle' => 'Informasi Lomba'
    ])

    {{-- ================================
         CONTENT
    ================================= --}}
    <section class="relative z-10 pt-16 pb-24 px-4 md:px-8 lg:px-10">
        <div class="max-w-7xl mx-auto">

            {{-- SECTION TITLE --}}
            <div class="mb-10">
                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Explore Competition
                </p>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Temukan
                    <span class="relative inline-block">
                        Lomba Terbaik
                        <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                    </span>
                </h2>
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                
                @for ($i = 0; $i < 8; $i++)
                    <a href="{{ route('detail') }}" 
                    class="group bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.05)] hover:shadow-[0_18px_40px_rgba(0,0,0,0.08)] hover:-translate-y-2 transition-all duration-500 cursor-pointer" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $i * 70 }}">

                        {{-- IMAGE --}}
                        <div class="bg-[#E5E7EB] flex items-center justify-center" style="aspect-ratio: 3/4;">
                            <svg class="w-12 h-12 text-[#9CA3AF]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        {{-- CONTENT --}}
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-bold uppercase tracking-wide bg-[#EEF3FF] text-[#1A2E5A] px-3 py-1 rounded-full">
                                    Competition
                                </span>
                                <span class="text-xs text-gray-400">Online</span>
                            </div>

                            <h3 class="text-sm md:text-base font-bold text-[#1A2E5A] leading-snug line-clamp-2 mb-2">
                                UI/UX Design Competition 2025
                            </h3>

                            <p class="text-xs md:text-sm text-gray-500 leading-relaxed line-clamp-2">
                                Kompetisi desain nasional untuk mahasiswa dengan tema inovasi digital kreatif.
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[11px] text-gray-400">Deadline</p>
                                    <p class="text-xs font-semibold text-[#1A2E5A]">25 Agustus 2025</p>
                                </div>

                                <div class="w-9 h-9 rounded-full bg-[#F4F7FF] flex items-center justify-center text-[#1A2E5A] group-hover:bg-[#1A2E5A] group-hover:text-white transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </a>
                @endfor

            </div>

            {{-- ================================
                 PAGINATION
            ================================= --}}
            <div class="mt-20 flex items-center justify-center gap-2">

                {{-- PREV --}}
                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- ACTIVE PAGE --}}
                <button class="w-10 h-10 rounded-full bg-[#1A2E5A] text-white text-sm font-bold shadow-lg">
                    1
                </button>

                {{-- PAGE --}}
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    2
                </button>
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    3
                </button>

                {{-- DOT --}}
                <span class="px-1 text-gray-400">
                    ...
                </span>

                {{-- LAST --}}
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    68
                </button>

                {{-- NEXT --}}
                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

            </div>

        </div>
    </section>

    {{-- ================================
         FOOTER TRANSITION
    ================================= --}}
    <section class="relative z-0 h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    {{-- ================================
         FOOTER
    ================================= --}}
    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,
            easing: 'ease-out-cubic'
        });
    </script>

</body>
</html>