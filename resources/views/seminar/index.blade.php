<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Seminar</title>

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
        'title'      => 'Seminar',
        'subtitle1'  => 'Perluas',
        'highlight1' => 'Wawasan,',
        'subtitle2'  => 'Tingkatkan',
        'highlight2' => 'Pengetahuan'
    ])

    {{-- ================================
         CONTENT
    ================================= --}}
    <section class="relative z-10 pt-16 pb-24 px-4 md:px-8 lg:px-10">
        <div class="max-w-7xl mx-auto">

            {{-- SECTION TITLE --}}
            <div class="mb-10">
                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Explore Seminar
                </p>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Temukan
                    <span class="relative inline-block">
                        Seminar Terbaik
                        <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                    </span>
                </h2>
            </div>

            {{-- GRID --}}
            @php
                $seminarData = [
                    ['title' => 'Seminar Inovasi Teknologi Nasional',    'deadline' => '12 Jun 2025'],
                    ['title' => 'Workshop Kecerdasan Buatan & ML',        'deadline' => '19 Jun 2025'],
                    ['title' => 'Seminar Kewirausahaan Digital 2025',     'deadline' => '26 Jun 2025'],
                    ['title' => 'Webinar Pengembangan Karier Mahasiswa',  'deadline' => '03 Jul 2025'],
                    ['title' => 'Talk Show Startup & Inovasi Muda',       'deadline' => '10 Jul 2025'],
                    ['title' => 'Seminar Nasional Pendidikan 4.0',        'deadline' => '17 Jul 2025'],
                    ['title' => 'Workshop Desain Grafis Profesional',     'deadline' => '24 Jul 2025'],
                    ['title' => 'Webinar Cloud Computing & DevOps',       'deadline' => '31 Jul 2025'],
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">

                @foreach ($seminarData as $i => $item)
                    <a href="{{ route('seminar.detail') }}"
                       class="group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                       style="aspect-ratio: 2/3;"
                       data-aos="fade-up"
                       data-aos-delay="{{ $i * 70 }}">

                        {{-- Poster Placeholder --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                            <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                            </svg>
                        </div>


                        {{-- Content Overlay --}}
                        <div class="absolute bottom-0 left-0 right-0 z-10 p-4"
                             style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">

                            {{-- Judul --}}
                            <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                                {{ $item['title'] }}
                            </h3>

                            {{-- Deadline --}}
                            <div class="flex items-center gap-1.5 mb-3">
                                <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-white/70 text-[11px]">Deadline: {{ $item['deadline'] }}</span>
                            </div>

                            {{-- Tombol Lihat Detail --}}
                            <span class="inline-flex items-center gap-2 w-full justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white text-xs font-bold py-2 rounded-xl transition-all duration-300 group-hover:bg-[#3B4C7E] group-hover:border-[#3B4C7E]">
                                Lihat Detail
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>

                        </div>

                    </a>
                @endforeach

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
