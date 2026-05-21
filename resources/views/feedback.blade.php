<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Feedback</title>
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }
    </style>
</head>
<body class="antialiased relative overflow-x-hidden flex flex-col min-h-screen">

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
    <main class="w-full flex-grow flex flex-col items-center pt-20 px-6 pb-20 relative z-10">

        <!-- Form Area -->
        <div class="w-full max-w-[494px] flex flex-col gap-6" data-aos="fade-up">
            
            <!-- Text Area Container -->
            <div class="w-full bg-[#FFFFFF] shadow-[2px_4px_12px_rgba(0,0,0,0.1)] rounded-[10px] p-6 h-[157px]">
                <textarea 
                    class="w-full h-full resize-none border-none outline-none font-['Rubik',sans-serif] text-[15px] leading-[30px] text-[#6A7581] placeholder-[#6A7581] bg-transparent" 
                    placeholder="Bagaimana pengalaman Anda menggunakan platform ini?"></textarea>
            </div>
            
            <!-- Submit Button -->
            <button class="w-full h-[50px] bg-gradient-to-br from-[#7784C6] to-[#2A4BB6] shadow-[0px_4px_4px_rgba(0,0,0,0.25)] rounded-[20px] font-['Plus_Jakarta_Sans',sans-serif] font-bold text-[23px] text-[#FFFFFF] tracking-[-0.02em] hover:scale-105 transition-transform duration-300 flex justify-center items-center">
                Kirim
            </button>

        </div>

    </main>

    <!-- ================================
         FOOTER TRANSITION
    ================================= -->
    <section class="relative z-0 h-40 mt-auto" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    <!-- ================================
         FOOTER
    ================================= -->
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
