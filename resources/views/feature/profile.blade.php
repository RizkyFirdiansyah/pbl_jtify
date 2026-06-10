<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Pengaturan Akun</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-sans" style="background: linear-gradient(135deg, #c5e8f7 0%, #eef6fc 50%, #daeef8 100%); min-height: 100vh;">

<div id="toastContainer" class="fixed top-24 right-6 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
                              stroke="white" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                    </svg>
                </div>
                <span>JTIFY</span>
            </div>
            <div class="sidebar-subtitle">Pengaturan Akun</div>
        </div>

        <div class="user-mini">
            <div class="user-avatar" id="sidebarAvatar">
                <img id="sidebarAvatarImg" src="" alt="" style="display:none;"/>
                <span id="sidebarAvatarLetter">{{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'J' }}</span>
            </div>
            <div>
                <div class="user-name" id="sidebarName">{{ Auth::check() ? Auth::user()->name : 'Nama Mahasiswa' }}</div>
            </div>
        </div>

        <div class="nav-section-label">Menu</div>

        <a href="#profil" class="nav-item active" onclick="showSection('profil', this); closeSidebar();">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
            </svg>
            Profil Saya
        </a>

        <a href="#keamanan" class="nav-item" onclick="showSection('keamanan', this); closeSidebar();">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="11" width="18" height="11" rx="2" stroke="currentColor" stroke-width="2"/>
                <path d="M7 11V7a5 5 0 0110 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Keamanan
        </a>

        <a href="#dokumen" class="nav-item" onclick="showSection('dokumen', this); closeSidebar();">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            Dokumen & CV
        </a>

        @if(Auth::check() && Auth::user()->isCollaborator())
        <a href="/admin" class="nav-item" style="color: #2563a8;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="9"></rect>
                <rect x="14" y="3" width="7" height="5"></rect>
                <rect x="14" y="12" width="7" height="9"></rect>
                <rect x="3" y="16" width="7" height="5"></rect>
            </svg>
            Dashboard Admin
        </a>
        @endif



        <div class="nav-bottom">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item" style="color:#EF4444;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Keluar
            </a>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="topbar">
            <div class="topbar-left">
                <button class="mobile-menu-btn" onclick="openSidebar()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#1A2E5A" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <div class="topbar-title" id="topbarTitle">Profil Saya</div>
            </div>
            <div class="topbar-right">
                <a href="{{ route('home') }}" class="btn-back-top">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Beranda
                </a>
            </div>
        </div>

        <div class="content-area">

            <!-- SECTION: PROFIL -->
            <div id="section-profil">



                <div class="section-card">
                    <div class="section-card-header">
                        <div>
                            <div class="section-card-title">Informasi Dasar</div>
                            <div class="section-card-desc">Data diri kamu sebagai mahasiswa</div>
                        </div>
                    </div>
                    <div class="section-card-body">
                        <div class="field-row">
                            <div class="field-label">Nama Lengkap</div>
                            <input class="field-input" id="inputNama" type="text" placeholder="Nama lengkap" oninput="syncSidebar()" value="{{ Auth::check() ? Auth::user()->name : '' }}"/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Nomor Telepon</div>
                            <input class="field-input" id="inputPhone" type="tel" placeholder="08xx-xxxx-xxxx" value="{{ Auth::check() ? Auth::user()->phone : '' }}"/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Email</div>
                            <input class="field-input" id="inputEmail" type="email" placeholder="email@mahasiswa.ac.id" value="{{ Auth::check() ? Auth::user()->email : '' }}"/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">LinkedIn</div>
                            <input class="field-input" id="inputLinkedin" type="url" placeholder="linkedin.com/in/username" value="{{ Auth::check() ? Auth::user()->linkedin_url : '' }}"/>
                        </div>
                    </div>
                </div>

                <div class="action-row">
                    <button class="btn-save" id="btnSaveProfile">Simpan Perubahan</button>
                    <button class="btn-cancel" onclick="resetProfil()">Batalkan</button>
                </div>

            </div>

            <!-- SECTION: KEAMANAN -->
            <div id="section-keamanan" style="display:none;">

                <div class="section-card">
                    <div class="section-card-header">
                        <div>
                            <div class="section-card-title">Ubah Kata Sandi</div>
                            <div class="section-card-desc">Pastikan kata sandi baru kamu kuat dan unik</div>
                        </div>
                    </div>
                    <div class="section-card-body">
                        <div class="field-row">
                            <div class="field-label">Kata Sandi Lama</div>
                            <div class="pwd-wrap">
                                <input class="pwd-input" id="pwdOld" type="password" placeholder="Kata sandi lama"/>
                                <button class="pwd-toggle" type="button" onclick="togglePwd('pwdOld','eyeOld')">
                                    <svg id="eyeOld" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Kata Sandi Baru</div>
                            <div class="pwd-wrap">
                                <input class="pwd-input" id="pwdNew" type="password" placeholder="Minimal 8 karakter"/>
                                <button class="pwd-toggle" type="button" onclick="togglePwd('pwdNew','eyeNew')">
                                    <svg id="eyeNew" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Konfirmasi Baru</div>
                            <div class="pwd-wrap">
                                <input class="pwd-input" id="pwdConfirm" type="password" placeholder="Ulangi kata sandi baru"/>
                                <button class="pwd-toggle" type="button" onclick="togglePwd('pwdConfirm','eyeConfirm')">
                                    <svg id="eyeConfirm" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tips-card" style="margin-bottom:24px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="flex-shrink:0;margin-top:1px;">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                              stroke="#F97316" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 9v4M12 17h.01" stroke="#F97316" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <p style="font-size:12.5px;font-weight:700;color:#C2410C;margin-bottom:4px;">Tips Keamanan</p>
                        <p style="font-size:12px;color:#9A3412;line-height:1.6;">
                            Gunakan minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.
                            Hindari menggunakan tanggal lahir atau nama sebagai kata sandi.
                        </p>
                    </div>
                </div>

                <div class="action-row">
                    <button class="btn-save" id="btnSavePassword">Simpan Kata Sandi</button>
                    <button class="btn-cancel" onclick="clearPwd()">Batalkan</button>
                </div>

            </div>

            <!-- SECTION: DOKUMEN -->
            <div id="section-dokumen" style="display:none;">

                <div class="section-card">
                    <div class="section-card-header">
                        <div>
                            <div class="section-card-title">Curriculum Vitae (CV)</div>
                            <div class="section-card-desc">Unggah CV untuk mempermudah pendaftaran lomba & rekrutmen</div>
                        </div>
                    </div>
                    <div class="section-card-body" style="padding-top:20px;">
                        <div class="cv-uploaded" id="cvUploaded">
                            <div style="display:flex;align-items:center;gap:14px;">
                                <div style="width:40px;height:40px;background:#2563a8;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M14 2v6h6M16 13H8M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <p id="cvFileName" style="font-size:13px;font-weight:700;color:#1A2E5A;"></p>
                                    <p id="cvFileSize" style="font-size:11px;color:#9CA3AF;"></p>
                                </div>
                            </div>
                            <div style="display:flex;gap:10px;align-items:center;">
                                <span style="font-size:11px;background:#DCFCE7;color:#15803D;padding:4px 10px;border-radius:20px;font-weight:600;">Terunggah</span>
                                <button onclick="removeCV()" style="font-size:12px;color:#EF4444;background:none;border:none;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:600;">Hapus</button>
                            </div>
                        </div>

                        <label for="cvInput" class="cv-dropzone" id="cvDropzone">
                            <div class="cv-dropzone-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"
                                          stroke="#2563a8" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size:13.5px;font-weight:700;color:#1A2E5A;">Klik untuk unggah CV</p>
                                <p style="font-size:12px;color:#9CA3AF;margin-top:2px;">PDF, DOC, DOCX — Maks. 5 MB</p>
                            </div>
                            <input type="file" id="cvInput" accept=".pdf,.doc,.docx" style="display:none;" onchange="previewCV(this)"/>
                        </label>
                    </div>
                </div>

                <div class="action-row">
                    <button class="btn-save" id="btnSaveDocument">Simpan Dokumen</button>
                    <button class="btn-danger" onclick="removeCV()">Hapus CV</button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    window.profileConfig = {
        userData: {
            name: "{{ Auth::check() ? Auth::user()->name : '' }}",
            phone: "{{ Auth::check() ? Auth::user()->phone : '' }}",
            email: "{{ Auth::check() ? Auth::user()->email : '' }}",
            linkedin: "{{ Auth::check() ? Auth::user()->linkedin_url : '' }}",
            cvPath: "{{ Auth::check() ? Auth::user()->cv_path : '' }}"
        }
    };
</script>
<script src="{{ asset('js/profile-interaction.js') }}"></script>

</body>
</html>