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
    .anim-search {
        opacity: 0;
        animation: fadeUp 0.8s ease-out 1.3s forwards;
    }
</style>

<header class="relative w-full min-h-[430px] md:min-h-[520px] bg-no-repeat bg-center flex flex-col items-center justify-center pt-24 pb-24 overflow-hidden"
        style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">

    <div class="absolute inset-0 bg-white/5"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4">

        <p class="anim-line1 uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#0a0c0e] mb-5">
            {{ $label ?? 'Informasi' }}
        </p>

        <div class="mb-5 anim-title">
            @if(isset($titleWords) && is_array($titleWords))
                {{-- JIKA ARRAY: Kotak kuning membungkus per kata agar pas mengikuti teksnya --}}
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach($titleWords as $word)
                        <div class="relative inline-block">
                            <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>
                            <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none px-6 py-3 tracking-wider drop-shadow-xl"
                                style="font-size: clamp(2.2rem, 6vw, 4.5rem);">
                                {{ $word }}
                            </h1>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- JIKA STRING BIASA: Plek ketiplek menggunakan format lama --}}
                <div class="relative inline-block">
                    <div class="absolute inset-0 bg-[#E8F19A] rounded-sm"></div>
                    <h1 class="relative font-black text-[#1A2E5A] uppercase leading-none px-6 py-3 tracking-wider drop-shadow-xl"
                        style="font-size: clamp(3rem, 7vw, 5.5rem);">
                        {{ $title ?? 'JTIFY' }}
                    </h1>
                </div>
            @endif
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
        <form id="searchForm">
            <div class="bg-white/95 backdrop-blur-md rounded-full flex items-center shadow-[0_15px_35px_rgba(0,0,0,0.18)] border border-white/50 transition-all duration-500"
                 style="height: 60px; padding: 0 6px;">
                
                <div class="hidden sm:flex items-center px-4 border-r border-gray-200 shrink-0">
                    <select id="categorySelect" class="bg-transparent text-sm text-gray-600 outline-none cursor-pointer font-medium">
                        <option value="">Kategori</option>
                        <option value="{{ route('lomba') }}">Lomba</option>
                        <option value="{{ route('seminar') }}">Seminar</option>
                        <option value="{{ route('beasiswa') }}">Beasiswa</option>
                    </select>
                </div>

                <div class="flex-1 flex items-center px-4 min-w-0">
                    <svg class="w-4 h-4 text-gray-400 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" placeholder="Cari informasi"
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
@endif