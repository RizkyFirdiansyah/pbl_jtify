<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name'] ?? 'JTIFY' }} - {{ $tip['title'] }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] text-slate-700 overflow-x-hidden scroll-smooth font-sans">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- BACK FLOATING BUTTON --}}
    <div class="fixed top-28 left-4 sm:left-8 z-40">
        <button onclick="history.back()"
                class="w-[46px] h-[46px] bg-white hover:bg-[#1A2E5A] hover:text-white text-[#1A2E5A] rounded-full flex items-center justify-center shadow-[0_4px_20px_rgba(0,0,0,0.08)] hover:scale-105 active:scale-95 transition-all duration-300 group border border-slate-100"
                aria-label="Kembali ke Tips">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
        </button>
    </div>

    {{-- HERO HEADER --}}
    <header class="relative w-full pt-32 pb-16 bg-gradient-to-b from-[#EEF4FF] via-[#F1F5F9] to-[#F8FAFC]">
        <div class="max-w-5xl mx-auto px-4 text-center">

            {{-- Main Title --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-sans font-extrabold text-[#1A2E5A] leading-tight max-w-4xl mx-auto mb-6" data-aos="fade-up" data-aos-delay="100">
                {{ $tip['title'] }}
            </h1>

            {{-- Metadata --}}
            <div class="flex items-center justify-center gap-4 text-xs sm:text-sm text-slate-400 mb-8" data-aos="fade-up" data-aos-delay="200">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 2V6M8 2V6M3 10H21" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ $tip['date'] }}
                </span>
            </div>

            {{-- Author Bio Card --}}
            <div class="inline-flex items-center gap-3 bg-white p-2.5 pr-6 rounded-full shadow-sm border border-slate-100" data-aos="fade-up" data-aos-delay="300">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1A2E5A] to-[#4C75F2] text-white flex items-center justify-center font-bold text-sm tracking-wider">
                    {{ strtoupper(substr($tip['author'], 0, 2)) }}
                </div>
                <div class="text-left">
                    <div class="text-xs font-bold text-[#1A2E5A]">{{ $tip['author'] }}</div>
                    <div class="text-[10px] text-slate-400">{{ $tip['author_role'] }}</div>
                </div>
            </div>

        </div>
    </header>

    {{-- MAIN CONTAINER --}}
    <main class="max-w-4xl mx-auto px-4 pb-0">
        
        <div>
            
            {{-- ARTICLE WRAPPER --}}
            <article class="w-full bg-white rounded-3xl p-6 sm:p-10 md:p-14 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-slate-100" data-aos="fade-up">
                
                {{-- FEATURED IMAGE --}}
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden mb-12 shadow-sm" id="pendahuluan">
                    @if(!empty($tip['poster_path']) && (\Illuminate\Support\Facades\Storage::disk('public')->exists($tip['poster_path']) || file_exists(public_path('storage/' . $tip['poster_path']))))
                        <img src="{{ asset('storage/' . $tip['poster_path']) }}" alt="{{ $tip['title'] }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A2E5A]/40 via-transparent to-transparent"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-[#DDEBFF] via-[#E8EEF8] to-[#F1F5F9] flex items-center justify-center">
                            <div class="text-center p-6">
                                <svg class="w-16 h-16 text-[#4C75F2]/20 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                <h4 class="text-[#1A2E5A] font-bold text-sm sm:text-base leading-tight">{{ $tip['title'] }}</h4>
                                <p class="text-slate-400 text-xs mt-1">Edisi Tips &amp; Trik JTIFY Mahasiswa Berprestasi</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ARTICLE BODY --}}
                <div class="article-body article-dropcap text-slate-600 text-sm sm:text-base leading-relaxed space-y-6 text-justify" id="isi-artikel">
                    
                    {{-- Loop paragraphs --}}
                    @foreach($tip['content'] as $p)
                        <p class="leading-[1.8]">{{ $p }}</p>
                    @endforeach

                </div>

            </article>

        </div>

    </main>

    {{-- RELATED ARTICLES SECTION --}}
    <section class="bg-white border-t border-slate-100 py-24">
        <div class="max-w-6xl mx-auto px-4">
            
            <div class="text-center mb-16">
                <p class="uppercase tracking-[0.25em] text-[10px] font-black text-slate-400 mb-3">Rekomendasi Bacaan</p>
                <h3 class="text-2xl md:text-3xl font-sans font-bold text-[#1A2E5A]">Tips Menarik Lainnya</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recommendations as $rec)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ route('tips.detail', ['slug' => $rec['slug']]) }}"
                           class="group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                           style="aspect-ratio: 2/3;">

                            {{-- Poster/Gradient Background --}}
                            @if(!empty($rec['poster_path']) && (\Illuminate\Support\Facades\Storage::disk('public')->exists($rec['poster_path']) || file_exists(public_path('storage/' . $rec['poster_path']))))
                                <img src="{{ asset('storage/' . $rec['poster_path']) }}" alt="{{ $rec['title'] }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1A2E5A]/60 via-transparent to-transparent"></div>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                                    <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Content Overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 z-10 p-4" style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">
                                <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                                    {{ $rec['title'] }}
                                </h3>
                                <div class="flex items-center gap-1.5 mb-3">
                                    <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-white/70 text-[11px]">{{ $rec['date'] }}</span>
                                </div>
                                <span class="inline-flex items-center gap-2 w-full justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white text-xs font-bold py-2 rounded-xl transition-all duration-300 group-hover:bg-[#3B4C7E] group-hover:border-[#3B4C7E]">
                                    Lihat Detail
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- FOOTER GRADIENT TRANSITION --}}
    <section class="relative z-0 h-24" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- SCRIPTS --}}
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
