<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: rgba(255, 255, 255, 0.95);
            min-height: 100vh;
        }
    </style>
</head>
<body class="antialiased relative overflow-x-hidden flex flex-col min-h-screen">

    <!-- Back Button -->
    <div class="absolute top-[40px] left-6 lg:left-20 z-50">
        <button onclick="history.back()" class="w-[40px] h-[40px] bg-[#486284] hover:bg-[#313B6D] text-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg hover:-translate-x-1 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
    </div>

    <!-- Main Content -->
    <main class="w-full flex-grow flex flex-col items-center pt-[115px] px-6 pb-20 relative z-10">
        
        <!-- Headers -->
        <div class="flex flex-col items-center gap-2 w-full max-w-[719px] text-center mb-10">
            <h1 class="font-bold text-[48px] md:text-[60px] leading-[76px] text-[#486284] tracking-[0.5px]">
                Feedback
            </h1>
            <p class="font-normal text-[16px] md:text-[20px] leading-[32px] tracking-[0.5px] text-[#8CA2C0]">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut est sem. Quisque dictum orci eget imperdiet varius. Donec eleifend nisl ligula, eget egestas ligula vehicula quis.
            </p>
        </div>

        <!-- Form Area -->
        <div class="w-full max-w-[494px] flex flex-col gap-6">
            
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

    <!-- Footer Component -->
    <!-- Memberikan margin top negatif jika diperlukan untuk meniru struktur absolut -->
    <div class="relative w-full mt-auto">
        <x-footer />
    </div>

</body>
</html>
