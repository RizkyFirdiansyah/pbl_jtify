<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Tips & Insight</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-white overflow-x-hidden font-sans">

    {{-- ===========================
         NAVBAR
    ============================ --}}
    @include('components.navbar')

    {{-- ===========================
         HEADER
    ============================ --}}
    @include('components.header-konten', [
        'title'      => 'TIPS',
        'subtitle1'  => 'Temukan',
        'highlight1' => 'Wawasan,',
        'subtitle2'  => 'Tingkatkan',
        'highlight2' => 'Potensimu',
    ])

    {{-- ===========================
         CONTENT SECTION
    ============================ --}}
    <section class="relative z-10 pt-16 pb-24 px-4 sm:px-6 md:px-8 lg:px-10">

        <div class="max-w-7xl mx-auto">            {{-- SECTION HEADER --}}
            <div class="mb-10 md:mb-14">

                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Explore Articles
                </p>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Tips &
                    <span class="relative inline whitespace-nowrap z-10">
                        Insight
                        <span class="absolute left-0 bottom-0.5 w-full h-[0.28em] bg-[#DDEBFF] -z-10 rounded-[2px]"></span>
                    </span>
                </h2>

                <p class="mt-4 text-gray-500 text-sm sm:text-base max-w-2xl leading-relaxed">
                    Temukan berbagai artikel informatif mengenai lomba, beasiswa,
                    pengembangan diri, produktivitas, dan dunia akademik.
                </p>

                @if(!empty($q))
                <div class="mt-4 flex items-center gap-3 flex-wrap">
                    <p class="text-sm text-gray-500">
                        Hasil pencarian untuk: <strong class="text-[#1A2E5A]">&ldquo;{{ $q }}&rdquo;</strong>
                    </p>
                    <a href="{{ route('tips') }}"
                       class="inline-flex items-center gap-1.5 bg-[#EEF1FF] text-[#3B4C7E] text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-[#D8DCFF] transition-colors">
                        Hapus filter
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                </div>
                @endif

            </div>

            {{-- DATA --}}
            @php
                $tipsData = [
                    [
                        'slug'        => 'tips-1',
                        'title'       => 'Cara Meningkatkan Peluang Lolos Seleksi Kompetisi',
                        'description' => 'Pelajari strategi yang dapat membantu kamu mempersiapkan diri dengan lebih baik dan meningkatkan peluang keberhasilan dalam kompetisi.',
                        'date'        => '12 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-2',
                        'title'       => 'Kesalahan Umum yang Sering Dilakukan Peserta Kompetisi',
                        'description' => 'Hindari berbagai kesalahan yang sering terjadi saat mengikuti kompetisi agar performamu lebih maksimal.',
                        'date'        => '10 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-3',
                        'title'       => 'Strategi Menyusun Tim yang Solid dan Efektif',
                        'description' => 'Bangun kerja sama tim yang baik untuk mencapai hasil terbaik dalam berbagai kegiatan maupun perlombaan.',
                        'date'        => '8 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-4',
                        'title'       => 'Tips Mengatur Waktu antara Kuliah dan Organisasi',
                        'description' => 'Kelola waktu dengan lebih efektif agar aktivitas akademik dan non-akademik tetap berjalan seimbang.',
                        'date'        => '5 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-5',
                        'title'       => 'Cara Membangun Portofolio yang Menarik',
                        'description' => 'Pelajari langkah-langkah membuat portofolio yang profesional dan mampu menarik perhatian recruiter.',
                        'date'        => '3 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-6',
                        'title'       => 'Meningkatkan Kemampuan Public Speaking Mahasiswa',
                        'description' => 'Latihan sederhana yang dapat membantu meningkatkan rasa percaya diri saat berbicara di depan umum.',
                        'date'        => '1 Mei 2026',
                    ],
                    [
                        'slug'        => 'tips-7',
                        'title'       => 'Tips Menulis CV yang ATS Friendly',
                        'description' => 'Pelajari cara membuat CV yang mudah dibaca sistem ATS dan menarik perhatian recruiter.',
                        'date'        => '28 Apr 2026',
                    ],
                    [
                        'slug'        => 'tips-8',
                        'title'       => 'Rahasia Produktif Saat Deadline Menumpuk',
                        'description' => 'Teknik sederhana yang dapat membantu kamu tetap fokus dan menyelesaikan pekerjaan tepat waktu.',
                        'date'        => '25 Apr 2026',
                    ],
                ];

                // Filter berdasarkan query jika ada
                if (!empty($q)) {
                    $tipsData = array_filter($tipsData, function($item) use ($q) {
                        return stripos($item['title'], $q) !== false || stripos($item['description'], $q) !== false;
                    });
                }
            @endphp

            {{-- ===========================
                 ARTICLE GRID
                 Responsive: 1col (xs) → 2col (sm) → 3col (md) → 4col (lg)
            ============================ --}}
            @if(count($tipsData) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 md:gap-6">

                @foreach ($tipsData as $index => $item)

                <a
                    href="{{ route('tips.detail', ['slug' => $item['slug']]) }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 70 }}"
                    class="group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                    style="aspect-ratio: 2/3;"
                >

                    {{-- Poster Placeholder --}}
                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                        <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                        </svg>
                    </div>

                    {{-- Content Overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 z-10 p-4"
                         style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">

                        <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                            {{ $item['title'] }}
                        </h3>

                        <div class="flex items-center gap-1.5 mb-3">
                            <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-white/70 text-[11px]">{{ $item['date'] }}</span>
                        </div>

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
            @else
            {{-- EMPTY STATE --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <svg class="w-32 h-32 mb-6 text-[#D0DCEE]" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="90" fill="#EEF1FF"/>
                    <circle cx="88" cy="88" r="40" stroke="#B8CAEE" stroke-width="8"/>
                    <path d="M118 118 L150 150" stroke="#B8CAEE" stroke-width="8" stroke-linecap="round"/>
                    <path d="M74 88 Q88 75 102 88" stroke="#8FA9C0" stroke-width="4" stroke-linecap="round" fill="none"/>
                    <circle cx="78" cy="82" r="4" fill="#8FA9C0"/>
                    <circle cx="98" cy="82" r="4" fill="#8FA9C0"/>
                </svg>
                <h2 class="text-2xl font-bold text-[#1A2E5A] mb-3">Tidak Ditemukan</h2>
                <p class="text-gray-400 text-sm max-w-sm leading-relaxed mb-8">
                    Tidak ada tips yang cocok dengan <strong>&ldquo;{{ $q }}&rdquo;</strong>. Coba kata kunci lain.
                </p>
                <a href="{{ route('tips') }}"
                   class="bg-[#3B4C7E] hover:bg-[#2D3A61] text-white px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 hover:scale-105 shadow-[0_4px_15px_rgba(59,76,126,0.35)]">
                    Lihat Semua Tips
                </a>
            </div>
            @endif

            {{-- ===========================
                 PAGINATION
            ============================ --}}
            <nav class="mt-16 sm:mt-20 flex items-center justify-center gap-1.5 sm:gap-2"
                 aria-label="Navigasi halaman">

                {{-- Prev --}}
                <button
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300"
                    aria-label="Halaman sebelumnya"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                {{-- Page 1 (active) --}}
                <button class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#1A2E5A] text-white text-sm font-bold shadow-lg" aria-current="page">
                    1
                </button>

                {{-- Page 2 --}}
                <button class="w-9 h-9 sm:w-10 sm:h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    2
                </button>

                {{-- Page 3 --}}
                <button class="w-9 h-9 sm:w-10 sm:h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    3
                </button>

                <span class="text-gray-400 text-sm select-none px-1">…</span>

                {{-- Page 10 --}}
                <button class="w-9 h-9 sm:w-10 sm:h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    10
                </button>

                {{-- Next --}}
                <button
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300"
                    aria-label="Halaman berikutnya"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

            </nav>

        </div>

    </section>

    {{-- ===========================
         FOOTER GRADIENT TRANSITION
    ============================ --}}
    <div class="h-32 sm:h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></div>

    {{-- ===========================
         FOOTER
    ============================ --}}
    @include('components.footer')

    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 900,
            once: false,
            mirror: true,
            easing: 'ease-out-cubic',
        });
    </script>

</body>
</html>