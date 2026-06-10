<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Homepage</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-white overflow-x-hidden">

    @include('components.navbar')

    <!-- HEADER -->
    <header class="relative w-full min-h-[700px] bg-no-repeat bg-cover bg-center flex flex-col pt-24 overflow-hidden"
            style="background-image: url('{{ asset('assets/homepage.svg') }}');">

        <div class="flex-1 flex flex-col items-center justify-start relative z-10 px-4 text-center pt-16">

            <!-- JTIFY -->
            <div class="relative inline-block mb-4 anim-jtify">
                <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>
                <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none px-4 py-2 tracking-wider drop-shadow-xl"
                    style="font-size: clamp(4rem, 7vw, 6rem);">JTIFY</h1>
            </div>

            <!-- Subtitle -->
            <div class="mb-14">
                <h2 class="anim-line1 font-extrabold text-[#1A2E5A] leading-snug"
                    style="font-size: clamp(1.5rem, 3vw, 2.2rem);">
                    Temukan <span class="bg-[#4C75F2] text-white px-2 py-0.5 rounded-sm">Peluang,</span>
                </h2>
                <h2 class="anim-line2 font-extrabold text-[#1A2E5A] leading-snug"
                    style="font-size: clamp(1.5rem, 3vw, 2.2rem);">
                    Tingkatkan <span class="bg-[#E0A6F2] text-[#1A2E5A] px-2 py-0.5 rounded-sm">Kompetensi</span>
                </h2>
            </div>

            <!-- Search Bar -->
                <div class="w-full z-20 anim-search px-4" style="max-width: 651px;">
                    <form id="searchForm" method="GET" action="#">
                        <div class="bg-white/95 backdrop-blur-md rounded-full flex items-center shadow-[0_15px_35px_rgba(0,0,0,0.18)] border border-white/50 transition-all duration-500"
                            style="height: 60px; padding: 0 6px;">
                            
                            <!-- Kategori: hidden di mobile -->
                            <div class="hidden sm:flex items-center px-4 border-r border-gray-200 shrink-0">
                                <select name="category" id="categorySelect" class="bg-transparent text-sm text-gray-600 outline-none cursor-pointer font-medium">
                                    <option value="">Kategori</option>
                                    <option value="lomba">Lomba</option>
                                    <option value="seminar">Seminar</option>
                                    <option value="beasiswa">Beasiswa</option>
                                    <option value="workshop">Tips &amp; Insight</option>
                                </select>
                            </div>

                            <!-- Input -->
                            <div class="flex-1 flex items-center px-4 min-w-0">
                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <input type="text" name="q" placeholder="Cari informasi"
                                    class="w-full bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400 min-w-0">
                            </div>

                            <!-- Tombol -->
                            <button type="submit" 
                                    class="bg-[#3B4C7E] text-white px-5 sm:px-8 rounded-full text-sm font-bold hover:bg-[#2D3A61] hover:scale-105 active:scale-95 transition-all duration-300 shrink-0 whitespace-nowrap"
                                    style="height: 46px;">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </header>

    <!-- CATEGORY TABS & CARDS -->
    <section class="mt-20 px-4 md:px-10 w-full overflow-x-hidden">
        <div class="max-w-7xl mx-auto overflow-x-hidden overflow-y-visible">

            <!-- Tabs -->
            <div class="relative mb-10">
                <div id="tabsWrapper" class="border-b border-gray-100 overflow-x-auto [&::-webkit-scrollbar]:hidden"
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    <div class="flex w-full">
                        <button data-tab="0" data-category="popular"
                            class="tab-link pb-4 text-[#1A2E5A] font-bold text-sm md:text-base flex-1 text-center transition whitespace-nowrap capitalize">Popular</button>
                        <button data-tab="1" data-category="lomba"
                            class="tab-link pb-4 text-gray-400 hover:text-[#3B4C7E] font-medium text-sm md:text-base flex-1 text-center transition whitespace-nowrap capitalize">Lomba</button>
                        <button data-tab="2" data-category="seminar"
                            class="tab-link pb-4 text-gray-400 hover:text-[#3B4C7E] font-medium text-sm md:text-base flex-1 text-center transition whitespace-nowrap capitalize">Seminar</button>
                        <button data-tab="3" data-category="beasiswa"
                            class="tab-link pb-4 text-gray-400 hover:text-[#3B4C7E] font-medium text-sm md:text-base flex-1 text-center transition whitespace-nowrap capitalize">Beasiswa</button>
                    </div>
                </div>
                <div id="tabIndicator" class="absolute bottom-0 h-1 bg-[#1A2E5A] rounded-full transition-all duration-300"
                    style="width: 0; left: 0;"></div>
            </div>

            <!-- Dots + Lihat Semua -->
            <div class="mb-6 flex justify-between items-center">
                <div class="flex gap-2" id="paginationDots">
                    <span class="dot w-8 h-2 bg-[#1A2E5A] rounded-full cursor-pointer transition-all duration-300"></span>
                    <span class="dot w-2 h-2 bg-gray-200 rounded-full cursor-pointer transition-all duration-300"></span>
                </div>
                <a href="/" id="lihatSemua" class="text-sm text-gray-400 font-bold hidden items-center gap-1 hover:text-[#3B4C7E] transition">
                    Lihat semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="overflow-x-hidden overflow-y-visible pb-4">
                <div id="cardsSlider" class="flex transition-transform duration-700 ease-in-out cursor-grab active:cursor-grabbing select-none py-3" style="gap: 16px;">
                    @php
                        $cardData = [
                            ['label' => 'Lomba',    'color' => '#FFB8B8', 'text' => '#EE2828'],
                            ['label' => 'Seminar',  'color' => '#B8D4FF', 'text' => '#1A56DB'],
                            ['label' => 'Beasiswa', 'color' => '#B8F5D4', 'text' => '#0D7A4E'],
                            ['label' => 'Lomba',    'color' => '#FFB8B8', 'text' => '#EE2828'],
                            ['label' => 'Seminar',  'color' => '#B8D4FF', 'text' => '#1A56DB'],
                            ['label' => 'Beasiswa', 'color' => '#B8F5D4', 'text' => '#0D7A4E'],
                            ['label' => 'Lomba',    'color' => '#FFB8B8', 'text' => '#EE2828'],
                            ['label' => 'Seminar',  'color' => '#B8D4FF', 'text' => '#1A56DB'],
                        ];
                        $deadlines = [
                            '10 Jun 2025', '15 Jun 2025', '20 Jun 2025', '25 Jun 2025',
                            '30 Jun 2025', '05 Jul 2025', '10 Jul 2025', '15 Jul 2025',
                        ];
                        $titles = [
                            'UI/UX Design Competition 2025',
                            'Seminar Inovasi Teknologi Nasional',
                            'Beasiswa Prestasi Mahasiswa Berprestasi',
                            'Hackathon Data Science Challenge',
                            'Workshop Kecerdasan Buatan & ML',
                            'Beasiswa Polinema Unggulan 2025',
                            'National Coding Competition 2025',
                            'Seminar Kewirausahaan Digital',
                        ];
                    @endphp

                    @for($i = 0; $i < 8; $i++)
                    <div class="card-item flex-none relative" data-index="{{ $i }}">
                        {{-- Seluruh card bisa di-klik --}}
                        <a href="#" class="card-link block group relative rounded-[10px] overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer" style="aspect-ratio: 3/4;">

                            {{-- Poster Placeholder --}}
                            <div class="absolute inset-0 flex items-center justify-center transition-colors duration-500 ">
                                <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                                </svg>
                            </div>

                            {{-- Badge Kategori (top-left) --}}
                            <div class="absolute top-3 left-3 z-20">
                                <span class="card-badge text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full shadow-sm"
                                    style="background: {{ $cardData[$i]['color'] }}; color: {{ $cardData[$i]['text'] }};">
                                    {{ $cardData[$i]['label'] }}
                                </span>
                            </div>

                            {{-- Content overlay gradient (bottom) --}}
                            <div class="absolute bottom-0 left-0 right-0 z-10 p-4"
                                style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">

                                {{-- Judul --}}
                                <h3 class="card-title text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                                    {{ $titles[$i] }}
                                </h3>

                                {{-- Deadline --}}
                                <div class="flex items-center gap-1.5 mb-3">
                                    <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="card-deadline text-white/70 text-[11px]">Deadline: {{ $deadlines[$i] }}</span>
                                </div>

                                {{-- Tombol Lihat Detail --}}
                                <span class="card-detail-btn inline-flex items-center gap-2 w-full justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white text-xs font-bold py-2 rounded-xl transition-all duration-300 group-hover:bg-[#3B4C7E] group-hover:border-[#3B4C7E]">
                                    Lihat Detail
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>

                            </div>

                        </a>
                    </div>
                    @endfor
                </div>
            </div>

        </div>
    </section>

    <!-- JOIN SECTION -->
    <section id="joinSection"
        class="relative mt-24 py-20 md:py-28 overflow-hidden bg-gradient-to-b from-white via-blue-50/60 to-white text-center opacity-0 translate-y-16 transition-all duration-1000">

        <div class="absolute top-10 left-10 w-32 md:w-40 h-32 md:h-40 bg-[#B9D7FF] opacity-30 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-10 w-40 md:w-52 h-40 md:h-52 bg-[#E0A6F2] opacity-20 blur-3xl rounded-full"></div>
        <div class="absolute top-20 left-[10%] md:left-[15%] w-5 md:w-6 h-5 md:h-6 rounded-full bg-[#4C75F2] opacity-30 animate-float-slow"></div>
        <div class="absolute top-32 right-[10%] md:right-[18%] w-6 md:w-8 h-6 md:h-8 rounded-full bg-[#E0A6F2] opacity-40 animate-float-medium"></div>
        <div class="absolute bottom-20 left-[15%] md:left-[20%] w-4 md:w-5 h-4 md:h-5 rounded-full bg-[#FFD86B] opacity-50 animate-float-fast"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6">
            <div class="inline-flex items-center gap-2 px-4 md:px-5 py-2 rounded-md bg-white shadow-md border border-blue-100 mb-6 md:mb-8 join-anim join-delay-1">
                <span class="w-2 h-2 rounded-full bg-[#4C75F2]"></span>
                <p class="text-xs md:text-sm font-semibold text-[#3B4C7E] tracking-wide">KOLABORASI TERBUKA</p>
            </div>
            <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                <h2 class="text-3xl md:text-6xl font-black text-[#1A2E5A] leading-tight join-anim join-delay-2">
                    Punya Ide
                    <span class="relative inline-block mx-1">
                        <span class="absolute inset-0 bg-[#E8F19A] rotate-[-2deg] rounded-sm"></span>
                        <span class="relative px-2 md:px-3 py-1">Keren?</span>
                    </span>
                </h2>
                <h2 class="text-3xl md:text-6xl font-black text-[#1A2E5A] leading-tight join-anim join-delay-3">
                    Yuk Gabung
                    <span class="relative inline-block mx-1">
                        <span class="absolute inset-0 bg-[#B7C9FF] rotate-[2deg] rounded-sm"></span>
                        <span class="relative px-2 md:px-3 py-1">JTIFY!</span>
                    </span>
                </h2>
            </div>
            <p class="text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed text-sm md:text-lg join-anim join-delay-4">
                Jadilah bagian dari tim kreatif JTIFY untuk membantu mahasiswa menemukan peluang terbaik, mengembangkan skill, dan menciptakan komunitas yang inspiratif.
            </p>
            <a href="{{ route('collaborator.register') }}" class="group bg-[#3B4C7E] hover:bg-[#2D3A61] text-white px-8 md:px-10 py-3 md:py-4 rounded-full font-bold inline-flex items-center gap-3 shadow-[0_12px_30px_rgba(59,76,126,0.35)] hover:scale-105 active:scale-95 transition-all duration-300 join-anim join-delay-5">
                Yuk Gabung
                <svg class="w-4 md:w-5 h-4 md:h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- FEEDBACK SECTION -->
    <section class="py-24 overflow-hidden" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 mb-14">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <p class="uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#8FA9C0] mb-3">Feedback Mahasiswa</p>
                    <h3 class="text-2xl md:text-4xl font-extrabold text-[#1A2E5A] leading-tight">
                        Apa Kata Mereka
                        <span class="relative inline-block">
                            Tentang JTIFY?
                            <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                        </span>
                    </h3>
                </div>
                <!-- Tombol navigasi -->
                <div class="flex gap-3">
                    <button id="feedbackPrev"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full border border-gray-200 bg-white shadow-sm flex items-center justify-center hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button id="feedbackNext"
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#1A2E5A] text-white shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 overflow-hidden">
            <div id="feedbackSlider" class="flex transition-transform duration-700 ease-in-out" style="gap: 16px;">
                @if(isset($feedbacks) && $feedbacks->isNotEmpty())
                    @foreach($feedbacks as $fb)
                    <div class="flex-none w-[calc(100%-32px)] sm:w-[calc((100%-24px)/2)] lg:w-[calc((100%-48px)/3)]">
                        <div class="bg-white border border-gray-100 rounded-[28px] p-4 sm:p-6 lg:p-8 h-full shadow-[0_8px_30px_rgba(0,0,0,0.05)] hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-500">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-[#1A2E5A] to-[#5D8EFF] flex-shrink-0 flex items-center justify-center font-bold text-white text-base">
                                    {{ strtoupper(substr($fb->user?->name ?? 'M', 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-[#1A2E5A] text-xs sm:text-sm truncate">{{ $fb->user?->name ?? 'Mahasiswa JTIFY' }}</h4>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm leading-relaxed text-gray-500">
                                "{{ $fb->message }}"
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 6; $i++)
                    <div class="flex-none w-[calc(100%-32px)] sm:w-[calc((100%-24px)/2)] lg:w-[calc((100%-48px)/3)]">
                        <div class="bg-white border border-gray-100 rounded-[28px] p-4 sm:p-6 lg:p-8 h-full shadow-[0_8px_30px_rgba(0,0,0,0.05)] hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-500">
                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-[#1A2E5A] to-[#5D8EFF] flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-[#1A2E5A] text-xs sm:text-sm truncate">Mahasiswa JTIFY</h4>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm leading-relaxed text-gray-500">
                                "JTIFY membantu saya menemukan banyak informasi lomba, seminar, dan peluang pengembangan diri. Tampilannya modern dan nyaman digunakan."
                            </p>
                        </div>
                    </div>
                    @endfor
                @endif
            </div>
        </div>

    </section>

    @include('components.footer')

    <script>
        window.homeConfig = {
            routes: {
                lomba: "{{ route('lomba') }}",
                seminar: "{{ route('seminar') }}",
                beasiswa: "{{ route('beasiswa') }}",
                tips: "{{ route('tips') }}",
                home: "{{ route('home') }}",
                lombaDetail: "{{ route('lomba.detail') }}",
                seminarDetail: "{{ route('seminar.detail') }}",
                beasiswaDetail: "{{ route('beasiswa.detail') }}"
            }
        };
    </script>
    <script src="{{ asset('js/home-interaction.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once:     false,
            mirror:   true,
            easing:   'ease-out-cubic'
        });
    </script>

</body>
</html>