<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* ── Background: ganti src di bawah dengan file SVG awan kamu ── */
        .bg-login {
            background-image: url('{{ asset("assets/bg-login.svg") }}');
            background-size: cover;       /* 100% width & height */
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Card glass */
        .card-glass {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.85);
        }

        /* Input focus ring */
        .input-field:focus {
            outline: none;
            border-color: #3B4C7E;
            box-shadow: 0 0 0 3px rgba(59, 76, 126, 0.12);
        }

        /* Button hover */
        .btn-login:hover { background: #2D3A61; }
        .btn-login:active { transform: scale(0.98); }

        /* Icon wrapper */
        .icon-box {
            width: 52px; height: 52px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.10);
            display: flex; align-items: center; justify-content: center;
        }

        /* Back button */
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

        /* Fade-in card */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-card { animation: fadeUp 0.55s cubic-bezier(0.34,1.2,0.64,1) forwards; }
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

    <!-- Center form -->
    <div class="flex-1 flex items-center justify-center px-4 pb-4">

        <div class="card-glass rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.10)] w-full max-w-sm px-8 py-10 anim-card">

            <!-- Icon -->
            <div class="flex justify-center mb-5">
                <div class="icon-box">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"
                              stroke="#1A2E5A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

            <!-- Judul -->
            <h1 class="text-center text-xl font-bold text-[#1A2E5A] mb-1">Masuk ke Akun</h1>
            <p class="text-center text-sm text-gray-400 mb-7 leading-snug">
                Temukan peluang terbaik bersama JTIFY.<br>Gratis untuk semua mahasiswa.
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M22 6l-10 7L2 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        value="{{ old('email') }}"
                        class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white/70 text-sm text-gray-700 placeholder-gray-400 transition-all duration-200"
                    />
                </div>

                <!-- Password -->
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        placeholder="Kata Sandi"
                        required
                        class="input-field w-full pl-10 pr-11 py-3 rounded-xl border border-gray-200 bg-white/70 text-sm text-gray-700 placeholder-gray-400 transition-all duration-200"
                    />
                    <!-- Toggle show/hide password -->
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </button>
                </div>

                <!-- Error message -->
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Lupa kata sandi -->
                <div class="flex justify-end -mt-1">
                    <a href="#" class="text-xs text-[#3B4C7E] hover:underline font-medium">
                        Lupa kata sandi?
                    </a>
                </div>
                
                <!-- Tombol Masuk -->
                <button type="submit"
                    class="btn-login w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] transition-all duration-200 mt-2">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs text-gray-400">atau</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            <!-- Link daftar -->
            <p class="text-center text-xs text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[#3B4C7E] font-semibold hover:underline">Daftar sekarang</a>
            </p>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                `;
            }
        }
    </script>

</body>
</html>