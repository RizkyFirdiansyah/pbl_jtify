<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Beasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%);
            min-height: 100vh;
        }

        .bg-btn-gradient {
            background: linear-gradient(123.03deg, #606EB2 11.1%, #313B6D 56.83%);
        }

        /* Custom Scrollbar untuk Box Deskripsi */
        .scrollable-content::-webkit-scrollbar {
            width: 6px;
        }
        .scrollable-content::-webkit-scrollbar-track {
            background: #F4F6FF;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        .scrollable-content::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* ── Slider ── */
        .slider-track {
            display: flex;
            gap: 1.5rem;
            padding: 0.5rem 0.5rem 1.5rem;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        .slider-wrapper {
            overflow: hidden;
            position: relative;
        }

        /* Dot indicators */
        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #DDE0E4;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .slider-dot.active {
            background: #313B6D;
            width: 24px;
            border-radius: 4px;
        }

        /* ── Modal ── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            padding: 1rem;
        }

        .modal-backdrop.open {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            background: white;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            max-width: 420px;
            width: 100%;
            transform: translateY(24px) scale(0.96);
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.18);
            text-align: center;
        }

        .modal-backdrop.open .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #EEF1FF 0%, #D8DCF5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
        }

        .modal-btn-confirm {
            background: linear-gradient(123.03deg, #606EB2 11.1%, #313B6D 56.83%);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(49, 59, 109, 0.35);
            font-family: 'Poppins', sans-serif;
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(49, 59, 109, 0.45);
        }

        .modal-btn-cancel {
            background: transparent;
            color: #898383;
            border: 1.5px solid #DDE0E4;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }

        .modal-btn-cancel:hover {
            background: #f5f5f5;
            border-color: #c0c0c0;
        }

        /* ── Action Buttons ── */
        .btn-daftar {
            background: linear-gradient(123.03deg, #606EB2 11.1%, #313B6D 56.83%);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 18px rgba(49, 59, 109, 0.35);
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }

        .btn-daftar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(49, 59, 109, 0.45);
        }

        .btn-daftar:active {
            transform: scale(0.97);
        }

        .btn-panduan {
            background: white;
            color: #313B6D;
            border: 2px solid #606EB2;
            padding: 0.85rem 1.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(96, 110, 178, 0.15);
        }

        .btn-panduan:hover {
            background: #EEF1FF;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(96, 110, 178, 0.25);
        }

        .btn-panduan:active {
            transform: scale(0.97);
        }

        /* icon action buttons */
        .btn-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
        }

        .btn-icon:hover {
            transform: scale(1.12);
        }

        .btn-icon.gradient {
            background: linear-gradient(123.03deg, #606EB2 11.1%, #313B6D 56.83%);
            color: white;
            box-shadow: 0 4px 12px rgba(49, 59, 109, 0.3);
        }
    </style>
</head>
<body class="antialiased text-[#898383] relative" style="overflow-x: clip;">

    @include('components.navbar')

    @include('components.header-konten', [
        'title'      => 'DETAIL BEASISWA',
        'label'      => 'Explore Scholarship',
        'subtitle'   => 'Dapatkan info kriteria, persyaratan, dan cakupan beasiswa pilihan',
        'showSearch' => false
    ])

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

    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-8 pb-32">

        {{-- ── Info Bar ── --}}
        <div class="w-full bg-white/90 border border-[#898383]/30 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6 relative z-10 backdrop-blur-sm" data-aos="fade-up">
            <div class="flex flex-wrap md:flex-nowrap items-center w-full justify-between gap-6 md:gap-0">

                <div class="flex-1 flex items-center gap-4">
                    <div class="text-[#696262]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 2V6M8 2V6M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383]">Tanggal</div>
                        <div class="text-[19px] font-medium text-[#273266]">tgl-bln-thn</div>
                    </div>
                </div>

                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <div class="flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M12 4L2 9L12 14L22 9L12 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6 11V16C6 16 9 18 12 18C15 18 18 16 18 16V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 9V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383]">Pendidikan</div>
                        <div class="text-[19px] font-medium text-[#273266]">S1/D4/D3/S2</div>
                    </div>
                </div>

                <div class="hidden md:block w-[1px] h-12 bg-[#DDE0E4]"></div>

                <div class="flex-1 flex items-center gap-4 md:pl-4 lg:pl-8">
                    <div class="text-[#555555]">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none">
                            <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-[19px] font-medium text-[#898383]">Syarat Utama</div>
                        <div class="text-[19px] font-medium text-[#273266]">syarat utama</div>
                    </div>
                </div>
            </div>

            <div class="mt-6 md:mt-0 bg-[#FFB8B8] border border-[#DA7171] rounded-xl px-4 py-3 flex items-center gap-4 shrink-0 min-w-max">
                <div class="bg-white rounded-lg w-[42px] h-[42px] flex flex-col justify-center items-center shadow-sm">
                    <span class="text-[19px] font-medium text-[#1E1E1E] leading-none">H-X</span>
                    <span class="text-[7px] font-bold text-[#555555] uppercase mt-1 tracking-wide">Hari</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-bold text-white tracking-widest uppercase mb-1">Tenggat Pendaftaran</span>
                    <span class="text-[19px] font-bold text-[#EE2828] leading-none">tgl-bln-thn</span>
                </div>
            </div>
        </div>

        {{-- ── Info Konten Utama ── --}}
        <div class="mt-20 flex flex-col lg:flex-row gap-16 lg:gap-24 items-stretch">

            <div class="w-full lg:w-1/3 flex justify-center lg:justify-start pl-0 lg:pl-12" data-aos="fade-right">
                <div class="w-[300px] h-[400px] bg-[#DDE0E4] rounded-xl shadow-xl relative overflow-hidden group hover:-translate-y-2 transition-transform duration-300 flex-shrink-0">
                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE]">
                        <svg class="w-[60px] h-[60px] text-[#486284]/40 group-hover:scale-110 transition-transform duration-300" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 flex flex-col justify-between" data-aos="fade-left" data-aos-delay="100">
                
                <div class="flex flex-col flex-1">
                    <h1 class="text-[30px] font-semibold text-[#486284] mb-6 text-center lg:text-left">Deskripsi Beasiswa</h1>

                    <div class="scrollable-content text-[15px] text-[#898383] text-justify space-y-6 leading-relaxed max-h-[260px] overflow-y-auto pr-3 mb-8">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                    </div>
                </div>

                {{-- ── Bar Tombol Aksi (Melebar Pas Sejajar Sesuai Batas Atas) ── --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-6 pt-4 border-t border-gray-100">

                    <div class="flex-1 flex flex-col sm:flex-row items-stretch gap-3">
                        <button onclick="openModal()" class="btn-daftar flex-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Daftar Sekarang
                        </button>

                        <a href="#" class="btn-panduan flex-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh Buku Panduan
                        </a>
                    </div>

                    <div class="flex gap-2 justify-center sm:justify-end shrink-0">
                        <button class="btn-icon gradient" title="Bookmark">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                        <button class="btn-icon gradient" title="Suka">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                        <button class="btn-icon gradient" title="Bagikan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                        </button>
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
                <a href="{{ route('beasiswa') }}" class="hidden md:flex text-[#007DFB] font-medium hover:underline items-center gap-1 text-sm">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- Slider Wrapper --}}
            <div class="mt-6 slider-wrapper flex-1" id="sliderWrapper">
                <div class="slider-track cursor-grab active:cursor-grabbing select-none" id="sliderTrack">
                    @for ($i = 1; $i <= 6; $i++)
                    <div class="card-item flex-none" style="width: 260px;">
                        <a href="{{ route('beasiswa.detail') }}"
                           style="height: 380px;"
                           class="card-link group relative block rounded-2xl overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500"
                           data-aos="fade-up"
                           data-aos-delay="{{ ($i - 1) * 80 }}">

                            <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE] group-hover:from-[#D0DCEE] group-hover:to-[#BBC9E0] transition-colors duration-500">
                                <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                                </svg>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 z-10 p-4" style="background: linear-gradient(to top, rgba(26,46,90,0.95) 0%, rgba(26,46,90,0.5) 70%, transparent 100%);">
                                <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                                    Beasiswa Menarik {{ $i }}
                                </h3>
                                <div class="flex items-center gap-1.5 mb-3">
                                    <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-white/70 text-[11px]">Segera Hadir</span>
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
                    @endfor
                </div>
            </div>

            <div class="flex items-center justify-center gap-2 mt-5" id="sliderDots"></div>
        </div>
    </main>

    {{-- ── MODAL KONFIRMASI DAFTAR ── --}}
    <div id="modalBackdrop" class="modal-backdrop" onclick="handleBackdropClick(event)">
        <div class="modal-box" id="modalBox">
            <div class="modal-icon">
                <svg class="w-9 h-9 text-[#313B6D]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <h3 class="text-[#273266] font-bold text-xl mb-2">Yakin ingin mendaftar?</h3>
            <p class="text-[#898383] text-sm leading-relaxed mb-8">
                Pastikan kamu sudah membaca seluruh persyaratan dan siap untuk mengikuti proses pendaftaran beasiswa ini.
            </p>

            <div class="bg-[#F4F6FF] rounded-xl p-4 mb-8 text-left space-y-2">
                <div class="flex items-center gap-2 text-sm text-[#486284]">
                    <svg class="w-4 h-4 text-[#606EB2] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Saya sudah membaca persyaratan
                </div>
                <div class="flex items-center gap-2 text-sm text-[#486284]">
                    <svg class="w-4 h-4 text-[#606EB2] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Saya memenuhi kriteria yang ditentukan
                </div>
                <div class="flex items-center gap-2 text-sm text-[#486284]">
                    <svg class="w-4 h-4 text-[#606EB2] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Saya siap melanjutkan proses pendaftaran
                </div>
            </div>

            <div class="flex gap-3 justify-center">
                <button class="modal-btn-cancel" onclick="closeModal()">Batal</button>
                <button class="modal-btn-confirm" onclick="confirmDaftar()">Ya, Daftar Sekarang</button>
            </div>
        </div>
    </div>

    {{-- ===========================
         FOOTER GRADIENT TRANSITION
    ============================ --}}
    <div class="h-32 sm:h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></div>

    {{-- ===========================
         FOOTER
    ============================ --}}
    @include('components.footer')

    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 900,
            once: false,
            mirror: true,
            easing: 'ease-out-cubic',
        });
        /* ════════════════════════════════
           MODAL
        ════════════════════════════════ */
        function openModal() {
            document.getElementById('modalBackdrop').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalBackdrop').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleBackdropClick(e) {
            if (e.target === document.getElementById('modalBackdrop')) closeModal();
        }

        function confirmDaftar() {
            closeModal();
            window.open('#', '_blank');
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        /* ════════════════════════════════
           SLIDER — Infinite Loop Continuous
        ════════════════════════════════ */
        (function () {
            const track = document.getElementById('sliderTrack');
            const wrapper = document.getElementById('sliderWrapper');
            const dotsWrapper = document.getElementById('sliderDots');

            const CARD_WIDTH = 260;
            const GAP = 24; 
            const STEP = CARD_WIDTH + GAP;

            const cards = track.querySelectorAll('.card-item');
            const totalCards = cards.length;

            let currentIndex = 0;
            let autoSlideInterval;

            function visibleCount() {
                if (window.innerWidth <= 480) return 1;
                if (window.innerWidth <= 768) return 2;
                if (window.innerWidth <= 1024) return 3;
                return Math.max(1, Math.floor((wrapper.offsetWidth + GAP) / STEP));
            }

            // Membatasi indeks pergeseran agar ujung kanan trek slider tidak kosong
            function maxIndex() {
                return Math.max(0, totalCards - visibleCount());
            }

            function buildDots() {
                dotsWrapper.innerHTML = '';
                const count = maxIndex() + 1;
                
                if (count <= 1) return;

                for (let i = 0; i < count; i++) {
                    const dot = document.createElement('button');
                    dot.className = 'slider-dot' + (i === currentIndex ? ' active' : '');
                    dot.setAttribute('aria-label', `Slide ${i + 1}`);
                    dot.addEventListener('click', () => {
                        clearInterval(autoSlideInterval);
                        goTo(i);
                        startAutoSlide();
                    });
                    dotsWrapper.appendChild(dot);
                }
            }

            function updateDots() {
                dotsWrapper.querySelectorAll('.slider-dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentIndex);
                });
            }

            function goTo(index) {
                const max = maxIndex();
                
                if (index > max) {
                    index = 0;
                } else if (index < 0) {
                    index = max;
                }
                
                currentIndex = index;
                track.style.transform = `translateX(-${currentIndex * STEP}px)`;
                updateDots();
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    let next = currentIndex + 1;
                    if (next > maxIndex()) {
                        next = 0;
                    }
                    goTo(next);
                }, 2500);
            }

            buildDots();
            goTo(0);
            startAutoSlide();

            track.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
            track.addEventListener('mouseleave', () => startAutoSlide());

            cards.forEach(card => {
                card.addEventListener('click', () => clearInterval(autoSlideInterval));
            });

            window.addEventListener('resize', () => {
                clearInterval(autoSlideInterval);
                buildDots();
                goTo(Math.min(currentIndex, maxIndex()));
                startAutoSlide();
            });

            // DRAG & SWIPE LOGIC
            let isDragging = false;
            let startX = 0;
            let dragDistance = 0;

            track.addEventListener('mousedown', (e) => {
                isDragging = true;
                startX = e.clientX;
                dragDistance = 0;
                track.style.transition = 'none';
                clearInterval(autoSlideInterval);
            });

            document.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                dragDistance = e.clientX - startX;
                const baseOffset = currentIndex * STEP;
                track.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
            });

            document.addEventListener('mouseup', () => {
                if (!isDragging) return;
                isDragging = false;
                track.style.transition = 'transform 700ms cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                
                if (dragDistance < -60) goTo(currentIndex + 1);
                else if (dragDistance > 60) goTo(currentIndex - 1);
                else goTo(currentIndex);
                
                startAutoSlide();
            });

            track.addEventListener('click', (e) => {
                if (Math.abs(dragDistance) > 10) e.preventDefault();
            }, true);

            track.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                dragDistance = 0;
                track.style.transition = 'none';
                clearInterval(autoSlideInterval);
            }, { passive: true });

            track.addEventListener('touchmove', (e) => {
                dragDistance = e.touches[0].clientX - startX;
                const baseOffset = currentIndex * STEP;
                track.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
            }, { passive: true });

            track.addEventListener('touchend', () => {
                track.style.transition = 'transform 700ms cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                if (dragDistance < -60) goTo(currentIndex + 1);
                else if (dragDistance > 60) goTo(currentIndex - 1);
                else goTo(currentIndex);
                
                startAutoSlide();
            });
        })();
    </script>
</body>
</html>