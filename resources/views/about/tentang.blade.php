<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name'] ?? 'JTIFY' }} - Tentang Kami</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-white overflow-x-hidden font-sans">

    @include('components.navbar')
    @include('components.header-detail', [
        'label'      => 'Mengenal Lebih Dekat',
        'titleWords' => ['TENTANG KAMI'],
        'subtitle1'  => 'Hubungkan',
        'highlight1' => 'Inspirasi,',
        'subtitle2'  => 'Wujudkan',
        'highlight2' => 'Ambisi',
    ])


    {{-- ================================
         IDENTITAS SECTION (Jarak pt-20 diturunkan ke pt-8 agar lebih naik)
    ================================= --}}
    <section class="pt-8 pb-10 px-4 md:px-10">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <p class="uppercase tracking-[0.3em] text-xs font-bold text-[#8FA9C0] mb-4">
                {{ $pageContents['tentang-kami']['intro_label'] ?? 'Siapa Kami' }}
            </p>
            <h2 class="text-3xl md:text-5xl font-black text-[#1A2E5A] leading-tight mb-6">
                {{ $pageContents['tentang-kami']['intro_title'] ?? 'Kenalan dengan' }}
                <span class="relative inline-block mx-1">
                    <span class="absolute inset-0 bg-[#E8F19A] rotate-[-2deg] rounded-sm"></span>
                    <span class="relative px-3">{{ $pageContents['tentang-kami']['intro_brand'] ?? ($siteSettings['logo_text'] ?? 'JTIFY') }}</span>
                </span>
            </h2>
            <p class="text-gray-500 text-base md:text-lg leading-relaxed">
                {!! str_replace('Jurusan Teknologi Informasi Politeknik Negeri Malang', '<strong class="text-[#1A2E5A]">Jurusan Teknologi Informasi Politeknik Negeri Malang</strong>', e($pageContents['tentang-kami']['intro_description'] ?? 'JTIFY adalah platform informasi mahasiswa Jurusan Teknologi Informasi Politeknik Negeri Malang yang hadir untuk mempermudah akses terhadap berbagai peluang akademik dan pengembangan diri semuanya dalam satu tempat.')) !!}
            </p>
        </div>
    </section>


    {{-- ================================
         ZIGZAG STICKY NOTE SECTION
    ================================= --}}
    <section class="relative py-10 px-4 md:px-10 overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">

                {{-- NOTE 1 --}}
                <div data-aos="fade-right">
                    <div class="relative">
                        <div class="absolute -top-4 left-8 z-20" style="animation: pinWobble 3s ease-in-out infinite;">
                            <div class="w-7 h-7 rounded-full bg-[#4C75F2] shadow-lg border-2 border-white flex items-center justify-center">
                                <span class="text-white text-[10px] font-black">01</span>
                            </div>
                        </div>
                        <div class="rotate-[-2deg] hover:rotate-0 hover:scale-[1.03] transition-all duration-500 bg-[#FFFDE7] rounded-2xl p-7 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-yellow-100 h-full">
                            <p class="text-[10px] font-bold text-yellow-500 uppercase tracking-widest mb-2">{{ $pageContents['tentang-kami']['background_label'] ?? 'Latar Belakang' }}</p>
                            <h3 class="text-xl font-black text-[#1A2E5A] mb-3">{{ $pageContents['tentang-kami']['background_title'] ?? 'Kenapa JTIFY Dibuat?' }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">
                                {!! str_replace('ketinggalan atau kesulitan menemukannya', '<strong class="text-[#1A2E5A]">ketinggalan atau kesulitan menemukannya</strong>', e($pageContents['tentang-kami']['background_description'] ?? 'Informasi lomba, beasiswa, dan seminar selama ini tersebar di berbagai platform Instagram, grup WhatsApp, website kampus. Mahasiswa sering ketinggalan atau kesulitan menemukannya tepat waktu.')) !!}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- NOTE 2 --}}
                <div data-aos="fade-left" data-aos-delay="100">
                    <div class="relative">
                        <div class="absolute -top-4 right-8 z-20" style="animation: pinWobbleR 3.5s ease-in-out infinite;">
                            <div class="w-7 h-7 rounded-full bg-[#E0A6F2] shadow-lg border-2 border-white flex items-center justify-center">
                                <span class="text-white text-[10px] font-black">02</span>
                            </div>
                        </div>
                        <div class="rotate-[2deg] hover:rotate-0 hover:scale-[1.03] transition-all duration-500 bg-[#F0F4FF] rounded-2xl p-7 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-blue-100 h-full">
                            <p class="text-[10px] font-bold text-[#4C75F2] uppercase tracking-widest mb-2">{{ $pageContents['tentang-kami']['solution_label'] ?? 'Solusi' }}</p>
                            <h3 class="text-xl font-black text-[#1A2E5A] mb-3">{{ $pageContents['tentang-kami']['solution_title'] ?? 'Satu Pintu, Semua Peluang' }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">
                                {!! str_replace('satu platform terpusat', '<strong class="text-[#1A2E5A]">satu platform terpusat</strong>', e($pageContents['tentang-kami']['solution_description'] ?? 'JTIFY hadir sebagai satu platform terpusat untuk semua informasi itu. Kami percaya setiap mahasiswa berhak mendapat akses yang sama terhadap peluang terbaik, tanpa harus repot mencarinya satu per satu.')) !!}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- NOTE 3 --}}
                <div data-aos="fade-right" data-aos-delay="100">
                    <div class="relative">
                        <div class="absolute -top-4 left-8 z-20" style="animation: pinWobble 4s ease-in-out infinite;">
                            <div class="w-7 h-7 rounded-full bg-[#4ade80] shadow-lg border-2 border-white flex items-center justify-center">
                                <span class="text-white text-[10px] font-black">03</span>
                            </div>
                        </div>
                        <div class="rotate-[-2deg] hover:rotate-0 hover:scale-[1.03] transition-all duration-500 bg-[#F0FDF4] rounded-2xl p-7 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-green-100 h-full">
                            <p class="text-[10px] font-bold text-green-500 uppercase tracking-widest mb-2">{{ $pageContents['tentang-kami']['vision_label'] ?? 'Visi' }}</p>
                            <h3 class="text-xl font-black text-[#1A2E5A] mb-3">{{ $pageContents['tentang-kami']['vision_title'] ?? 'Menjadi Ruang Tumbuh Mahasiswa' }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">
                                {!! str_replace('terlengkap, terpercaya, dan mudah diakses,', '<strong class="text-[#1A2E5A]">terlengkap, terpercaya, dan mudah diakses,</strong>', e($pageContents['tentang-kami']['vision_description'] ?? 'Menjadi platform informasi mahasiswa JTI yang terlengkap, terpercaya, dan mudah diakses, mendorong setiap mahasiswa untuk terus berkembang dan meraih potensi terbaiknya.')) !!}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- NOTE 4 --}}
                <div data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <div class="absolute -top-4 right-8 z-20" style="animation: pinWobbleR 3s ease-in-out infinite;">
                            <div class="w-7 h-7 rounded-full bg-[#fb923c] shadow-lg border-2 border-white flex items-center justify-center">
                                <span class="text-white text-[10px] font-black">04</span>
                            </div>
                        </div>
                        <div class="rotate-[2deg] hover:rotate-0 hover:scale-[1.03] transition-all duration-500 bg-[#FFF7ED] rounded-2xl p-7 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-orange-100 h-full">
                            <p class="text-[10px] font-bold text-orange-400 uppercase tracking-widest mb-2">{{ $pageContents['tentang-kami']['mission_label'] ?? 'Misi' }}</p>
                            <h3 class="text-xl font-black text-[#1A2E5A] mb-3">{{ $pageContents['tentang-kami']['mission_title'] ?? 'Apa yang Kami Lakukan' }}</h3>
                            @php
                                $misiList = json_decode($pageContents['tentang-kami']['mission_description'] ?? '[]', true);
                                if (empty($misiList)) {
                                    $misiList = [
                                        'Mengumpulkan informasi peluang dari berbagai sumber terpercaya',
                                        'Menyajikan informasi yang akurat, lengkap, dan tepat waktu',
                                        'Membangun komunitas mahasiswa yang aktif dan berprestasi'
                                    ];
                                }
                            @endphp
                            <ul class="text-sm text-gray-500 leading-relaxed space-y-1.5">
                                @foreach($misiList as $misi)
                                    <li class="flex items-start gap-2">
                                        <span class="text-orange-400 mt-0.5">→</span>
                                        {{ $misi }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ================================
         FITUR SECTION
    ================================= --}}
    <section class="py-20 px-4 md:px-10" style="background: linear-gradient(180deg, #ffffff 0%, #EEF4FF 100%);">
        <div class="max-w-4xl mx-auto">

            <div class="text-center mb-14" data-aos="fade-up">
                <p class="uppercase tracking-[0.3em] text-xs font-bold text-[#8FA9C0] mb-3">
                    {{ $pageContents['tentang-kami']['features_label'] ?? 'Apa Saja di JTIFY' }}
                </p>
                <h2 class="text-3xl md:text-5xl font-black text-[#1A2E5A] leading-tight">
                    @php
                        $featuresTitle = $pageContents['tentang-kami']['features_title'] ?? 'Fitur yang Tersedia';
                        $featuresHighlight = 'Tersedia';
                        $featuresParts = explode($featuresHighlight, $featuresTitle);
                    @endphp
                    {!! count($featuresParts) > 1 ? e($featuresParts[0]) . '<span class="relative inline-block mx-1"><span class="absolute inset-0 bg-[#B7C9FF] rotate-[1deg] rounded-sm"></span><span class="relative px-3">' . e($featuresHighlight) . '</span></span>' . e($featuresParts[1]) : e($featuresTitle) !!}
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                <div class="transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:rotate-0 bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-gray-100 rotate-[-1deg] flex flex-col"
                    data-aos="fade-up" data-aos-delay="0">
                    <div class="w-12 h-12 rounded-xl bg-[#FFE8E8] flex items-center justify-center mb-5">
                        <img src="https://img.icons8.com/ios-glyphs/28/EE2828/trophy.png" alt="Lomba"/>
                    </div>
                    <h4 class="font-black text-[#1A2E5A] text-lg mb-2">{{ $pageContents['tentang-kami']['feature_competition_title'] ?? 'Lomba' }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed flex-1">
                        {{ $pageContents['tentang-kami']['feature_competition_description'] ?? 'Kompetisi nasional & internasional desain, teknologi, sains, bisnis, dan banyak lagi.' }}
                    </p>
                    <a href="{{ route('lomba') }}" class="inline-flex items-center gap-1 mt-5 text-xs font-bold text-[#EE2828] hover:gap-2 transition-all duration-300">
                        Lihat Lomba
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <div class="transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:rotate-0 bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-gray-100 rotate-[1deg] flex flex-col"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-xl bg-[#E8F0FF] flex items-center justify-center mb-5">
                        <img src="https://img.icons8.com/ios-glyphs/28/1A56DB/megaphone.png" alt="Seminar"/>
                    </div>
                    <h4 class="font-black text-[#1A2E5A] text-lg mb-2">{{ $pageContents['tentang-kami']['feature_seminar_title'] ?? 'Seminar' }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed flex-1">
                        {{ $pageContents['tentang-kami']['feature_seminar_description'] ?? 'Jadwal seminar, webinar, dan workshop untuk mengasah skill dan memperluas wawasan.' }}
                    </p>
                    <a href="{{ route('seminar') }}" class="inline-flex items-center gap-1 mt-5 text-xs font-bold text-[#1A56DB] hover:gap-2 transition-all duration-300">
                        Lihat Seminar
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <div class="transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] hover:rotate-0 bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-gray-100 rotate-[-1deg] flex flex-col"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-xl bg-[#E8FFF4] flex items-center justify-center mb-5">
                        <img src="https://img.icons8.com/ios-glyphs/28/0D7A4E/graduation-cap.png" alt="Beasiswa"/>
                    </div>
                    <h4 class="font-black text-[#1A2E5A] text-lg mb-2">{{ $pageContents['tentang-kami']['feature_scholarship_title'] ?? 'Beasiswa' }}</h4>
                    <p class="text-sm text-gray-500 leading-relaxed flex-1">
                        {{ $pageContents['tentang-kami']['feature_scholarship_description'] ?? 'Info beasiswa dari berbagai lembaga, lengkap dengan syarat, deadline, dan cara daftar.' }}
                    </p>
                    <a href="{{ route('beasiswa') }}" class="inline-flex items-center gap-1 mt-5 text-xs font-bold text-[#0D7A4E] hover:gap-2 transition-all duration-300">
                        Lihat Beasiswa
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="relative z-0 h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>
    
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