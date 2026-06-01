<style>
    @keyframes popIn {
        0% { opacity: 0; transform: scale(0.35) translateY(40px); }
        60% { opacity: 1; transform: scale(1.1) translateY(-10px); }
        80% { transform: scale(0.96) translateY(5px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes popInLeft {
        0% { opacity: 0; transform: scale(0.5) translateX(-60px); }
        60% { opacity: 1; transform: scale(1.08) translateX(8px); }
        80% { transform: scale(0.98) translateX(-4px); }
        100% { opacity: 1; transform: scale(1) translateX(0); }
    }
    @keyframes popInRight {
        0% { opacity: 0; transform: scale(0.5) translateX(60px); }
        60% { opacity: 1; transform: scale(1.08) translateX(-8px); }
        80% { transform: scale(0.98) translateX(4px); }
        100% { opacity: 1; transform: scale(1) translateX(0); }
    }
    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(35px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes floatSlow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-12px); }
    }
    @keyframes floatMedium {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .anim-title {
        opacity: 0;
        animation: popIn 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s forwards, floatSlow 5s ease-in-out 1.5s infinite;
    }
    .anim-line1 {
        opacity: 0;
        animation: popInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.7s forwards, floatMedium 5s ease-in-out 2s infinite;
    }
    .anim-line2 {
        opacity: 0;
        animation: popInRight 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 1s forwards, floatMedium 5s ease-in-out 2.3s infinite;
    }
</style>

<header class="relative w-full min-h-[430px] md:min-h-[520px] bg-no-repeat bg-center flex flex-col items-center justify-center pt-24 pb-24 overflow-hidden"
        style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">

    <div class="absolute inset-0 bg-white/5"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4">

        <p class="anim-line1 uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#0a0c0e] mb-5">
            {{ $label ?? 'Informasi' }}
        </p>

        <div class="relative inline-block mb-5 anim-title">
            <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>

            <h1 class="relative font-black text-[#1A2E5A] uppercase leading-tight px-6 py-3 tracking-wider drop-shadow-xl flex flex-wrap justify-center gap-x-3"
                style="font-size: clamp(2.5rem, 6vw, 5.5rem);">
                
                {{-- Cek jika halaman utama mengirim data array per kata (seperti TIPS & INSIGHT) --}}
                @if(isset($titleWords) && is_array($titleWords))
                    @foreach($titleWords as $word)
                        <span class="inline-block">{{ $word }}</span>
                    @endforeach
                @else
                    {{-- Fallback jika halaman hanya mendaftar kata String biasa (seperti DETAIL BEASISWA) --}}
                    {{ $title ?? 'JTIFY' }}
                @endif
            </h1>
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