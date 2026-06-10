<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Gabung Kolaborator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 overflow-x-hidden font-sans min-h-screen flex flex-col justify-between">

    @include('components.navbar')

    @include('components.header-detail', [
        'label'      => 'Program Kolaborasi',
        'titleWords' => ['GABUNG', 'KOLABORATOR'],
        'subtitle'   => 'Daftarkan diri Anda untuk menjadi bagian dari pengelola konten dan informasi di JTIFY',
    ])

    <main class="flex-grow py-12 px-4 md:px-10">
        <div class="max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="800">
            
            {{-- Toast/Session Alerts --}}
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-150 flex items-center gap-3 text-emerald-800 shadow-sm animate-fade-in">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-150 flex items-center gap-3 text-rose-800 shadow-sm animate-fade-in">
                    <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-150 text-amber-800 shadow-sm animate-fade-in">
                    <div class="flex items-center gap-3 mb-2 font-bold text-sm">
                        <div class="w-7 h-7 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        Ada beberapa kesalahan pengisian form:
                    </div>
                    <ul class="list-disc pl-9 text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Container Card --}}
            <div class="bg-white border border-slate-100 rounded-[32px] p-6 md:p-10 shadow-[0_15px_40px_rgba(0,0,0,0.04)]">
                
                {{-- 1. STATE: GUEST (Belum Login) --}}
                @if($state === 'guest')
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1A2E5A] mb-3">Daftar Akun Reguler Terlebih Dahulu</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-md mx-auto mb-8">
                            Untuk mengajukan pendaftaran sebagai kolaborator, Anda diwajibkan memiliki dan masuk menggunakan akun reguler JTIFY terlebih dahulu.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-[#1A2E5A] hover:bg-[#2D3A61] text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-md">
                                Masuk Akun
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 border border-slate-200 hover:bg-slate-50 text-slate-600 rounded-full font-semibold text-sm transition-all duration-300">
                                Daftar Akun Baru
                            </a>
                        </div>
                    </div>

                {{-- 2. STATE: ACTIVE ROLE (Sudah Admin/Collaborator) --}}
                @elseif($state === 'active_role')
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1A2E5A] mb-3">Akun Kolaborator Aktif</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-md mx-auto mb-8">
                            Akun Anda saat ini memiliki role <span class="font-bold text-[#1A2E5A] uppercase">{{ $user->role }}</span>. Anda sudah memiliki hak akses penuh untuk mengelola konten dan informasi JTIFY.
                        </p>
                        @if($user->isCollaborator())
                            <div class="flex justify-center">
                                <a href="/admin" class="px-8 py-3 bg-[#1A2E5A] hover:bg-[#2D3A61] text-white rounded-full font-semibold text-sm transition-all duration-300 shadow-md">
                                    Buka Dashboard Admin
                                </a>
                            </div>
                        @endif
                    </div>

                {{-- 3. STATE: PENDING (Sedang Ditinjau) --}}
                @elseif($state === 'pending')
                    <div class="text-center py-6">
                        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1A2E5A] mb-3">Pengajuan Sedang Ditinjau</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-md mx-auto mb-6">
                            Halo <span class="font-semibold text-slate-800">{{ $user->name }}</span>, pengajuan pendaftaran kolaborator Anda telah diterima pada <span class="font-medium text-slate-850">{{ $request->created_at->format('d M Y H:i') }} WIB</span>.
                        </p>
                        <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 text-amber-800 text-xs inline-block max-w-sm">
                            <p class="font-medium">Status Pengajuan: Peninjauan Manual</p>
                            <p class="mt-1 opacity-80">Mohon menunggu persetujuan admin. Anda akan otomatis mendapat akses dashboard kolaborator jika disetujui.</p>
                        </div>
                    </div>

                {{-- 4. STATE: FORM (Bisa Mengajukan) --}}
                @elseif($state === 'form')
                    <div class="mb-8 border-b border-slate-100 pb-5">
                        <h3 class="text-lg font-bold text-[#1A2E5A]">Lengkapi Formulir Kolaborator</h3>
                        <p class="text-xs text-gray-400 mt-1">Harap lengkapi semua kolom wajib dengan data terbaru Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('collaborator.register.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Read Only Info: Nama & Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ $user->name }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-500 text-sm font-medium focus:outline-none" disabled>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Alamat Email</label>
                                <input type="email" value="{{ $user->email }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-500 text-sm font-medium focus:outline-none" disabled>
                            </div>
                        </div>

                        <!-- No Telepon & LinkedIn -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nomor Telepon <span class="text-rose-500">*</span></label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:border-[#1A2E5A] focus:ring-1 focus:ring-[#1A2E5A] transition-all" required>
                            </div>
                            <div>
                                <label for="linkedin_url" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">LinkedIn URL</label>
                                <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="Contoh: https://linkedin.com/in/username" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:border-[#1A2E5A] focus:ring-1 focus:ring-[#1A2E5A] transition-all">
                            </div>
                        </div>

                        <!-- Alasan Pengajuan -->
                        <div>
                            <label for="reason" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Alasan Bergabung <span class="text-rose-500">*</span></label>
                            <textarea name="reason" id="reason" rows="4" placeholder="Jelaskan secara singkat alasan, latar belakang, dan kontribusi yang ingin Anda berikan sebagai kolaborator pengelola informasi..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:border-[#1A2E5A] focus:ring-1 focus:ring-[#1A2E5A] transition-all resize-none" required>{{ old('reason') }}</textarea>
                            <span class="text-[10px] text-gray-400 mt-1 block">Minimal 20 karakter.</span>
                        </div>

                        <!-- CV Upload Dropzone -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Unggah CV / Portofolio</label>
                            <label for="cv" class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 hover:border-[#1A2E5A] hover:bg-slate-50/50 rounded-2xl p-6 cursor-pointer transition-all duration-300 group">
                                <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:text-[#1A2E5A] group-hover:bg-[#1A2E5A]/5 mb-3 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-bold text-slate-700" id="upload-title">Klik atau seret berkas CV ke sini</p>
                                    <p class="text-[10px] text-slate-400 mt-1">PDF, DOC, DOCX (Maksimal 5MB)</p>
                                </div>
                                <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="hidden" onchange="updateFileName(this)">
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4 border-t border-slate-50">
                            <button type="submit" class="w-full bg-[#1A2E5A] hover:bg-[#2D3A61] active:scale-[0.98] text-white py-3 rounded-full font-bold text-sm shadow-md transition-all duration-300">
                                Kirim Pengajuan Kolaborator
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </main>

    <section class="relative z-0 h-40" style="background: linear-gradient(180deg, #ffffff 0%, #c8dff0 100%);"></section>

    @include('components.footer')

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        function updateFileName(input) {
            const title = document.getElementById('upload-title');
            if (input.files && input.files.length > 0) {
                const file = input.files[0];
                title.textContent = `Terpilih: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                title.classList.remove('text-slate-700');
                title.classList.add('text-[#1A2E5A]');
            } else {
                title.textContent = 'Klik atau seret berkas CV ke sini';
                title.classList.remove('text-[#1A2E5A]');
                title.classList.add('text-slate-700');
            }
        }
    </script>
</body>

</html>
