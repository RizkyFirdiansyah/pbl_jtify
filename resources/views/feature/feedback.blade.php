<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Feedback</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="antialiased relative overflow-x-hidden flex flex-col min-h-screen font-sans bg-white/95">

    <div id="toastContainer" class="fixed top-24 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    <!-- NAVBAR COMPONENT -->
    @include('components.navbar')

    <!-- HEADER COMPONENT -->
    @include('components.header-konten', [
        'title' => 'FEEDBACK',
        'label' => 'Hubungi Kami',
        'subtitle' => 'Bagikan Pengalaman dan Masukan Anda untuk Pengembangan Platform',
        'showSearch' => false
    ])

    <!-- Back Button -->
    <div class="absolute top-[480px] left-6 lg:left-20 z-50">
        <button onclick="history.back()" class="w-[40px] h-[40px] bg-[#486284] hover:bg-[#313B6D] text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg hover:-translate-x-1 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <main class="w-full flex-grow flex flex-col items-center pt-20 px-6 pb-0 relative z-10">

        @guest
        <!-- Lock Feedback for Guests -->
        <div class="w-full max-w-[494px] flex flex-col gap-5" data-aos="fade-up">
            
            <!-- Warning Alert with Login Button -->
            <div class="w-full bg-[#FFFBEB] border border-[#FDE68A] text-[#92400E] rounded-[10px] p-6 text-center shadow-[0_4px_10px_rgba(0,0,0,0.03)]">
                <p class="font-['Poppins',poppins] font-bold text-base mb-2">Akses Terbatas</p>
                <p class="font-sans text-xs sm:text-sm text-[#B45309] mb-5 leading-relaxed">
                    Silakan masuk ke akun Anda terlebih dahulu untuk dapat mengisi dan mengirimkan feedback.
                </p>
                <a href="{{ route('login') }}" class="inline-flex h-[40px] px-8 bg-gradient-to-br from-[#7784C6] to-[#2A4BB6] shadow-[0px_4px_4px_rgba(42,75,182,0.2)] rounded-full font-['poppins',poppins] font-bold text-sm text-[#FFFFFF] tracking-wide hover:scale-105 transition-transform duration-300 items-center justify-center">
                    Masuk (Login)
                </a>
            </div>

            <!-- Disabled Text Area -->
            <div class="w-full bg-[#F8FAFC] border border-slate-100 shadow-[2px_4px_12px_rgba(0,0,0,0.03)] rounded-[10px] p-6 h-[157px] cursor-not-allowed opacity-60 select-none">
                <textarea 
                    disabled
                    class="w-full h-full resize-none border-none outline-none font-['Poppins',poppins] text-[15px] leading-[30px] text-[#94A3B8] placeholder-[#94A3B8] bg-transparent cursor-not-allowed" 
                    placeholder="Silakan login terlebih dahulu untuk mengisi feedback..."></textarea>
            </div>
            
            <!-- Disabled Submit Button -->
            <button disabled class="w-full h-[50px] bg-slate-200 text-slate-400 shadow-[0px_4px_4px_rgba(0,0,0,0.05)] rounded-[20px] font-['poppins',poppins] font-bold text-[23px] tracking-[-0.02em] cursor-not-allowed flex justify-center items-center opacity-70">
                Kirim
            </button>

        </div>
        @else
        <!-- Form Area -->
        <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST" class="w-full max-w-[494px] flex flex-col gap-4" data-aos="fade-up">
            @csrf

            <!-- Alerts -->
            @if(session('success'))
                <div class="w-full bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-[10px] p-4 text-xs sm:text-sm font-semibold text-center mb-2 shadow-sm animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="w-full bg-rose-50 text-rose-600 border border-rose-200 rounded-[10px] p-4 text-xs sm:text-sm font-semibold text-center mb-2 shadow-sm">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <!-- Text Area Container -->
            <div class="w-full bg-[#FFFFFF] shadow-[2px_4px_12px_rgba(0,0,0,0.1)] rounded-[10px] p-6 h-[157px]">
                <textarea 
                    name="message"
                    required
                    class="w-full h-full resize-none border-none outline-none font-['Poppins',poppins] text-[15px] leading-[30px] text-[#6A7581] placeholder-[#6A7581] bg-transparent" 
                    placeholder="Bagaimana pengalaman Anda menggunakan platform ini?">{{ old('message') }}</textarea>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="w-full h-[50px] bg-gradient-to-br from-[#7784C6] to-[#2A4BB6] shadow-[0px_4px_4px_rgba(0,0,0,0.25)] rounded-[20px] font-['poppins',poppins] font-bold text-[23px] text-[#FFFFFF] tracking-[-0.02em] hover:scale-105 transition-transform duration-300 flex justify-center items-center">
                Kirim
            </button>

        </form>
        @endguest

    </main>

    <!-- ================================
         FOOTER TRANSITION
    ================================= -->
    <section class="relative z-0 h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    <!-- ================================
         FOOTER
    ================================= -->
    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/feedback-interaction.js') }}"></script>
</body>
</html>
