<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col py-8 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset("assets/bg-login.svg") }}');">

    <!-- Tombol Back -->
    <div class="sticky top-5 z-50 px-8 mb-4">
        <a href="{{ url()->previous() }}" class="w-11 h-11 bg-[#486284] rounded-full flex items-center justify-center shadow-[0_4px_14px_rgba(72,98,132,0.35)] transition-all duration-200 hover:bg-[#3B4C7E] active:scale-[0.93] inline-flex" title="Kembali">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M15 19l-7-7 7-7" stroke="white" stroke-width="2.5"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <div class="flex-1 flex items-center justify-center px-4 pb-4">
        <div class="card-glass rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.10)] w-full anim-card" style="max-width:760px;">

            <!-- Toast Container -->
            <div id="toastContainer" class="fixed top-5 right-5 z-[9999] space-y-3"></div>

            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="flex flex-col md:flex-row gap-0">
                    
                    {{-- Kolom Kiri: Header Info, Name, Email, "atau" (Desktop Only) --}}
                    <div class="flex flex-col justify-between px-6 pt-8 pb-4 md:px-8 md:py-9 w-full md:w-[42%] shrink-0">
                        <div>
                            {{-- Header (Mobile & Desktop) --}}
                            <div class="flex justify-center mb-4">
                                <div class="w-12 h-12 bg-white rounded-[13px] shadow-[0_2px_12px_rgba(0,0,0,0.10)] flex items-center justify-center shrink-0">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" stroke="#1A2E5A" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="9" cy="7" r="4" stroke="#1A2E5A" stroke-width="2"/>
                                        <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="#1A2E5A" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                            <h1 class="text-center text-[1.2rem] font-bold text-[#1A2E5A] mb-1">Buat Akun Baru</h1>
                            <p class="text-center text-xs text-gray-400 mb-6 leading-snug">
                                Bergabung dengan JTIFY dan mulai<br class="hidden md:block">temukan peluang terbaikmu.
                            </p>

                            {{-- Field: Nama Lengkap --}}
                            <div class="mb-3">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg>
                                    </span>
                                    <input type="text" name="name" id="nameInput" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                <p class="text-[11px] text-red-500 mt-0.5 hidden error-msg" id="error_name"></p>
                            </div>

                            {{-- Field: Email --}}
                            <div class="mb-3">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                    </span>
                                    <input type="email" name="email" id="emailInput" placeholder="Email" value="{{ old('email') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                <p class="text-[11px] text-red-500 mt-0.5 hidden error-msg" id="error_email"></p>
                            </div>
                        </div>

                        {{-- Desktop Only Link Masuk --}}
                        <div class="hidden md:block">
                            <div class="flex items-center gap-3 my-4">
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <span class="text-xs text-gray-400">atau</span>
                                <div class="flex-1 h-px bg-gray-200"></div>
                            </div>
                            <p class="text-center text-xs text-gray-400">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-[#3B4C7E] font-semibold hover:underline">Masuk di sini</a>
                            </p>
                        </div>
                    </div>

                    {{-- Divider Vertikal (Desktop Only) --}}
                    <div class="hidden md:block w-px bg-[#b4bed2]/35 self-stretch shrink-0 my-8"></div>

                    {{-- Kolom Kanan: Phone, Password, Password Confirmation, "atau" (Mobile Only), Submit Button --}}
                    <div class="flex flex-col justify-between flex-1 px-6 pb-8 pt-2 md:px-8 md:py-9">
                        <div class="md:pt-[4.5rem]">
                            {{-- Field: Telepon --}}
                            <div class="mb-3">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                    </span>
                                    <input type="tel" name="phone" id="phoneInput" placeholder="Nomor Telepon" value="{{ old('phone') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                <p class="text-[11px] text-red-500 mt-0.5 hidden error-msg" id="error_phone"></p>
                            </div>

                            {{-- Field: Kata Sandi --}}
                            <div class="mb-3">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                    </span>
                                    <input type="password" name="password" id="passwordInput" placeholder="Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                    <button type="button" onclick="togglePassword('passwordInput','eyePassword')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]">
                                        <svg id="eyePassword" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                    </button>
                                </div>
                                <p class="text-[11px] text-red-500 mt-0.5 hidden error-msg" id="error_password"></p>
                            </div>

                            {{-- Field: Konfirmasi Kata Sandi --}}
                            <div class="mb-3">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                    </span>
                                    <input type="password" name="password_confirmation" id="passwordConfirmInput" placeholder="Konfirmasi Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                    <button type="button" onclick="togglePassword('passwordConfirmInput','eyePasswordConfirm')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]">
                                        <svg id="eyePasswordConfirm" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Mobile Only Link Masuk --}}
                        <div class="block md:hidden">
                            <div class="flex items-center gap-3 my-4">
                                <div class="flex-1 h-px bg-gray-200"></div>
                                <span class="text-xs text-gray-400">atau</span>
                                <div class="flex-1 h-px bg-gray-200"></div>
                            </div>
                            <p class="text-center text-xs text-gray-400 mb-4">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-[#3B4C7E] font-semibold hover:underline">Masuk di sini</a>
                            </p>
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit" id="submitBtn" class="w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] transition-all duration-180 hover:bg-[#2D3A61] active:scale-98 flex items-center justify-center gap-2">
                            <span>Daftar Sekarang</span>
                            <svg id="spinner" class="animate-spin h-4 w-4 text-white hidden" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>`;
            } else {
                input.type = 'password';
                icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>`;
            }
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `flex items-center gap-3 px-4 py-3.5 rounded-2xl shadow-lg border text-sm font-semibold max-w-sm bg-white transition-all duration-300 transform translate-x-80 opacity-0`;
            
            let iconColor, bgColor, borderColor, textColor;
            if (type === 'success') {
                iconColor = 'text-emerald-500';
                bgColor = 'bg-emerald-50';
                borderColor = 'border-emerald-100';
                textColor = 'text-emerald-800';
            } else if (type === 'error') {
                iconColor = 'text-rose-500';
                bgColor = 'bg-rose-50';
                borderColor = 'border-rose-100';
                textColor = 'text-rose-800';
            } else {
                iconColor = 'text-amber-500';
                bgColor = 'bg-amber-50';
                borderColor = 'border-amber-100';
                textColor = 'text-amber-800';
            }
            
            toast.classList.add(bgColor, borderColor, textColor);
            
            let iconSvg = '';
            if (type === 'success') {
                iconSvg = `<svg class="w-5 h-5 ${iconColor} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
            } else {
                iconSvg = `<svg class="w-5 h-5 ${iconColor} shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`;
            }
            
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0">
                    ${iconSvg}
                </div>
                <div class="flex-1">${message}</div>
            `;
            
            container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => {
                toast.classList.remove('translate-x-80', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 10);
            
            // Hide and remove
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-80', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const spinner = document.getElementById('spinner');
            
            // Clear previous errors
            document.querySelectorAll('.error-msg').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });
            
            // State: loading
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                return response.json().then(data => ({
                    status: response.status,
                    ok: response.ok,
                    body: data
                }));
            })
            .then(res => {
                if (res.ok) {
                    showToast('Registrasi berhasil. Silakan login untuk melanjutkan.', 'success');
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1500);
                } else if (res.status === 422) {
                    showToast('Registrasi gagal. Periksa kembali data yang Anda masukkan.', 'error');
                    const errors = res.body.errors || {};
                    for (const key in errors) {
                        const errorMsgEl = document.getElementById(`error_${key}`);
                        if (errorMsgEl) {
                            errorMsgEl.textContent = errors[key][0];
                            errorMsgEl.classList.remove('hidden');
                        }
                    }
                } else {
                    showToast(res.body.message || 'Terjadi kesalahan pada server. Silakan coba lagi.', 'error');
                }
            })
            .catch(error => {
                console.error('Error during registration:', error);
                showToast('Koneksi internet bermasalah. Gagal mendaftar.', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
            });
        });
    </script>

</body>
</html>