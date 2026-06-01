<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Diminati</title>
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Poppins & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="antialiased text-[#898383] relative overflow-x-hidden">

    <!-- NAVBAR COMPONENT -->
    @include('components.navbar')

    <!-- HEADER COMPONENT -->
    @include('components.header-konten', [
        'title' => 'DIMINATI',
        'subtitle' => 'Item Diminati'
    ])

    <!-- MAIN CONTENT -->
    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-16 pb-32">

        <!-- Section Title & Improvisasi -->
        <div class="mb-10 flex flex-col md:flex-row justify-between items-end gap-6 relative z-10">
            <div data-aos="fade-right">
                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Liked Items
                </p>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Item
                    <span class="relative inline-block">
                        Diminati
                        <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                    </span>
                </h2>
                <p class="text-sm md:text-base text-[#898383] mt-3">Daftar lomba, seminar, dan beasiswa yang telah Anda sukai.</p>
            </div>
            
            <!-- Improvisation: Filter/Sort Dropdown -->
            <div class="flex items-center gap-3" data-aos="fade-left">
                <span class="text-sm font-medium text-[#696262]">Kategori:</span>
                <select onchange="window.location.href='?category=' + this.value" class="px-5 py-2.5 rounded-full border border-gray-200 bg-white text-[#486284] font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-[#85A8F8] transition-all hover:border-[#85A8F8] cursor-pointer">
                    <option value="Semua Kategori" {{ (isset($currentCategory) && $currentCategory == 'Semua Kategori') ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="Lomba" {{ (isset($currentCategory) && $currentCategory == 'Lomba') ? 'selected' : '' }}>Lomba</option>
                    <option value="Seminar" {{ (isset($currentCategory) && $currentCategory == 'Seminar') ? 'selected' : '' }}>Seminar</option>
                    <option value="Beasiswa" {{ (isset($currentCategory) && $currentCategory == 'Beasiswa') ? 'selected' : '' }}>Beasiswa</option>
                </select>
            </div>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 relative z-10">
            @foreach ($bookmarks as $item)
            <!-- Card -->
            <div class="like-card h-[340px] w-full bg-[#E5E7EB] rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group cursor-pointer overflow-hidden flex flex-col justify-end border border-gray-100"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index * 70 }}">
                
                <!-- Like Icon Top Right -->
                <button type="button" onclick="toggleLike(this, event)" class="absolute top-0 right-4 z-20 hover:scale-110 transition-transform">
                    <div class="like-btn bg-white w-8 h-8 rounded-b-md flex justify-center items-center shadow-sm border border-gray-100 transition-colors duration-300">
                        <!-- Solid Red Heart Icon -->
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                </button>

                <!-- Center Placeholder Icon -->
                <div class="absolute inset-0 flex justify-center items-center bg-[#E5E7EB] group-hover:bg-[#D1D5DB] transition-colors duration-500 z-0">
                    <svg class="w-16 h-16 text-[#486284]/40 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                    </svg>
                </div>
                
                <!-- Improvisation: Content Overlay on Hover -->
                <div class="bg-gradient-to-t from-[#273266] via-[#273266]/80 to-transparent p-6 pt-16 flex flex-col justify-end opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 relative">
                    <span class="bg-[#FFB8B8] text-[#EE2828] text-[10px] font-bold px-2 py-1 rounded-md w-max mb-2 uppercase tracking-wider">{{ $item->category }}</span>
                    <h3 class="text-white font-semibold text-[17px] line-clamp-1 leading-snug">{{ $item->title }}</h3>
                    <p class="text-white/70 text-[13px] mt-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $item->date }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

            {{-- ================================
                 PAGINATION
            ================================= --}}
            <div class="mt-20 flex items-center justify-center gap-2">

                {{-- PREV --}}
                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                {{-- ACTIVE PAGE --}}
                <button class="w-10 h-10 rounded-full bg-[#1A2E5A] text-white text-sm font-bold shadow-lg">
                    1
                </button>

                {{-- PAGE --}}
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    2
                </button>
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    3
                </button>

                {{-- DOT --}}
                <span class="px-1 text-gray-400">
                    ...
                </span>

                {{-- LAST --}}
                <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">
                    68
                </button>

                {{-- NEXT --}}
                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

            </div>

        </div>
    </section>
    
    </main>

    {{-- ================================
         FOOTER TRANSITION
    ================================= --}}
    <section class="relative z-0 h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    {{-- ================================
         FOOTER
    ================================= --}}
    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,
            easing: 'ease-out-cubic'
        });

        function toggleLike(btn, event) {
            // Mencegah navigasi ke halaman detail jika card diklik
            event.preventDefault();
            event.stopPropagation();
            
            const likeBtn = btn.querySelector('.like-btn');
            const heartIcon = likeBtn.querySelector('svg');
            const card = btn.closest('.like-card');
            
            // Check if it's currently liked (has solid red color)
            const isLiked = heartIcon.classList.contains('text-red-500');
            
            if (isLiked) {
                // Proses Batal Suka
                heartIcon.classList.remove('text-red-500', 'fill-current');
                heartIcon.classList.add('text-gray-400', 'fill-none', 'stroke-current', 'stroke-2');
                
                card.classList.add('opacity-50', 'grayscale');
                showToast("Batal disukai!");
            } else {
                // Proses Sukai Kembali
                heartIcon.classList.add('text-red-500', 'fill-current');
                heartIcon.classList.remove('text-gray-400', 'fill-none', 'stroke-current', 'stroke-2');
                
                card.classList.remove('opacity-50', 'grayscale');
                showToast("Berhasil disukai kembali!");
            }
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-[#486284] px-6 py-3 rounded-xl shadow-[0px_4px_16px_rgba(0,0,0,0.1)] font-semibold border border-gray-100 flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 z-[100]';
            toast.innerHTML = `
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                ${message}
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.remove('translate-y-20', 'opacity-0');
            }, 10);
            
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        }
    </script>
</body>
</html>
