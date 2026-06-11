<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name'] ?? 'JTIFY' }} - Homepage</title>
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
                    style="font-size: clamp(4rem, 7vw, 6rem);">{{ $pageContents['home']['hero_brand'] ?? ($siteSettings['logo_text'] ?? 'JTIFY') }}</h1>
            </div>

            <!-- Subtitle -->
            <div class="mb-14">
                <h2 class="anim-line1 font-extrabold text-[#1A2E5A] leading-snug"
                    style="font-size: clamp(1.5rem, 3vw, 2.2rem);">
                    @php
                        $line1 = $pageContents['home']['hero_title_line_1'] ?? 'Temukan Peluang,';
                        $highlight1 = $pageContents['home']['hero_highlight_1'] ?? 'Peluang,';
                        $parts1 = explode($highlight1, $line1);
                    @endphp
                    {!! count($parts1) > 1 ? e($parts1[0]) . '<span class="bg-[#4C75F2] text-white px-2 py-0.5 rounded-sm">' . e($highlight1) . '</span>' . e($parts1[1]) : e($line1) !!}
                </h2>
                <h2 class="anim-line2 font-extrabold text-[#1A2E5A] leading-snug"
                    style="font-size: clamp(1.5rem, 3vw, 2.2rem);">
                    @php
                        $line2 = $pageContents['home']['hero_title_line_2'] ?? 'Tingkatkan Kompetensi';
                        $highlight2 = $pageContents['home']['hero_highlight_2'] ?? 'Kompetensi';
                        $parts2 = explode($highlight2, $line2);
                    @endphp
                    {!! count($parts2) > 1 ? e($parts2[0]) . '<span class="bg-[#E0A6F2] text-[#1A2E5A] px-2 py-0.5 rounded-sm">' . e($highlight2) . '</span>' . e($parts2[1]) : e($line2) !!}
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
                                    <option value="">{{ $pageContents['home']['category_default'] ?? 'Kategori' }}</option>
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
                                <input type="text" name="q" placeholder="{{ $pageContents['home']['search_placeholder'] ?? 'Cari informasi' }}"
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
                        @php
                            $tabs = json_decode($pageContents['home']['section_tabs'] ?? '[]', true);
                            if (empty($tabs)) {
                                $tabs = ['Popular', 'Lomba', 'Seminar', 'Beasiswa'];
                            }
                            $tabCategories = ['popular', 'lomba', 'seminar', 'beasiswa'];
                        @endphp
                        @foreach($tabs as $idx => $tabName)
                            @if(isset($tabCategories[$idx]))
                                <button data-tab="{{ $idx }}" data-category="{{ $tabCategories[$idx] }}"
                                    class="tab-link pb-4 {{ $idx === 0 ? 'text-[#1A2E5A] font-bold' : 'text-gray-400 hover:text-[#3B4C7E] font-medium' }} text-sm md:text-base flex-1 text-center transition whitespace-nowrap capitalize">{{ $tabName }}</button>
                            @endif
                        @endforeach
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
                    {{-- Cards dirender oleh home-interaction.js via AJAX --}}
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

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 overflow-x-hidden overflow-y-visible pb-10 pt-4">
            <div id="feedbackSlider" class="flex transition-transform duration-700 ease-in-out py-3" style="gap: 16px;">
                {{-- Feedback cards dirender oleh home-interaction.js via AJAX --}}
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