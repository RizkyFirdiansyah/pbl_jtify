<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Bookmark</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="antialiased text-[#898383] relative overflow-x-hidden font-sans" style="background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%); min-height: 100vh;">

    @include('components.navbar')

    @include('components.header-konten', [
        'label'      => 'Saved Items',
        'titleWords' => ['BOOKMARK'],
        'subtitle1'  => 'Temukan',
        'highlight1' => 'Tersimpan,',
        'subtitle2'  => 'Lihat',
        'highlight2' => 'Kembali'
    ])

    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-16 pb-32">

        <div class="mb-10 flex flex-col md:flex-row justify-between items-end gap-6 relative z-10">
            <div data-aos="fade-right">
                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Saved Items
                </p>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Item
                    <span class="relative inline-block">
                        Tersimpan
                        <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                    </span>
                </h2>
                <p class="text-sm md:text-base text-[#898383] mt-3">Kumpulan lomba, seminar, dan beasiswa yang telah Anda tandai untuk dilihat kembali.</p>
            </div>
            
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

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 relative z-10">
            @foreach ($bookmarks as $item)
            <div class="bookmark-card h-[340px] w-full bg-[#E5E7EB] rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group cursor-pointer overflow-hidden flex flex-col justify-end border border-gray-100"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index * 70 }}">
                
                <button type="button" onclick="toggleBookmark(this, event)" class="absolute top-0 right-5 z-20 hover:scale-105 hover:-translate-y-1 transition-transform">
                    <div class="bookmark-ribbon bg-[#486284] text-white w-9 h-12 flex justify-center items-center shadow-md pb-1 transition-colors duration-300" style="clip-path: polygon(100% 0, 100% 100%, 50% 80%, 0 100%, 0 0);">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                    </div>
                </button>

                <div class="absolute inset-0 flex justify-center items-center bg-[#E5E7EB] group-hover:bg-[#D1D5DB] transition-colors duration-500 z-0">
                    <svg class="w-16 h-16 text-[#486284]/40 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                    </svg>
                </div>
                
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

        <div class="mt-20 flex items-center justify-center gap-2">
            {{-- PREV --}}
            <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            {{-- ACTIVE PAGE --}}
            <button class="w-10 h-10 rounded-full bg-[#1A2E5A] text-white text-sm font-bold shadow-lg">1</button>

            {{-- PAGE --}}
            <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">2</button>
            <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">3</button>

            {{-- DOT --}}
            <span class="px-1 text-gray-400">...</span>

            {{-- LAST --}}
            <button class="w-10 h-10 rounded-full text-[#1A2E5A] text-sm font-medium hover:bg-gray-100 transition-all duration-300">68</button>

            {{-- NEXT --}}
            <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1A2E5A] hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

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

        function toggleBookmark(btn, event) {
            event.preventDefault();
            event.stopPropagation();
            
            const ribbon = btn.querySelector('.bookmark-ribbon');
            const card = btn.closest('.bookmark-card');
            const isBookmarked = ribbon.classList.contains('bg-[#486284]');
            
            if (isBookmarked) {
                ribbon.classList.remove('bg-[#486284]', 'text-white');
                ribbon.classList.add('bg-gray-300', 'text-gray-500');
                card.classList.add('opacity-50', 'grayscale');
                showToast("Dihapus dari item tersimpan!");
            } else {
                ribbon.classList.add('bg-[#486284]', 'text-white');
                ribbon.classList.remove('bg-gray-300', 'text-gray-500');
                card.classList.remove('opacity-50', 'grayscale');
                showToast("Berhasil disimpan kembali!");
            }
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-[#486284] px-6 py-3 rounded-xl shadow-[0px_4px_16px_rgba(0,0,0,0.1)] font-semibold border border-gray-100 flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 z-[100]';
            toast.innerHTML = `
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                \${message}
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