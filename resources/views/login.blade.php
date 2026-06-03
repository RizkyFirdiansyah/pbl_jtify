<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    <!-- Center form -->
    <div class="flex-1 flex items-center justify-center px-4 pb-4">

        <div class="card-glass rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.10)] w-full max-w-sm px-8 py-10 anim-card">

            <!-- Icon -->
            <div class="flex justify-center mb-5">
                <div class="w-[52px] h-[52px] bg-white rounded-[14px] shadow-[0_2px_12px_rgba(0,0,0,0.10)] flex items-center justify-center">
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
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white/70 text-sm text-gray-700 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"
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
                        class="w-full pl-10 pr-11 py-3 rounded-xl border border-gray-200 bg-white/70 text-sm text-gray-700 placeholder-gray-400 transition-all duration-200 focus:outline-none focus:border-[#3B4C7E] focus:ring-3 focus:ring-[#3B4C7E]/12"
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
                    class="w-full bg-[#3B4C7E] text-white font-semibold text-sm py-3.5 rounded-xl shadow-[0_4px_16px_rgba(59,76,126,0.35)] transition-all duration-200 mt-2 hover:bg-[#2D3A61] active:scale-98">
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