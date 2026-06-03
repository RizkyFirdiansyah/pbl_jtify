<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - {{ $tip['title'] }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] text-slate-700 overflow-x-hidden scroll-smooth font-sans">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- TOAST NOTIFICATION --}}
    <div id="toastContainer" class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

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
            
            {{-- Category tag with HSL gradient border --}}
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black tracking-widest uppercase bg-gradient-to-r from-[#4C75F2]/10 to-[#E0A6F2]/10 text-[#3B4C7E] border border-[#4C75F2]/20 mb-6" data-aos="fade-down">
                <span class="w-1.5 h-1.5 rounded-full bg-[#4C75F2] animate-pulse"></span>
                {{ $tip['category'] }}
            </span>

            {{-- Main Title --}}
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-editorial font-extrabold text-[#1A2E5A] leading-tight max-w-4xl mx-auto mb-6" data-aos="fade-up" data-aos-delay="100">
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
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 6v6l4 2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ $tip['read_time'] }}
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
    <main class="max-w-6xl mx-auto px-4 pb-24">
        
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            {{-- SIDEBAR LEFT (Sticky) --}}
            <aside class="w-full lg:w-1/4 sticky top-[100px] hidden lg:block">
                
                {{-- Table of Contents --}}
                <div class="bg-white/70 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 mb-6 shadow-[0_4px_30px_rgba(0,0,0,0.02)]">
                    <h3 class="text-xs font-black uppercase text-[#1A2E5A] tracking-wider mb-4 border-b border-slate-200/50 pb-2">Daftar Isi</h3>
                    <nav class="flex flex-col gap-3">
                        <a href="#pendahuluan" class="text-xs font-semibold text-slate-400 hover:text-[#4C75F2] transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            Pendahuluan
                        </a>
                        <a href="#ringkasan" class="text-xs font-semibold text-slate-400 hover:text-[#4C75F2] transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            Poin Kunci
                        </a>
                        <a href="#isi-artikel" class="text-xs font-semibold text-slate-400 hover:text-[#4C75F2] transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            Pembahasan
                        </a>
                        <a href="#kesimpulan" class="text-xs font-semibold text-slate-400 hover:text-[#4C75F2] transition-colors flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                            Kesimpulan
                        </a>
                    </nav>
                </div>

                {{-- Action Bar --}}
                <div class="bg-white/70 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 shadow-[0_4px_30px_rgba(0,0,0,0.02)] flex flex-col gap-4">
                    <h3 class="text-xs font-black uppercase text-[#1A2E5A] tracking-wider border-b border-slate-200/50 pb-2 mb-1">Aksi Artikel</h3>
                    
                    {{-- Bookmark Button --}}
                    <button onclick="toggleBookmark()" id="btnBookmark" class="w-full flex items-center justify-center gap-2 bg-[#F1F5F9] hover:bg-[#DDEBFF] text-slate-600 hover:text-[#4C75F2] py-2.5 rounded-xl text-xs font-bold transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" id="bookmarkIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        <span id="bookmarkText">Simpan Tips</span>
                    </button>

                    {{-- Share Buttons --}}
                    <div class="flex gap-2">
                        <button onclick="copyLink()" class="flex-1 flex items-center justify-center gap-1.5 bg-[#EEF1FF] hover:bg-[#D8DCFF] text-[#3B4C7E] py-2 rounded-lg text-[11px] font-bold transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>

            </aside>

            {{-- ARTICLE WRAPPER --}}
            <article class="w-full lg:w-3/4 bg-white rounded-3xl p-6 sm:p-10 md:p-14 shadow-[0_8px_30px_rgba(0,0,0,0.03)] border border-slate-100" data-aos="fade-up">
                
                {{-- FEATURED IMAGE MOCKUP --}}
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden mb-12 shadow-sm" id="pendahuluan">
                    <div class="absolute inset-0 bg-gradient-to-br from-[#DDEBFF] via-[#E8EEF8] to-[#F1F5F9] flex items-center justify-center">
                        <div class="text-center p-6">
                            <svg class="w-16 h-16 text-[#4C75F2]/20 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                            <h4 class="text-[#1A2E5A] font-bold text-sm sm:text-base leading-tight">{{ $tip['title'] }}</h4>
                            <p class="text-slate-400 text-xs mt-1">Edisi Tips &amp; Trik JTIFY Mahasiswa Berprestasi</p>
                        </div>
                    </div>
                </div>

                {{-- KEY TAKEAWAYS (Ringkasan) --}}
                <div class="bg-gradient-to-br from-[#F0F5FF] to-[#F5FAFF] border border-blue-100 rounded-2xl p-6 sm:p-8 mb-12 shadow-sm" id="ringkasan">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="bg-[#2F6FED] text-white text-[9px] font-black tracking-widest uppercase px-2.5 py-1 rounded">POIN KUNCI</span>
                        <h3 class="text-[#1A2E5A] font-black text-sm uppercase tracking-wider">Ringkasan Utama</h3>
                    </div>
                    <ul class="space-y-3.5">
                        @foreach($tip['key_takeaways'] as $takeaway)
                            <li class="flex items-start gap-3">
                                <span class="bg-blue-100 text-blue-600 rounded-full p-1 mt-0.5 flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </span>
                                <span class="text-xs sm:text-sm text-[#3B4C7E] font-medium leading-relaxed">{{ $takeaway }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- ARTICLE BODY --}}
                <div class="article-body article-dropcap text-slate-600 text-sm sm:text-base leading-relaxed space-y-6 text-justify" id="isi-artikel">
                    
                    {{-- Loop paragraphs --}}
                    @foreach($tip['content'] as $p)
                        @if($loop->index == 2)
                            {{-- PULL-QUOTE IN THE MIDDLE --}}
                            <blockquote class="my-10 border-l-4 border-[#2F6FED] bg-slate-50 p-6 italic rounded-r-2xl shadow-sm text-center lg:text-left">
                                <p class="text-[#1A2E5A] font-editorial font-medium text-base sm:text-lg leading-relaxed mb-2">
                                    "{{ $tip['description'] }}"
                                </p>
                                <cite class="text-xs font-bold text-slate-400 not-italic">— {{ $tip['author'] }}, {{ $tip['category'] }} Expert</cite>
                            </blockquote>
                        @endif
                        <p class="leading-[1.8]">{{ $p }}</p>
                    @endforeach

                </div>

                {{-- TAGS --}}
                <div class="mt-12 pt-8 border-t border-slate-100 flex flex-wrap gap-2" id="kesimpulan">
                    @foreach($tip['tags'] as $tag)
                        <span class="bg-slate-100 text-slate-500 text-xs px-3.5 py-1.5 rounded-full font-medium">#{{ $tag }}</span>
                    @endforeach
                </div>

                {{-- WAS THIS HELPFUL FEEDBACK --}}
                <div class="mt-12 bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center">
                    <h4 class="text-sm font-bold text-[#1A2E5A] mb-4">Apakah artikel ini bermanfaat bagi Anda?</h4>
                    <div class="flex justify-center gap-4">
                        <button onclick="submitFeedback('yes')" class="group flex items-center gap-2 bg-white hover:bg-emerald-50 text-slate-600 hover:text-emerald-600 border border-slate-200 hover:border-emerald-200 px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3"/>
                            </svg>
                            Ya, Membantu
                        </button>
                        <button onclick="submitFeedback('no')" class="group flex items-center gap-2 bg-white hover:bg-rose-50 text-slate-600 hover:text-rose-600 border border-slate-200 hover:border-rose-200 px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4 transition-transform group-hover:translate-y-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 15v4a3 3 0 003 3l4-9V2H5.72a2 2 0 00-2 1.7l-1.38 9a2 2 0 002 2.3zm10-13h3a2 2 0 012 2v7a2 2 0 01-2 2h-3"/>
                            </svg>
                            Tidak
                        </button>
                    </div>
                </div>

            </article>

        </div>

    </main>

    {{-- RELATED ARTICLES SECTION --}}
    <section class="bg-white border-t border-slate-100 py-24">
        <div class="max-w-6xl mx-auto px-4">
            
            <div class="text-center mb-16">
                <p class="uppercase tracking-[0.25em] text-[10px] font-black text-slate-400 mb-3">Rekomendasi Bacaan</p>
                <h3 class="text-2xl md:text-3xl font-editorial font-bold text-[#1A2E5A]">Tips Menarik Lainnya</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recommendations as $rec)
                    <a href="{{ route('tips.detail', ['slug' => $rec['slug']]) }}"
                       class="group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                       style="aspect-ratio: 2/3;"
                       data-aos="fade-up"
                       data-aos-delay="{{ $loop->index * 100 }}">

                        {{-- Poster/Gradient Background --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                            <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                            </svg>
                        </div>

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
                @endforeach
            </div>

        </div>
    </section>

    {{-- FOOTER GRADIENT TRANSITION --}}
    <div class="h-32" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></div>

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

        // TOAST CREATOR
        function showToast(message) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = "toast-notification bg-[#1A2E5A] text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-2 pointer-events-auto border border-white/10 text-xs font-bold";
            toast.innerHTML = `
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <span>${message}</span>
            `;
            container.appendChild(toast);

            // Reflow for transition
            toast.offsetHeight;
            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        // BOOKMARK
        let isBookmarked = false;
        function toggleBookmark() {
            isBookmarked = !isBookmarked;
            const btn = document.getElementById('btnBookmark');
            const icon = document.getElementById('bookmarkIcon');
            const text = document.getElementById('bookmarkText');

            if (isBookmarked) {
                btn.className = "w-full flex items-center justify-center gap-2 bg-[#2F6FED] hover:bg-[#1C52C2] text-white py-2.5 rounded-xl text-xs font-bold transition-all duration-300";
                icon.setAttribute('fill', 'currentColor');
                text.textContent = "Tersimpan";
                showToast("Tips berhasil disimpan ke Bookmark Anda!");
            } else {
                btn.className = "w-full flex items-center justify-center gap-2 bg-[#F1F5F9] hover:bg-[#DDEBFF] text-slate-600 hover:text-[#4C75F2] py-2.5 rounded-xl text-xs font-bold transition-all duration-300";
                icon.removeAttribute('fill');
                text.textContent = "Simpan Tips";
                showToast("Tips dihapus dari Bookmark.");
            }
        }

        // COPY LINK
        function copyLink() {
            const dummy = document.createElement('input');
            dummy.value = window.location.href;
            document.body.appendChild(dummy);
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            showToast("Tautan berhasil disalin!");
        }

        // FEEDBACK
        function submitFeedback(val) {
            if (val === 'yes') {
                showToast("Terima kasih atas feedback positif Anda!");
            } else {
                showToast("Terima kasih atas masukannya, kami akan terus meningkatkan kualitas.");
            }
        }
    </script>

</body>
</html>
