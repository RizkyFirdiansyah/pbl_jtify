<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }

        @keyframes popIn {
            0%   { opacity: 0; transform: scale(0.3) translateY(40px); }
            60%  { opacity: 1; transform: scale(1.15) translateY(-10px); }
            80%  { transform: scale(0.95) translateY(5px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes popInLeft {
            0%   { opacity: 0; transform: scale(0.5) translateX(-60px); }
            60%  { opacity: 1; transform: scale(1.1) translateX(8px); }
            80%  { transform: scale(0.97) translateX(-4px); }
            100% { opacity: 1; transform: scale(1) translateX(0); }
        }
        @keyframes popInRight {
            0%   { opacity: 0; transform: scale(0.5) translateX(60px); }
            60%  { opacity: 1; transform: scale(1.1) translateX(-8px); }
            80%  { transform: scale(0.97) translateX(4px); }
            100% { opacity: 1; transform: scale(1) translateX(0); }
        }
        @keyframes fadeUp {
            0%   { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-16px); }
        }
        @keyframes floatMedium {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        @keyframes floatFast {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }
        @keyframes popReveal {
            0%   { opacity: 0; transform: scale(0.7) translateY(50px); }
            60%  { opacity: 1; transform: scale(1.05) translateY(-8px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        .anim-jtify  { opacity: 0; animation: popIn 0.9s cubic-bezier(0.34,1.56,0.64,1) 0.2s forwards, floatSlow 6s ease-in-out 1.5s infinite; }
        .anim-line1  { opacity: 0; animation: popInLeft 0.8s cubic-bezier(0.34,1.56,0.64,1) 0.7s forwards, floatMedium 5s ease-in-out 1.8s infinite; }
        .anim-line2  { opacity: 0; animation: popInRight 0.8s cubic-bezier(0.34,1.56,0.64,1) 1s forwards, floatMedium 5s ease-in-out 2s infinite; }
        .anim-search { opacity: 0; animation: fadeUp 0.8s ease-out 1.3s forwards; }

        .animate-float-slow   { animation: floatSlow   6s ease-in-out infinite; }
        .animate-float-medium { animation: floatMedium 5s ease-in-out infinite; }
        .animate-float-fast   { animation: floatFast   4s ease-in-out infinite; }

        .join-anim { opacity: 0; }
        #joinSection.show .join-anim { animation: popReveal 0.9s cubic-bezier(0.34,1.56,0.64,1) forwards; }
        .join-delay-1 { animation-delay: 0.1s !important; }
        .join-delay-2 { animation-delay: 0.3s !important; }
        .join-delay-3 { animation-delay: 0.5s !important; }
        .join-delay-4 { animation-delay: 0.7s !important; }
        .join-delay-5 { animation-delay: 0.9s !important; }

        #tabsWrapper::-webkit-scrollbar { display: none; }

        /* Feedback card widths */
        .feedback-card { width: calc((100% - 48px) / 3); }
        @media (max-width: 1024px) { .feedback-card { width: calc((100% - 24px) / 2); } }
        @media (max-width: 640px)  { .feedback-card { width: calc(100% - 32px); } }
    </style>
</head>
<body class="bg-white overflow-x-hidden">

    @include('components.navbar')

    <!-- HEADER -->
    <header class="relative w-full min-h-[700px] bg-no-repeat bg-cover bg-center flex flex-col pt-24 overflow-hidden"
            style="background-image: url('{{ asset('assets/homepage.svg') }}');">

        <div class="flex-1 flex flex-col items-center justify-center relative z-10 px-4 text-center">

            <!-- JTIFY -->
            <div class="relative inline-block mb-4 anim-jtify">
                <div class="absolute inset-0 bg-[#E8F19A] rounded-md"></div>
                <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none px-4 py-2 tracking-wider drop-shadow-xl"
                    style="font-size: clamp(4rem, 7vw, 6rem);">JTIFY</h1>
            </div>

            <!-- Subtitle -->
            <div class="mb-8">
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
                    <form id="searchForm">
                        <div class="bg-white/95 backdrop-blur-md rounded-full flex items-center shadow-[0_15px_35px_rgba(0,0,0,0.18)] border border-white/50 transition-all duration-500"
                            style="height: 60px; padding: 0 6px;">
                            
                            <!-- Kategori: hidden di mobile -->
                            <div class="hidden sm:flex items-center px-4 border-r border-gray-200 shrink-0">
                                <select id="categorySelect" class="bg-transparent text-sm text-gray-600 outline-none cursor-pointer font-medium">
                                    <option value="">Kategori</option>
                                    <option value="{{ route('lomba') }}">Lomba</option>
                                    <option value="{{ route('seminar') }}">Seminar</option>
                                    <option value="{{ route('beasiswa') }}">Beasiswa</option>
                                    <option value="{{ route('recruitment') }}">Recruitment</option>
                                </select>
                            </div>

                            <!-- Input -->
                            <div class="flex-1 flex items-center px-4 min-w-0">
                                <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <input type="text" placeholder="Cari informasi"
                                    class="w-full bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400 min-w-0">
                            </div>

                            <!-- Button -->
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
    <section class="mt-20 px-4 md:px-10 w-full overflow-hidden">
        <div class="max-w-7xl mx-auto overflow-hidden">

            <!-- Tabs -->
            <div class="relative mb-10">
                <div id="tabsWrapper" class="border-b border-gray-100 overflow-x-auto"
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
                <a href="/" id="lihatSemua" class="text-sm text-gray-400 font-bold flex items-center gap-1 hover:text-[#3B4C7E] transition">
                    Lihat semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="overflow-hidden">
                <div id="cardsSlider" class="flex transition-transform duration-700 ease-in-out cursor-grab active:cursor-grabbing select-none" style="gap: 16px;">
                    @for($i = 0; $i < 8; $i++)
                    <div class="card-item flex-none">
                        <div class="bg-[#E5E7EB] rounded-3xl flex items-center justify-center shadow-sm hover:shadow-md transition cursor-pointer" style="aspect-ratio: 2/3;">
                            <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
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
            <button class="group bg-[#3B4C7E] hover:bg-[#2D3A61] text-white px-8 md:px-10 py-3 md:py-4 rounded-full font-bold inline-flex items-center gap-3 shadow-[0_12px_30px_rgba(59,76,126,0.35)] hover:scale-105 active:scale-95 transition-all duration-300 join-anim join-delay-5">
                Yuk Gabung
                <svg class="w-4 md:w-5 h-4 md:h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
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
                @for($i = 0; $i < 6; $i++)
                <div class="feedback-card flex-none">
                    <div class="bg-white border border-gray-100 rounded-[28px] p-4 sm:p-6 lg:p-8 h-full shadow-[0_8px_30px_rgba(0,0,0,0.05)] hover:shadow-[0_15px_40px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-500">
                        <div class="flex items-start gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-[#1A2E5A] to-[#5D8EFF] flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-[#1A2E5A] text-xs sm:text-sm truncate">Mahasiswa JTIFY</h4>
                                <p class="text-[10px] sm:text-xs text-gray-400 mt-1 truncate">Teknologi Informasi • Polinema</p>
                            </div>
                            <div class="bg-[#F4F7FF] text-[#1A2E5A] text-[10px] sm:text-xs font-bold px-2 sm:px-3 py-1 rounded-full flex-shrink-0">⭐ 4.9</div>
                        </div>
                        <p class="text-xs sm:text-sm leading-relaxed text-gray-500">
                            "JTIFY membantu saya menemukan banyak informasi lomba, seminar, dan peluang pengembangan diri. Tampilannya modern dan nyaman digunakan."
                        </p>
                    </div>
                </div>
                @endfor
            </div>
        </div>

    </section>

    @include('components.footer')

    <script>
        // ================================
        // SEARCH FORM
        // ================================
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const val = document.getElementById('categorySelect').value;
            if (val) window.location.href = val;
        });

        // ================================
        // CATEGORY TABS & CARDS
        // ================================
        const categoryRoutes = {
            popular:  '/',
            lomba:    '{{ route("lomba") }}',
            seminar:  '{{ route("seminar") }}',
            beasiswa: '{{ route("beasiswa") }}'
        };

        const totalCards   = 8;
        let currentCard    = 0;
        let activeCategory = 'popular';

        const tabs       = document.querySelectorAll('.tab-link');
        const indicator  = document.getElementById('tabIndicator');
        const tabsWrapper = document.getElementById('tabsWrapper');
        const lihatSemua = document.getElementById('lihatSemua');
        const slider     = document.getElementById('cardsSlider');
        const dots       = document.querySelectorAll('.dot');

        function updateIndicator(tab) {
            indicator.style.width = tab.offsetWidth + 'px';
            indicator.style.left  = tab.offsetLeft + 'px';
        }

        function updateCardWidth() {
            const visible = getVisibleCards();
            const w = (slider.parentElement.offsetWidth - 16 * (visible - 1)) / visible;
            document.querySelectorAll('.card-item').forEach(c => c.style.width = w + 'px');
        }

        function getVisibleCards() {
            if (window.innerWidth <= 480)  return 2;
            if (window.innerWidth <= 768)  return 2;
            if (window.innerWidth <= 1024) return 3;
            return 4;
        }

        function goToCard(index) {
            const visible = getVisibleCards();
            const max = totalCards - visible;
            if (index > max) index = 0;
            if (index < 0)   index = 0;
            currentCard = index;

            updateCardWidth();
            const cardWidth = slider.querySelector('.card-item').offsetWidth + 16;
            slider.style.transform = `translateX(-${currentCard * cardWidth}px)`;

            const activeDot = currentCard < totalCards / 2 ? 0 : 1;
            dots.forEach((dot, i) => {
                if (i === activeDot) {
                    dot.classList.remove('w-2', 'bg-gray-200');
                    dot.classList.add('w-8', 'bg-[#1A2E5A]');
                } else {
                    dot.classList.remove('w-8', 'bg-[#1A2E5A]');
                    dot.classList.add('w-2', 'bg-gray-200');
                }
            });
        }

        function startAutoSlide() {
            return setInterval(() => {
                const visible = getVisibleCards();
                let next = currentCard + 1;
                if (next > totalCards - visible) next = 0;
                goToCard(next);
            }, 2500);
        }

        // Init
        updateCardWidth();
        lihatSemua.href = categoryRoutes['popular'];
        let autoSlide = startAutoSlide();

        window.addEventListener('load', () => {
            setTimeout(() => {
                updateIndicator(tabs[0]);
                goToCard(0);
            }, 100);
        });

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                activeCategory = this.dataset.category;

                tabs.forEach(t => {
                    t.classList.remove('text-[#1A2E5A]', 'font-bold');
                    t.classList.add('text-gray-400', 'font-medium');
                });
                this.classList.remove('text-gray-400', 'font-medium');
                this.classList.add('text-[#1A2E5A]', 'font-bold');

                updateIndicator(this);

                // Scroll tab ke tengah di mobile
                const tabCenter     = this.offsetLeft + this.offsetWidth / 2;
                const wrapperCenter = tabsWrapper.offsetWidth / 2;
                tabsWrapper.scrollLeft = tabCenter - wrapperCenter;

                // Update lihat semua
                lihatSemua.href = categoryRoutes[activeCategory] || '/';

                clearInterval(autoSlide);
                goToCard(0);
                autoSlide = startAutoSlide();
            });
        });

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(autoSlide);
                goToCard(i === 0 ? 0 : Math.floor(totalCards / 2));
                autoSlide = startAutoSlide();
            });
        });

        window.addEventListener('resize', () => {
            clearInterval(autoSlide);
            updateCardWidth();
            updateIndicator(document.querySelector('.tab-link.font-bold') || tabs[0]);
            goToCard(0);
            autoSlide = startAutoSlide();
        });

        // ================================
        // DRAG / SWIPE CARDS
        // ================================
        let isDragging   = false;
        let startX       = 0;
        let dragDistance = 0;

        // Mouse drag (desktop)
        slider.addEventListener('mousedown', (e) => {
            isDragging   = true;
            startX       = e.clientX;
            dragDistance = 0;
            slider.style.transition = 'none';
            clearInterval(autoSlide);
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            dragDistance = e.clientX - startX;
            const cardWidth  = slider.querySelector('.card-item').offsetWidth + 16;
            const baseOffset = currentCard * cardWidth;
            slider.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
        });

        document.addEventListener('mouseup', () => {
            if (!isDragging) return;
            isDragging = false;
            slider.style.transition = 'transform 700ms ease-in-out';
            if (dragDistance < -60)      goToCard(currentCard + 1);
            else if (dragDistance > 60)  goToCard(currentCard - 1);
            else                         goToCard(currentCard);
            autoSlide = startAutoSlide();
        });

        // Touch swipe (mobile)
        slider.addEventListener('touchstart', (e) => {
            startX       = e.touches[0].clientX;
            dragDistance = 0;
            slider.style.transition = 'none';
            clearInterval(autoSlide);
        }, { passive: true });

        slider.addEventListener('touchmove', (e) => {
            dragDistance = e.touches[0].clientX - startX;
            const cardWidth  = slider.querySelector('.card-item').offsetWidth + 16;
            const baseOffset = currentCard * cardWidth;
            slider.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
        }, { passive: true });

        slider.addEventListener('touchend', () => {
            slider.style.transition = 'transform 700ms ease-in-out';
            if (dragDistance < -60)      goToCard(currentCard + 1);
            else if (dragDistance > 60)  goToCard(currentCard - 1);
            else                         goToCard(currentCard);
            autoSlide = startAutoSlide();
        });

        // ================================
        // JOIN SECTION SCROLL ANIMATION
        // ================================
        const joinSection = document.getElementById('joinSection');
        window.addEventListener('scroll', () => {
            const top = joinSection.getBoundingClientRect().top;
            if (top < window.innerHeight * 0.8) {
                joinSection.classList.add('show');
                joinSection.classList.remove('opacity-0', 'translate-y-16');
            } else {
                joinSection.classList.remove('show');
                joinSection.classList.add('opacity-0', 'translate-y-16');
            }
        });

        // ================================
        // FEEDBACK SLIDER
        // ================================
        const feedbackSlider = document.getElementById('feedbackSlider');
        const feedbackCards  = document.querySelectorAll('.feedback-card');
        const feedbackNext   = document.getElementById('feedbackNext');
        const feedbackPrev   = document.getElementById('feedbackPrev');
        let feedbackIndex    = 0;

        function visibleFeedback() {
            if (window.innerWidth <= 640)  return 1;
            if (window.innerWidth <= 1024) return 2;
            return 3;
        }

        function updateFeedbackSlider() {
            const cardWidth = feedbackCards[0].offsetWidth + 16;
            feedbackSlider.style.transform = `translateX(-${feedbackIndex * cardWidth}px)`;
        }

        function nextFeedback() {
            const max = feedbackCards.length - visibleFeedback();
            feedbackIndex = feedbackIndex >= max ? 0 : feedbackIndex + 1;
            updateFeedbackSlider();
        }

        function prevFeedback() {
            const max = feedbackCards.length - visibleFeedback();
            feedbackIndex = feedbackIndex <= 0 ? max : feedbackIndex - 1;
            updateFeedbackSlider();
        }

        feedbackNext.addEventListener('click', nextFeedback);
        feedbackPrev.addEventListener('click', prevFeedback);

        let feedbackAuto = setInterval(nextFeedback, 3000);
        feedbackSlider.addEventListener('mouseenter', () => clearInterval(feedbackAuto));
        feedbackSlider.addEventListener('mouseleave', () => { feedbackAuto = setInterval(nextFeedback, 3000); });

        window.addEventListener('resize', () => { feedbackIndex = 0; updateFeedbackSlider(); });
    </script>

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