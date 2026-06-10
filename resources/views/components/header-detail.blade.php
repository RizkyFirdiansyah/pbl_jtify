
<header class="relative w-full  bg-no-repeat bg-center flex flex-col items-center justify-center pt-24 pb-24 overflow-hidden"
        style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">

    <div class="absolute inset-0 bg-white/5"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4">

        <p class="anim-line1 uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#0a0c0e] mb-5">
            {{ $label ?? 'Informasi' }}
        </p>

        <div class="mb-5 anim-title">
            <div class="flex flex-wrap justify-center px-2">
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>

                <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none
                        px-4 py-2.5 sm:px-6 sm:py-3 tracking-wider drop-shadow-xl"
                    style="font-size: clamp(1.6rem, 5vw, 3.8rem);">
                    {{ $title }}
                </h1>
            </div>                
            </div>
        </div>

        <div class="mb-8">
            {{-- JIKA halaman mendaftar parameter tunggal $subtitle (Gaya Detail Beasiswa) ── --}}
            @if(isset($subtitle))
                <p class="anim-line1 font-semibold text-[#1A2E5A] opacity-90 max-w-2xl mx-auto leading-relaxed"
                   style="font-size: clamp(1.1rem, 2.5vw, 1.6rem);">
                    {{ $subtitle }}
                </p>
            @else
                {{-- JIKA halaman mendaftar parameter terpisah (Gaya Tips & Insight / Index) ── --}}
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