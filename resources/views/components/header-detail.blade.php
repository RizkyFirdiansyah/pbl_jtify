<style>
    @keyframes popIn {
        0% { opacity: 0; transform: scale(0.8) translateY(20px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes popInLeft {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .anim-label {
        opacity: 0;
        animation: popInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s forwards;
    }

    .anim-title {
        opacity: 0;
        animation: popIn 0.9s cubic-bezier(0.34, 1.56, 0.64, 1) 0.4s forwards;
    }

    .anim-meta {
        opacity: 0;
        animation: fadeUp 0.8s ease-out 0.6s forwards;
    }
</style>

<header class="relative w-full min-h-[350px] md:min-h-[450px] bg-no-repeat bg-center flex flex-col items-center justify-center pt-24 pb-16 overflow-hidden" style="background-image: url('{{ asset('assets/header-konten.svg') }}'); background-size: cover;">
    
    <div class="absolute inset-0 bg-white/10"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4 max-w-4xl mx-auto">

        <p class="anim-label uppercase tracking-[0.3em] text-xs sm:text-sm font-bold text-[#3B4C7E] bg-white/80 px-4 py-1.5 rounded-full shadow-sm mb-6">
            {{ $kategori ?? 'Detail Informasi' }}
        </p>

        <h1 class="anim-title font-black text-[#1A2E5A] leading-tight mb-6 drop-shadow-md" style="font-size: clamp(2rem, 5vw, 3.5rem);">
            {{ $title ?? 'Judul Konten Tidak Tersedia' }}
        </h1>
        
    </div>
</header>