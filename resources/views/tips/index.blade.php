<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Tips & Insight</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Highlight underline effect — mengikuti lebar teks saja */
        .highlight-underline {
            position: relative;
            display: inline;
            white-space: nowrap;
        }

        .highlight-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 2px;
            width: 100%;
            height: 0.28em;
            background-color: #DDEBFF;
            z-index: -1;
            border-radius: 2px;
        }

        /* Card hover */
        .card-article {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .card-article:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
        }

        /* Thumbnail icon scale */
        .card-article:hover .thumb-icon {
            transform: scale(1.1);
        }

        .thumb-icon {
            transition: transform 0.4s ease;
        }

        /* Btn arrow slide */
        .card-article:hover .btn-arrow {
            background-color: #1A2E5A;
        }

        .card-article:hover .arrow-icon {
            transform: translateX(4px);
        }

        .btn-arrow {
            transition: background-color 0.3s ease;
        }

        .arrow-icon {
            transition: transform 0.3s ease;
        }

        /* Pagination active */
        .page-btn-active {
            background-color: #1A2E5A;
            color: #ffffff;
            font-weight: 700;
        }

        /* Pagination default */
        .page-btn {
            color: #1A2E5A;
            transition: background-color 0.2s ease;
        }

        .page-btn:hover {
            background-color: #f3f4f6;
        }

        /* Pagination arrow */
        .page-arrow {
            border: 1px solid #e5e7eb;
            color: #9ca3af;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .page-arrow:hover {
            background-color: #1A2E5A;
            color: #ffffff;
        }

        /* Grid: selalu 2 kolom di semua ukuran mobile, 3 di md, 4 di lg */
        .tips-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        @media (min-width: 768px) {
            .tips-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }

        @media (min-width: 1024px) {
            .tips-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }
    </style>
</head>

<body class="bg-white overflow-x-hidden">

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

        <div class="max-w-7xl mx-auto">

            {{-- SECTION HEADER --}}
            <div class="mb-10 md:mb-14">

                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Explore Articles
                </p>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Tips &
                    <span class="highlight-underline">Insight</span>
                </h2>

                <p class="mt-4 text-gray-500 text-sm sm:text-base max-w-2xl leading-relaxed">
                    Temukan berbagai artikel informatif mengenai lomba, beasiswa,
                    pengembangan diri, produktivitas, dan dunia akademik.
                </p>

            </div>

            {{-- DATA --}}
            @php
                $tipsData = [
                    [
                        'title'       => 'Cara Meningkatkan Peluang Lolos Seleksi Kompetisi',
                        'description' => 'Pelajari strategi yang dapat membantu kamu mempersiapkan diri dengan lebih baik dan meningkatkan peluang keberhasilan dalam kompetisi.',
                        'date'        => '12 Mei 2026',
                    ],
                    [
                        'title'       => 'Kesalahan Umum yang Sering Dilakukan Peserta Kompetisi',
                        'description' => 'Hindari berbagai kesalahan yang sering terjadi saat mengikuti kompetisi agar performamu lebih maksimal.',
                        'date'        => '10 Mei 2026',
                    ],
                    [
                        'title'       => 'Strategi Menyusun Tim yang Solid dan Efektif',
                        'description' => 'Bangun kerja sama tim yang baik untuk mencapai hasil terbaik dalam berbagai kegiatan maupun perlombaan.',
                        'date'        => '8 Mei 2026',
                    ],
                    [
                        'title'       => 'Tips Mengatur Waktu antara Kuliah dan Organisasi',
                        'description' => 'Kelola waktu dengan lebih efektif agar aktivitas akademik dan non-akademik tetap berjalan seimbang.',
                        'date'        => '5 Mei 2026',
                    ],
                    [
                        'title'       => 'Cara Membangun Portofolio yang Menarik',
                        'description' => 'Pelajari langkah-langkah membuat portofolio yang profesional dan mampu menarik perhatian recruiter.',
                        'date'        => '3 Mei 2026',
                    ],
                    [
                        'title'       => 'Meningkatkan Kemampuan Public Speaking Mahasiswa',
                        'description' => 'Latihan sederhana yang dapat membantu meningkatkan rasa percaya diri saat berbicara di depan umum.',
                        'date'        => '1 Mei 2026',
                    ],
                    [
                        'title'       => 'Tips Menulis CV yang ATS Friendly',
                        'description' => 'Pelajari cara membuat CV yang mudah dibaca sistem ATS dan menarik perhatian recruiter.',
                        'date'        => '28 Apr 2026',
                    ],
                    [
                        'title'       => 'Rahasia Produktif Saat Deadline Menumpuk',
                        'description' => 'Teknik sederhana yang dapat membantu kamu tetap fokus dan menyelesaikan pekerjaan tepat waktu.',
                        'date'        => '25 Apr 2026',
                    ],
                ];
            @endphp

            {{-- ===========================
                 ARTICLE GRID
                 Responsive: 1col (xs) → 2col (sm) → 3col (md) → 4col (lg)
            ============================ --}}
            <div class="tips-grid grid gap-3 sm:gap-4 md:gap-6">

                @foreach ($tipsData as $index => $item)

                <a
                    href="#"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 70 }}"
                    class="card-article group flex flex-col bg-white rounded-2xl overflow-hidden
                           border border-[#E7EEF6]
                           shadow-[0_8px_30px_rgba(0,0,0,0.05)]"
                >

                    {{-- THUMBNAIL --}}
                    <div class="bg-gradient-to-br from-[#EAF2F8] via-[#DFEBF5] to-[#D5E6F2] overflow-hidden">
                        <div class="aspect-video flex items-center justify-center">
                            <svg
                                class="thumb-icon w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 text-[#7CA5C7]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/>
                                <circle cx="8.5" cy="8.5" r="1.5" stroke-width="1.5"/>
                                <path stroke-width="1.5" d="M21 15l-5-5L5 21"/>
                            </svg>
                        </div>
                    </div>

                    {{-- CARD BODY --}}
                    <div class="flex flex-col flex-1 p-3 sm:p-4">

                        {{-- Date --}}
                        <span class="text-[10px] sm:text-xs text-[#8FA9C0] font-semibold uppercase tracking-wider">
                            {{ $item['date'] }}
                        </span>

                        {{-- Title --}}
                        <h3 class="mt-2 text-[#1A2E5A] text-xs sm:text-sm md:text-[15px] font-bold leading-snug line-clamp-2">
                            {{ $item['title'] }}
                        </h3>

                        {{-- Description --}}
                        <p class="mt-2 text-gray-500 text-[11px] sm:text-xs md:text-sm leading-relaxed line-clamp-3 flex-1">
                            {{ $item['description'] }}
                        </p>

                        {{-- CTA Button --}}
                        <div class="mt-4">
                            <span class="btn-arrow flex items-center justify-center gap-2
                                         w-full bg-[#2F6FED] text-white
                                         text-[11px] sm:text-xs md:text-sm font-bold
                                         py-2.5 sm:py-3 rounded-xl">
                                Lihat Detail
                                <svg
                                    class="arrow-icon w-3.5 h-3.5 sm:w-4 sm:h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2.5"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </span>
                        </div>

                    </div>

                </a>

                @endforeach

            </div>

            {{-- ===========================
                 PAGINATION
            ============================ --}}
            <nav class="mt-16 sm:mt-20 flex items-center justify-center gap-1.5 sm:gap-2"
                 aria-label="Navigasi halaman">

                {{-- Prev --}}
                <button
                    class="page-arrow w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center"
                    aria-label="Halaman sebelumnya"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                {{-- Page 1 (active) --}}
                <button class="page-btn-active w-9 h-9 sm:w-10 sm:h-10 rounded-full text-sm" aria-current="page">
                    1
                </button>

                {{-- Page 2 --}}
                <button class="page-btn w-9 h-9 sm:w-10 sm:h-10 rounded-full text-sm">
                    2
                </button>

                {{-- Page 3 --}}
                <button class="page-btn w-9 h-9 sm:w-10 sm:h-10 rounded-full text-sm">
                    3
                </button>

                <span class="text-gray-400 text-sm select-none px-1">…</span>

                {{-- Page 10 --}}
                <button class="page-btn w-9 h-9 sm:w-10 sm:h-10 rounded-full text-sm">
                    10
                </button>

                {{-- Next --}}
                <button
                    class="page-arrow w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center"
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