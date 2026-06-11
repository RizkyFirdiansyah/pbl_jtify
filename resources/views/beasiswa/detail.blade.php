@php
    $informationId = $information ? $information->id : 1;
    $informationTitle = $information ? $information->title : 'Beasiswa Prestasi Mahasiswa Unggulan';
    $daysRemaining = $information ? now()->startOfDay()->diffInDays($information->deadline, false) : 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Beasiswa - {{ $informationTitle }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body class="antialiased text-[#898383] relative font-sans" style="background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%); min-height: 100vh; overflow-x: clip;">

    @include('components.navbar')

    @include('components.header-detail', [
        'title'      => 'DETAIL BEASISWA',
        'label'      => 'Explore Scholarship',
        'subtitle'   => 'Dapatkan info kriteria, persyaratan, dan cakupan beasiswa pilihan',
        'showSearch' => false
    ])

    <!-- Back Button -->
    <div class="fixed top-32 left-6 md:left-10 z-[999]">
        <button onclick="history.back()"
                class="w-[50px] h-[50px] bg-[#313B6D]/90 backdrop-blur-md hover:bg-[#313B6D] text-white rounded-full flex items-center justify-center shadow-[0_8px_30px_rgba(49,59,109,0.4)] hover:shadow-[0_15px_35px_rgba(49,59,109,0.6)] hover:scale-110 transition-all duration-300 group"
                aria-label="Kembali">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
        </button>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="fixed top-24 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-8 pb-0">

        {{-- ── Info Bar ── --}}
        <div class="w-full bg-white/90 border border-[#898383]/30 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6 relative z-10 backdrop-blur-sm" data-aos="fade-up">
            <div class="flex flex-col md:flex-row items-start md:items-center w-full justify-between gap-6 md:gap-0">

                <div class="w-full md:flex-1 flex items-center gap-4">
                    <div class="text-[#696262]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#898383]">Tanggal Rilis</div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#273266]">{{ $information && $information->approved_at ? $information->approved_at->format('d M Y') : ($information ? $information->created_at->format('d M Y') : 'tgl-bln-thn') }}</div>
                    </div>
                </div>

                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <div class="w-full md:flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M12 4L2 9L12 14L22 9L12 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 11V16C6 16 9 18 12 18C15 18 18 16 18 16V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 9V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#898383]">Pendidikan</div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#273266]">S1/D4/D3/S2</div>
                    </div>
                </div>

                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <div class="w-full md:flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#898383]">Syarat Utama</div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#273266]">syarat utama</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 md:mt-0 bg-[#FFB8B8] border border-[#DA7171] rounded-xl px-4 py-3 flex items-center gap-4 shrink-0 min-w-max">
                <div class="bg-white rounded-lg min-w-[46px] px-2 h-[42px] flex flex-col justify-center items-center shadow-sm">
                    <span class="text-[17px] font-bold text-[#1E1E1E] leading-none">{{ $daysRemaining > 0 ? 'H-' . $daysRemaining : ($daysRemaining == 0 ? 'H-0' : 'Tutup') }}</span>
                    @if($daysRemaining >= 0)
                        <span class="text-[7px] font-bold text-[#555555] uppercase mt-1 tracking-wide">Hari</span>
                    @endif
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-bold text-white tracking-widest uppercase mb-1">Tenggat Pendaftaran</span>
                    <span class="text-[19px] font-bold text-[#EE2828] leading-none">{{ $information ? $information->deadline->format('d M Y') : 'tgl-bln-thn' }}</span>
                </div>
            </div>
        </div>

        {{-- ── Info Konten Utama ── --}}
        <div class="mt-20 flex flex-col lg:flex-row gap-16 lg:gap-24 items-stretch">

            <div class="w-full lg:w-1/3 flex justify-center lg:justify-start pl-0 lg:pl-12" data-aos="fade-right">
                <div class="w-[300px] h-[400px] bg-[#DDE0E4] rounded-xl shadow-xl relative overflow-hidden group hover:-translate-y-2 transition-all duration-500 flex-shrink-0">
                    @if($information && $information->poster_path && (Storage::disk('public')->exists($information->poster_path) || file_exists(public_path('storage/' . $information->poster_path)) || file_exists(public_path($information->poster_path))))
                        <img src="{{ asset(strpos($information->poster_path, 'storage/') !== false ? $information->poster_path : 'storage/' . $information->poster_path) }}" alt="{{ $information->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE]">
                            <svg class="w-[60px] h-[60px] text-[#486284]/40 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full lg:w-2/3 flex flex-col justify-between" data-aos="fade-left" data-aos-delay="100">
                
                <div class="flex flex-col flex-1">
                    <h1 class="text-[30px] font-semibold text-[#486284] mb-6 text-center lg:text-left">{{ $informationTitle }}</h1>

                    <div class="scrollable-content text-[15px] text-[#898383] text-justify space-y-6 leading-relaxed max-h-[260px] overflow-y-auto pr-3 mb-8">
                        {!! nl2br(e($information ? $information->description : '')) !!}
                    </div>
                </div>

                {{-- ── Bar Tombol Aksi ── --}}
                <div class="flex flex-col gap-2.5 pt-4 border-t border-gray-100 md:flex-row md:items-center">

                    {{-- Baris 1 (mobile): Daftar Sekarang full width --}}
                    <button onclick="openModal()" class="btn-daftar w-full md:w-auto md:flex-1">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Daftar Sekarang
                    </button>

                    {{-- Baris 2 (mobile): Unduh Panduan + icons sejajar --}}
                    <div class="flex items-center gap-2.5 w-full md:flex-1">
                        <a href="{{ $information->guidebook_link ?? '#' }}" class="btn-panduan flex-1" target="_blank">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh Buku Panduan
                        </a>
                        <div class="flex gap-2 shrink-0">
                            <button id="btnBookmark" class="btn-icon gradient" title="Bookmark">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                            <button id="btnLike" class="btn-icon gradient" title="Suka">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── SLIDER SECTION ── --}}
        <div class="mt-32 mb-6">
            <div class="flex items-center justify-between px-2">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#486284]">Beasiswa Menarik Lainnya</h2>
                    <p class="text-sm md:text-base text-gray-500 mt-1">Temukan beasiswa lain yang mungkin cocok untuk Anda</p>
                </div>
                <a href="{{ route('beasiswa') }}" class="hidden md:flex text-sm text-gray-400 font-bold hover:text-[#3B4C7E] transition items-center gap-1">
                    Lihat semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            {{-- Slider Wrapper --}}
            <div class="mt-6 slider-wrapper flex-1" id="sliderWrapper">
                <div class="slider-track cursor-grab active:cursor-grabbing select-none" id="sliderTrack">
                    @forelse ($recommendations as $rec)
                    <div class="card-item flex-none" style="width: 260px;"
                         data-aos="fade-up"
                         data-aos-delay="{{ $loop->index * 80 }}">
                        <a href="{{ route('beasiswa.detail', ['id' => $rec->id]) }}"
                           style="height: 380px;"
                           class="card-link group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500">

                            @if($rec->poster_path && (Storage::disk('public')->exists($rec->poster_path) || file_exists(public_path('storage/' . $rec->poster_path)) || file_exists(public_path($rec->poster_path))))
                                <img src="{{ asset(strpos($rec->poster_path, 'storage/') !== false ? $rec->poster_path : 'storage/' . $rec->poster_path) }}" alt="{{ $rec->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                                    <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute bottom-0 left-0 right-0 z-10 p-4" style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">
                                <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                                    {{ $rec->title }}
                                </h3>
                                <div class="flex items-center gap-1.5 mb-3">
                                    <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-white/70 text-[11px]">{{ $rec->deadline->format('d M Y') }}</span>
                                </div>
                                <span class="inline-flex items-center gap-2 w-full justify-center bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white text-xs font-bold py-2 rounded-xl transition-all duration-300 group-hover:bg-[#3B4C7E] group-hover:border-[#3B4C7E]">
                                    Lihat Detail
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                    @empty
                    <div class="w-full text-center py-8 text-gray-400">
                        Tidak ada beasiswa menarik lainnya.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="flex items-center justify-center gap-2 mt-5" id="sliderDots"></div>
        </div>
    </main>

    {{-- ── MODAL KONFIRMASI DAFTAR ── --}}
    <div id="modalBackdrop" class="modal-backdrop" onclick="handleBackdropClick(event)">
        <div class="modal-box max-w-[480px] w-full" id="modalBox">
            <div class="modal-icon">
                <svg class="w-9 h-9 text-[#313B6D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h3 class="text-[#273266] font-bold text-xl mb-3">Konfirmasi Minat</h3>
            <p class="text-[#486284] font-medium text-sm leading-relaxed mb-3">
                Apakah Anda berminat mengikuti {{ $informationTitle }}?
            </p>
            <p class="text-[#898383] text-xs leading-relaxed mb-6">
                Dengan mendaftar minat, Anda akan mendapatkan notifikasi pengingat menjelang deadline. Data Anda akan kami gunakan untuk keperluan pendataan minat mahasiswa.
            </p>

            <div class="bg-[#F4F6FF] rounded-xl p-4 mb-6 text-left">
                <label class="flex items-start gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" id="consentCheckbox" class="mt-1 rounded border-gray-300 text-[#313B6D] focus:ring-[#313B6D] focus:ring-opacity-50">
                    <span class="text-xs text-[#486284] leading-relaxed">
                        Saya menyetujui pengolahan data pribadi saya untuk keperluan pendataan minat.
                    </span>
                </label>
            </div>

            <div class="flex gap-3 justify-center">
                <button class="modal-btn-cancel" onclick="closeModal()">Batal</button>
                <button class="modal-btn-confirm" id="btnConfirmInterest" onclick="confirmDaftar()" disabled style="opacity: 0.5; cursor: not-allowed;">Ya, Saya Berminat</button>
            </div>
        </div>
    </div>

    {{-- ── MODAL PENDAFTARAN BERHASIL ── --}}
    <div id="successModalBackdrop" class="modal-backdrop" onclick="handleSuccessBackdropClick(event)">
        <div class="modal-box max-w-[480px] w-full" id="successModalBox">
            <div class="modal-icon">
                <svg class="w-9 h-9 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h3 class="text-[#273266] font-bold text-xl mb-3">Pendaftaran Berhasil</h3>
            <p class="text-[#486284] font-medium text-sm leading-relaxed mb-3">
                Terima kasih telah menyatakan minat pada informasi ini.
            </p>
            <p class="text-[#898383] text-xs leading-relaxed mb-4">
                Silakan lanjutkan proses pendaftaran melalui link berikut:
            </p>

            <div class="bg-[#F4F6FF] rounded-xl p-4 mb-6 text-left break-all">
                <a id="successRegistrationLink" href="#" target="_blank" class="text-sm text-[#3B4C7E] font-medium hover:underline"></a>
            </div>

            <div class="flex gap-3 justify-center">
                <button class="modal-btn-cancel" onclick="closeSuccessModal()">Batal</button>
                <button class="modal-btn-confirm" id="btnOpenLink">Open Link</button>
            </div>
        </div>
    </div>

    {{-- ===========================
         FOOTER GRADIENT TRANSITION
    ============================ --}}
    <section class="relative z-0 h-24" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    {{-- ===========================
         FOOTER
    ============================ --}}
    @include('components.footer')

    <script>
        window.detailConfig = {
            isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
            informationId: {{ $informationId }},
            registrationLink: @json($information->registration_link ?? '')
        };
    </script>
    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/detail-interaction.js') }}"></script>
</body>
</html>