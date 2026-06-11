<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Disukai</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Poppins & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="antialiased text-[#898383] relative overflow-x-hidden font-sans" style="background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%); min-height: 100vh;">

    <!-- NAVBAR COMPONENT -->
    @include('components.navbar')

    <!-- HEADER COMPONENT -->
    @include('components.header-konten', [
        'title' => 'DISUKAI',
        'subtitle' => 'Item Disukai'
    ])

    <!-- MAIN CONTENT -->
    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-16 pb-0">

        <!-- Section Title & Improvisasi -->
        <div class="mb-10 flex flex-col md:flex-row justify-between items-end gap-6 relative z-10">
            <div data-aos="fade-right">
                <p class="uppercase tracking-[0.25em] text-xs font-bold text-[#8FA9C0] mb-3">
                    Liked Items
                </p>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#1A2E5A] leading-tight">
                    Item
                    <span class="relative inline-block">
                        Disukai
                        <span class="absolute left-0 bottom-1 w-full h-3 bg-[#DDEBFF] -z-10 rounded-sm"></span>
                    </span>
                </h2>
                <p class="text-sm md:text-base text-[#898383] mt-3">Daftar lomba, seminar, dan beasiswa yang telah Anda sukai.</p>
            </div>
            
            <!-- Improvisation: Filter/Sort Dropdown -->
            <div class="flex items-center gap-3" data-aos="fade-left">
                <span class="text-sm font-medium text-[#696262]">Kategori:</span>
                <select id="peminatan-category-filter" class="px-5 py-2.5 rounded-full border border-gray-200 bg-white text-[#486284] font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-[#85A8F8] transition-all hover:border-[#85A8F8] cursor-pointer">
                    <option value="Semua Kategori">Semua Kategori</option>
                    <option value="Lomba">Lomba</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Beasiswa">Beasiswa</option>
                </select>
            </div>
        </div>

        <!-- Grid Cards -->
        <div id="peminatan-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 relative z-10">
            @foreach ($bookmarks as $item)
            <!-- Card -->
            <div class="like-card h-[340px] w-full bg-[#E5E7EB] rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 relative group cursor-pointer overflow-hidden flex flex-col justify-end border border-gray-100"
                 data-info-id="{{ $item->information_id }}"
                 data-category="{{ $item->category }}"
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

                <!-- Center Placeholder Icon / Dynamic Poster -->
                <div class="absolute inset-0 z-0">
                    @if(!empty($item->poster_path) && (\Illuminate\Support\Facades\Storage::disk('public')->exists($item->poster_path) || file_exists(public_path('storage/' . $item->poster_path))))
                        <img src="{{ asset('storage/' . $item->poster_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#273266]/60 via-transparent to-transparent"></div>
                    @else
                        <div class="flex justify-center items-center bg-[#E5E7EB] group-hover:bg-[#D1D5DB] transition-colors duration-500 w-full h-full">
                            <svg class="w-16 h-16 text-[#486284]/40 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                            </svg>
                        </div>
                    @endif
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

            {{ $bookmarks->links('components.pagination') }}

        </div>
    </section>
    
    </main>

    {{-- ================================
         FOOTER TRANSITION
    ================================= --}}
    <section class="relative z-0 h-24" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    {{-- ================================
         FOOTER
    ================================= --}}
    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/peminatan-list-interaction.js') }}"></script>
</body>
</html>
