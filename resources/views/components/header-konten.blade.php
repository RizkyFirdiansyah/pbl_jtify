
<header class="relative w-full min-h-[430px] md:min-h-[520px] bg-no-repeat bg-center flex flex-col items-center justify-center pt-24 pb-24 overflow-hidden"
        style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">

    <div class="absolute inset-0 bg-white/5"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4">

        <p class="anim-line1 uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#0a0c0e] mb-5">
            {{ $label ?? 'Informasi' }}
        </p>

        <div class="mb-5 anim-title">
            @php
                $words = isset($titleWords) && is_array($titleWords) ? $titleWords : explode(' ', $title ?? 'JTIFY');
            @endphp
            <div class="flex flex-wrap justify-center gap-3 px-2">
                @foreach($words as $word)
                    <div class="relative inline-block">
                        <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>
                        <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none px-4 py-2.5 sm:px-6 sm:py-3 tracking-wider drop-shadow-xl"
                            style="font-size: clamp(1.6rem, 5vw, 3.8rem);">
                            {{ $word }}
                        </h1>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-8">
            {{-- JIKA halaman mendaftar parameter tunggal $subtitle (Gaya Detail Beasiswa) --}}
            @if(isset($subtitle))
                <p class="anim-line1 font-semibold text-[#1A2E5A] opacity-90 max-w-2xl mx-auto leading-relaxed"
                   style="font-size: clamp(1.2rem, 2.5vw, 1.8rem);">
                    {{ $subtitle }}
                </p>
            @else
                {{-- JIKA halaman mendaftar parameter terpisah (Gaya Tips & Insight / Index) --}}
                @if(isset($subtitle1) || isset($highlight1))
                    <h2 class="anim-line1 font-extrabold text-[#1A2E5A] leading-snug mb-1" style="font-size: clamp(1.4rem, 3vw, 2.1rem);">
                        {{ $subtitle1 ?? '' }} 
                        @if(isset($highlight1))
                            <span class="bg-[#4C75F2] text-white px-2 py-0.5 rounded-sm inline-block">{{ $highlight1 }}</span>
                        @endif
                    </h2>
                @endif

                @if(isset($subtitle2) || isset($highlight2))
                    <h2 class="anim-line2 font-extrabold text-[#1A2E5A] leading-snug" style="font-size: clamp(1.4rem, 3vw, 2.1rem);">
                        {{ $subtitle2 ?? '' }} 
                        @if(isset($highlight2))
                            <span class="bg-[#E0A6F2] text-[#1A2E5A] px-2 py-0.5 rounded-sm inline-block">{{ $highlight2 }}</span>
                        @endif
                    </h2>
                @endif
            @endif
        </div>

    </div>
</header>

@if(!isset($showSearch) || $showSearch)
<div class="px-4 md:px-10 -mt-10 relative z-20 flex justify-center">
    <div class="w-full z-20 anim-search px-4" style="max-width: 651px;">
        <form id="headerSearchForm" method="GET" action="#">
            <div class="bg-white/95 backdrop-blur-md rounded-full flex items-center shadow-[0_15px_35px_rgba(0,0,0,0.18)] border border-white/50 transition-all duration-500"
                 style="height: 60px; padding: 0 6px;">
                
                <div class="hidden sm:flex items-center px-4 border-r border-gray-200 shrink-0">
                    <select name="category" id="headerCategorySelect" class="bg-transparent text-sm text-gray-600 outline-none cursor-pointer font-medium">
                        <option value="">Kategori</option>
                        <option value="{{ route('lomba') }}" {{ request()->routeIs('lomba') ? 'selected' : '' }}>Lomba</option>
                        <option value="{{ route('seminar') }}" {{ request()->routeIs('seminar') ? 'selected' : '' }}>Seminar</option>
                        <option value="{{ route('beasiswa') }}" {{ request()->routeIs('beasiswa') ? 'selected' : '' }}>Beasiswa</option>
                        <option value="{{ route('tips') }}" {{ request()->routeIs('tips') ? 'selected' : '' }}>Tips &amp; Insight</option>
                    </select>
                </div>

                <div class="flex-1 flex items-center px-4 min-w-0">
                    <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" name="q" placeholder="Cari informasi" value="{{ request('q') }}"
                           class="w-full bg-transparent outline-none text-sm text-gray-700 placeholder-gray-400 min-w-0">
                </div>

                <button type="submit" 
                        class="bg-[#3B4C7E] text-white px-5 sm:px-8 rounded-full text-sm font-bold hover:bg-[#2D3A61] hover:scale-105 active:scale-95 transition-all duration-300 shrink-0 whitespace-nowrap"
                        style="height: 46px;">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('headerSearchForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            const q = this.querySelector('input[name="q"]').value.trim();
            const categorySelect = document.getElementById('headerCategorySelect');
            const selectedCategoryUrl = categorySelect ? categorySelect.value : '';

            let base = selectedCategoryUrl;

            // Jika kategori tidak dipilih secara manual, coba deteksi otomatis berdasarkan query kata kunci
            if (!base && q) {
                const qLower = q.toLowerCase();
                if (qLower.includes('lomba') || qLower.includes('competition') || qLower.includes('hackathon') || qLower.includes('contest') || qLower.includes('kontes')) {
                    base = "{{ route('lomba') }}";
                } else if (qLower.includes('seminar') || qLower.includes('webinar') || qLower.includes('workshop') || qLower.includes('talkshow') || qLower.includes('talk show') || qLower.includes('kelas') || qLower.includes('wawasan')) {
                    base = "{{ route('seminar') }}";
                } else if (qLower.includes('beasiswa') || qLower.includes('scholarship') || qLower.includes('lpdp') || qLower.includes('bantuan') || qLower.includes('prestasi')) {
                    base = "{{ route('beasiswa') }}";
                } else if (qLower.includes('tips') || qLower.includes('insight') || qLower.includes('cara') || qLower.includes('strategi') || qLower.includes('cv') || qLower.includes('portofolio') || qLower.includes('speaking') || qLower.includes('artikel')) {
                    base = "{{ route('tips') }}";
                }
            }

            // Jika masih belum terdeteksi/terpilih, gunakan path saat ini (jika berada di salah satu halaman kategori)
            if (!base) {
                const path = window.location.pathname;
                if (path.includes('/lomba') || path.includes('/seminar') || path.includes('/beasiswa') || path.includes('/tips')) {
                    base = window.location.origin + path;
                } else {
                    base = "{{ route('lomba') }}";
                }
            }

            const currentBase = window.location.origin + window.location.pathname;
            const baseClean = base.replace(/\/$/, "");
            const currentBaseClean = currentBase.replace(/\/$/, "");
            const url = q ? baseClean + '?q=' + encodeURIComponent(q) : baseClean;

            if (baseClean === currentBaseClean && document.getElementById('cardGrid')) {
                // Biarkan handler AJAX di listing-ajax.js yang memproses
                e.preventDefault();
            } else {
                e.preventDefault();
                window.location.href = url;
            }
        });
    });
</script>
@endif