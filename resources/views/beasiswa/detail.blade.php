@php
    $information = \App\Models\Information::whereHas('category', fn($q) => $q->where('slug', 'beasiswa'))->first();
    $informationId = $information ? $information->id : 1;
    $informationTitle = $information ? $information->title : 'Beasiswa Prestasi Mahasiswa Unggulan';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Beasiswa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body class="antialiased text-[#898383] relative font-sans" style="background: linear-gradient(179.9deg, #FFFFFF 73.43%, rgba(0, 125, 251, 0.05) 99.91%); min-height: 100vh; overflow-x: clip;">

    @include('components.navbar')

    @include('components.header-konten', [
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

    <main class="max-w-[1440px] mx-auto px-6 lg:px-20 pt-8 pb-32">

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
                        <div class="text-[16px] md:text-[19px] font-medium text-[#898383]">Tanggal</div>
                        <div class="text-[16px] md:text-[19px] font-medium text-[#273266]">tgl-bln-thn</div>
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
                        <a href="#" class="btn-panduan flex-1">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh Buku Panduan
                        </a>
                        <div class="flex gap-2 shrink-0">
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
        const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
        const informationId = {{ $informationId }};
        let hasRegisteredInterest = false;

        async function checkInterestStatus() {
            if (!isLoggedIn) return;
            try {
                const response = await fetch(`/api/interests/check?information_id=${informationId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const result = await response.json();
                if (result.is_active) {
                    hasRegisteredInterest = true;
                }
            } catch (err) {
                console.error('Error checking interest status:', err);
            }
        }

        // Show toast notification helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification pointer-events-auto bg-white border border-gray-150 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-2xl p-4 flex items-center gap-3.5 max-w-sm';
            toast.style.transform = 'translateX(120%)';
            toast.style.transition = 'transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease';
            
            let iconMarkup = '';
            if (type === 'success') {
                iconMarkup = `
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>`;
            } else if (type === 'warning') {
                iconMarkup = `
                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>`;
            } else {
                iconMarkup = `
                    <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center text-rose-500 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>`;
            }

            toast.innerHTML = `
                ${iconMarkup}
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-700">${message}</p>
                </div>
            `;

            container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 50);
            
            // Auto dismiss
            setTimeout(() => {
                toast.style.transform = 'translateX(120%)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        }

        function openModal() {
            if (!isLoggedIn) {
                showToast('Silakan login terlebih dahulu untuk menyatakan minat.', 'error');
                return;
            }

            if (hasRegisteredInterest) {
                showToast('Anda sudah menyatakan minat pada item ini', 'warning');
                return;
            }

            document.getElementById('modalBackdrop').classList.add('open');
            document.body.style.overflow = 'hidden';
            
            // Reset checkbox state
            const consentCheckbox = document.getElementById('consentCheckbox');
            const btnConfirmInterest = document.getElementById('btnConfirmInterest');
            if (consentCheckbox && btnConfirmInterest) {
                consentCheckbox.checked = false;
                btnConfirmInterest.disabled = true;
                btnConfirmInterest.style.opacity = '0.5';
                btnConfirmInterest.style.cursor = 'not-allowed';
            }
        }

        function closeModal() {
            document.getElementById('modalBackdrop').classList.remove('open');
            document.body.style.overflow = '';
        }

        function handleBackdropClick(e) {
            if (e.target === document.getElementById('modalBackdrop')) closeModal();
        }

        async function confirmDaftar() {
            const consentCheckbox = document.getElementById('consentCheckbox');
            if (!consentCheckbox || !consentCheckbox.checked) return;

            const btnConfirmInterest = document.getElementById('btnConfirmInterest');
            btnConfirmInterest.disabled = true;
            btnConfirmInterest.innerText = 'Mengirim...';

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/api/interests/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        information_id: informationId,
                        consented: true
                    })
                });

                const result = await response.json();

                if (response.ok && result.is_active) {
                    hasRegisteredInterest = true;
                    showToast('Minat Anda telah tercatat!', 'success');
                } else {
                    showToast(result.message || 'Terjadi kesalahan.', 'error');
                }
            } catch (err) {
                showToast('Terjadi kesalahan koneksi.', 'error');
                console.error(err);
            } finally {
                btnConfirmInterest.disabled = false;
                btnConfirmInterest.innerText = 'Ya, Saya Berminat';
                closeModal();
            }
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        // Checkbox event listener
        document.addEventListener('DOMContentLoaded', () => {
            checkInterestStatus();

            const consentCheckbox = document.getElementById('consentCheckbox');
            const btnConfirmInterest = document.getElementById('btnConfirmInterest');
            if (consentCheckbox && btnConfirmInterest) {
                consentCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        btnConfirmInterest.disabled = false;
                        btnConfirmInterest.style.opacity = '1';
                        btnConfirmInterest.style.cursor = 'pointer';
                    } else {
                        btnConfirmInterest.disabled = true;
                        btnConfirmInterest.style.opacity = '0.5';
                        btnConfirmInterest.style.cursor = 'not-allowed';
                    }
                });
            }
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