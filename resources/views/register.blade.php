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

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- ── MOBILE LAYOUT (hidden di md+) ── --}}
                <div class="block md:hidden px-6 py-8 space-y-3">

                    <div class="flex justify-center mb-4">
                        <div class="w-12 h-12 bg-white rounded-[13px] shadow-[0_2px_12px_rgba(0,0,0,0.10)] flex items-center justify-center shrink-0">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" stroke="#1A2E5A" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="9" cy="7" r="4" stroke="#1A2E5A" stroke-width="2"/>
                                <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="#1A2E5A" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-center text-[1.2rem] font-bold text-[#1A2E5A]">Buat Akun Baru</h1>
                    <p class="text-center text-xs text-gray-400 leading-snug pb-2">
                        Bergabung dengan JTIFY dan mulai temukan peluang terbaikmu.
                    </p>

                    {{-- Nama --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg></span>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                    </div>
                    @error('name')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror

                    {{-- Email --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                    </div>
                    @error('email')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror

                    {{-- Telepon --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                    </div>
                    @error('phone')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror

                    {{-- Password --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="password" name="password" id="pwMobile" placeholder="Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                        <button type="button" onclick="togglePassword('pwMobile','eyeM1')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]"><svg id="eyeM1" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                    </div>
                    @error('password')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror

                    {{-- Konfirmasi --}}
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="password" name="password_confirmation" id="pwcMobile" placeholder="Konfirmasi Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                        <button type="button" onclick="togglePassword('pwcMobile','eyeM2')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]"><svg id="eyeM2" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                    </div>

                    {{-- Link masuk --}}
                    <div class="flex items-center gap-3 pt-1">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400">atau</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>
                    <p class="text-center text-xs text-gray-400">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-[#3B4C7E] font-semibold hover:underline">Masuk di sini</a>
                    </p>

                    {{-- Tombol --}}
                    <button type="submit" class="w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] transition-all duration-180 hover:bg-[#2D3A61] active:scale-98">
                        Daftar Sekarang
                    </button>
                </div>

                {{-- ── DESKTOP LAYOUT (hidden di mobile) ── --}}
                <div class="hidden md:flex gap-0">

                    {{-- Kolom kiri --}}
                    <div class="flex flex-col justify-between px-8 py-9 w-[42%] flex-shrink-0">
                        <div>
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
                                Bergabung dengan JTIFY dan mulai<br>temukan peluang terbaikmu.
                            </p>
                            <div class="mb-3 last:mb-0">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg></span>
                                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                @error('name')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3 last:mb-0">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                @error('email')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
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

                    {{-- Divider vertikal --}}
                    <div class="w-px bg-[#b4bed2]/35 self-stretch shrink-0 my-8"></div>

                    {{-- Kolom kanan --}}
                    <div class="flex flex-col justify-between flex-1 px-8 py-9">
                        <div class="pt-[4.5rem]">
                            <div class="mb-3 last:mb-0">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required class="w-full pl-[38px] pr-3 py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                </div>
                                @error('phone')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3 last:mb-0">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="password" name="password" id="passwordInput" placeholder="Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                    <button type="button" onclick="togglePassword('passwordInput','eye1')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]"><svg id="eye1" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                                @error('password')<p class="text-[11px] text-red-500 mt-0.5">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3 last:mb-0">
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 flex pointer-events-none"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="password" name="password_confirmation" id="passConfirm" placeholder="Konfirmasi Kata Sandi" required class="w-full pl-[38px] pr-[40px] py-[11px] border border-gray-200 rounded-xl bg-white/70 text-[13px] text-gray-700 placeholder-gray-400 transition-all duration-180 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"/>
                                    <button type="button" onclick="togglePassword('passConfirm','eye2')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 bg-transparent border-none cursor-pointer p-0 flex transition-colors duration-150 hover:text-[#3B4C7E]"><svg id="eye2" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] mt-2 transition-all duration-180 hover:bg-[#2D3A61] active:scale-98">
                            Daftar Sekarang
                        </button>
                    </div>

                </div>{{-- end desktop --}}

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
    </script>

</body>
</html>