<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Daftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }

        .bg-login {
            background-image: url('{{ asset("assets/bg-login.svg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.85);
        }

        .input-field {
            width: 100%;
            padding: 11px 12px 11px 38px;
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            background: rgba(255,255,255,0.70);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: #374151;
            transition: border-color 0.18s, box-shadow 0.18s;
        }
        .input-field:focus {
            outline: none;
            border-color: #3B4C7E;
            box-shadow: 0 0 0 3px rgba(59, 76, 126, 0.12);
        }
        .input-field::placeholder { color: #9CA3AF; }
        .input-field-pr { padding-right: 40px; }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            display: flex;
            pointer-events: none;
        }
        .input-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            transition: color 0.15s;
        }
        .input-eye:hover { color: #3B4C7E; }

        .btn-login { transition: background 0.18s, transform 0.12s; }
        .btn-login:hover  { background: #2D3A61; }
        .btn-login:active { transform: scale(0.98); }

        .icon-box {
            width: 48px; height: 48px;
            background: #fff;
            border-radius: 13px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .btn-back {
            width: 44px; height: 44px;
            background: #486284;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(72,98,132,0.35);
            transition: background 0.2s, transform 0.15s;
        }
        .btn-back:hover  { background: #3B4C7E; }
        .btn-back:active { transform: scale(0.93); }

        .col-divider {
            width: 1px;
            background: rgba(180,190,210,0.35);
            align-self: stretch;
            flex-shrink: 0;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-card { animation: fadeUp 0.55s cubic-bezier(0.34,1.2,0.64,1) forwards; }

        .field-error { font-size: 11px; color: #EF4444; margin-top: 2px; }

        /* ── INPUT WRAPPER: gap konsisten ── */
        .field { margin-bottom: 12px; }
        .field:last-child { margin-bottom: 0; }
    </style>
</head>
<body class="bg-login min-h-screen flex flex-col py-8">

    <!-- Tombol Back -->
    <div class="sticky top-5 z-50 px-8 mb-4">
        <a href="{{ url()->previous() }}" class="btn-back inline-flex" title="Kembali">
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

                {{-- ═══════════════════════════════════════
                     MOBILE: satu kolom penuh
                     DESKTOP (md+): dua kolom berdampingan
                ═══════════════════════════════════════ --}}

                {{-- ── MOBILE LAYOUT (hidden di md+) ── --}}
                <div class="block md:hidden px-6 py-8 space-y-3">

                    <div class="flex justify-center mb-4">
                        <div class="icon-box">
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
                        <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg></span>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="input-field"/>
                    </div>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror

                    {{-- Email --}}
                    <div class="relative">
                        <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="input-field"/>
                    </div>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror

                    {{-- Telepon --}}
                    <div class="relative">
                        <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required class="input-field"/>
                    </div>
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror

                    {{-- Password --}}
                    <div class="relative">
                        <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="password" name="password" id="pwMobile" placeholder="Kata Sandi" required class="input-field input-field-pr"/>
                        <button type="button" onclick="togglePassword('pwMobile','eyeM1')" class="input-eye"><svg id="eyeM1" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                    </div>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror

                    {{-- Konfirmasi --}}
                    <div class="relative">
                        <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                        <input type="password" name="password_confirmation" id="pwcMobile" placeholder="Konfirmasi Kata Sandi" required class="input-field input-field-pr"/>
                        <button type="button" onclick="togglePassword('pwcMobile','eyeM2')" class="input-eye"><svg id="eyeM2" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
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
                    <button type="submit" class="btn-login w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)]">
                        Daftar Sekarang
                    </button>
                </div>

                {{-- ── DESKTOP LAYOUT (hidden di mobile) ── --}}
                <div class="hidden md:flex gap-0">

                    {{-- Kolom kiri --}}
                    <div class="flex flex-col justify-between px-8 py-9 w-[42%] flex-shrink-0">
                        <div>
                            <div class="flex justify-center mb-4">
                                <div class="icon-box">
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
                            <div class="field">
                                <div class="relative">
                                    <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/></svg></span>
                                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required class="input-field"/>
                                </div>
                                @error('name')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <div class="relative">
                                    <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="input-field"/>
                                </div>
                                @error('email')<p class="field-error">{{ $message }}</p>@enderror
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
                    <div class="col-divider my-8"></div>

                    {{-- Kolom kanan --}}
                    <div class="flex flex-col justify-between flex-1 px-8 py-9">
                        <div class="pt-[4.5rem]">
                            <div class="field">
                                <div class="relative">
                                    <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required class="input-field"/>
                                </div>
                                @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <div class="relative">
                                    <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="password" name="password" id="passwordInput" placeholder="Kata Sandi" required class="input-field input-field-pr"/>
                                    <button type="button" onclick="togglePassword('passwordInput','eye1')" class="input-eye"><svg id="eye1" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                                @error('password')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <div class="relative">
                                    <span class="input-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/><path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                                    <input type="password" name="password_confirmation" id="passConfirm" placeholder="Konfirmasi Kata Sandi" required class="input-field input-field-pr"/>
                                    <button type="button" onclick="togglePassword('passConfirm','eye2')" class="input-eye"><svg id="eye2" width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-login w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] mt-2">
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