<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JTIFY - Pengaturan Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #c5e8f7 0%, #eef6fc 50%, #daeef8 100%);
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            flex-shrink: 0;
            background: white;
            border-right: 1px solid #EAF0F6;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 28px 28px 20px;
            border-bottom: 1px solid #EAF0F6;
        }
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }
        .sidebar-logo-icon {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #4a90c4, #1A2E5A);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }
        .sidebar-logo span {
            font-size: 18px;
            font-weight: 800;
            color: #1A2E5A;
        }
        .sidebar-subtitle {
            font-size: 11px;
            color: #9CA3AF;
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        .user-mini {
            padding: 16px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #EAF0F6;
        }
        .user-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4a90c4, #1A2E5A);
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; font-weight: 700; color: white;
            flex-shrink: 0;
            overflow: hidden;
            position: relative;
        }
        .user-avatar img {
            width: 100%; height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .user-name { font-size: 13px; font-weight: 700; color: #1A2E5A; }
        .user-nim  { font-size: 11px; color: #9CA3AF; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            color: #9CA3AF;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 20px 28px 8px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 28px;
            font-size: 13.5px;
            font-weight: 500;
            color: #6B7280;
            cursor: pointer;
            transition: all 0.15s;
            border-left: 3px solid transparent;
            text-decoration: none;
        }
        .nav-item:hover { background: #EBF4FC; color: #1A2E5A; }
        .nav-item.active {
            background: #E8F1FB;
            color: #1A2E5A;
            font-weight: 700;
            border-left-color: #2563a8;
        }
        .nav-item svg { flex-shrink: 0; }

        .nav-bottom {
            margin-top: auto;
            padding: 16px 0;
            border-top: 1px solid #EAF0F6;
        }

        /* ── Main content ── */
        .main-content {
            flex: 1;
            min-width: 0;
            overflow-y: auto;
            background: #F7FAFD;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #EAF0F6;
            padding: 18px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }
        .topbar-title {
            font-size: 18px;
            font-weight: 800;
            color: #1A2E5A;
            white-space: nowrap;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .btn-back-top {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
            color: #6B7280;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
            background: white;
            transition: all 0.15s;
            white-space: nowrap;
        }
        .btn-back-top:hover { background: #F3F4F6; color: #1A2E5A; }

        .content-area {
            padding: 32px 40px;
            max-width: 1200px;
            width: 100%;
        }

        .section-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #EAF0F6;
            margin-bottom: 24px;
            overflow: hidden;
        }
        .section-card-header {
            padding: 20px 28px;
            border-bottom: 1px solid #F3F4F6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .section-card-title {
            font-size: 15px;
            font-weight: 800;
            color: #1A2E5A;
        }
        .section-card-desc {
            font-size: 12px;
            color: #9CA3AF;
            margin-top: 2px;
        }
        .section-card-body {
            padding: 8px 28px 24px;
        }

        /* ── Field row ── */
        .field-row {
            display: flex;
            align-items: center;
            padding: 13px 0;
            border-bottom: 1px solid #F9FAFB;
            gap: 12px;
        }
        .field-row:last-of-type { border-bottom: none; }
        .field-label {
            width: 150px;
            flex-shrink: 0;
            font-size: 12.5px;
            color: #9CA3AF;
            font-weight: 500;
        }
        .field-input {
            flex: 1;
            min-width: 0;
            border: none;
            outline: none;
            font-size: 14px;
            font-weight: 600;
            color: #1A2E5A;
            font-family: 'Poppins', sans-serif;
            background: transparent;
        }
        .field-input::placeholder { color: #D1D5DB; font-weight: 400; }
        .field-input:focus { border-bottom: 1.5px solid #2563a8; padding-bottom: 1px; }

        .photo-circle {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4a90c4, #1A2E5A);
            display: flex; align-items: center; justify-content: center;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
            cursor: pointer;
            border: 3px solid #EAF0F6;
        }
        .photo-circle img {
            width: 100%; height: 100%;
            object-fit: cover; border-radius: 50%;
        }
        .photo-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.32);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.2s; border-radius: 50%;
        }
        .photo-circle:hover .photo-overlay { opacity: 1; }

        .cv-dropzone {
            border: 2px dashed #CBD5E1;
            border-radius: 12px;
            padding: 22px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
            text-align: left;
        }
        .cv-dropzone:hover { border-color: #2563a8; background: #EBF4FC; }
        .cv-dropzone-icon {
            width: 44px; height: 44px;
            background: #EBF4FC;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .cv-uploaded {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: #F0F9FF;
            border: 1px solid #BAE6FD;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ── Buttons ── */
        .btn-save {
            background: linear-gradient(135deg, #2563a8, #1A2E5A);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 32px;
            font-size: 13.5px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 5px 16px rgba(37,99,168,0.26);
        }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 8px 22px rgba(37,99,168,0.34); }
        .btn-save:active { transform: scale(0.98); }

        .btn-cancel {
            background: white;
            color: #6B7280;
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-cancel:hover { background: #F3F4F6; color: #374151; }

        .btn-danger {
            background: white;
            color: #EF4444;
            border: 1.5px solid #FCA5A5;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger:hover { background: #FEF2F2; }

        /* ── Password ── */
        .pwd-wrap {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: center;
        }
        .pwd-input {
            flex: 1;
            min-width: 0;
            border: none;
            outline: none;
            font-size: 14px;
            font-weight: 600;
            color: #1A2E5A;
            font-family: 'Poppins', sans-serif;
            background: transparent;
        }
        .pwd-input:focus { border-bottom: 1.5px solid #2563a8; padding-bottom: 1px; }
        .pwd-toggle {
            background: none; border: none; cursor: pointer;
            color: #9CA3AF; padding: 0 0 0 8px; display: flex; align-items: center;
            flex-shrink: 0;
        }
        .pwd-toggle:hover { color: #2563a8; }

        .tips-card {
            background: #FFF7ED;
            border: 1px solid #FED7AA;
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        /* ── Action row ── */
        .action-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* ── Mobile hamburger ── */
        .mobile-menu-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            cursor: pointer;
            flex-shrink: 0;
        }

        /* ── Sidebar overlay ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            z-index: 99;
        }
        .sidebar-overlay.show { display: block; }

        /* ══════════════════════════
           RESPONSIVE — tablet
        ══════════════════════════ */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                z-index: 100;
                transition: left 0.3s ease;
                box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            }
            .sidebar.open { left: 0; }

            .mobile-menu-btn { display: flex; }

            .topbar { padding: 14px 20px; }
            .topbar-title { font-size: 16px; }

            .content-area { padding: 20px 16px; }

            .field-label { width: 120px; font-size: 12px; }

            .section-card-body { padding: 8px 16px 20px; }
            .section-card-header { padding: 16px 16px; }
        }

        /* ══════════════════════════
           RESPONSIVE — iPhone SE & small (≤375px)
        ══════════════════════════ */
        @media (max-width: 375px) {
            .topbar { padding: 12px 14px; gap: 8px; }
            .topbar-title { font-size: 14px; }
            .btn-back-top { padding: 6px 10px; font-size: 11px; gap: 4px; }
            .btn-back-top svg { display: none; }

            .content-area { padding: 16px 12px; }

            .section-card-header { padding: 14px 14px; }
            .section-card-body  { padding: 4px 14px 18px; }

            /* Label di atas, input di bawah */
            .field-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
                padding: 10px 0;
            }
            .field-label {
                width: 100%;
                font-size: 11px;
            }
            .field-input {
                width: 100%;
                font-size: 13px;
            }

            /* Password row tetap horizontal tapi input tidak overflow */
            .pwd-wrap {
                width: 100%;
            }
            .pwd-input { font-size: 13px; }

            /* Tips card */
            .tips-card {
                padding: 12px 12px;
                gap: 10px;
            }
            .tips-card p { font-size: 11.5px !important; }

            /* Tombol full-width dan stack */
            .action-row {
                flex-direction: column;
            }
            .btn-save,
            .btn-cancel,
            .btn-danger {
                width: 100%;
                text-align: center;
                padding: 13px 16px;
            }

            /* CV dropzone */
            .cv-dropzone { padding: 16px 12px; gap: 12px; }
            .cv-dropzone-icon { width: 38px; height: 38px; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="layout">

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
                <span id="sidebarAvatarLetter">J</span>
            </div>
            <div>
                <div class="user-name" id="sidebarName">Nama Mahasiswa</div>
                <div class="user-nim" id="sidebarNim">NIM belum diisi</div>
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

        <div class="nav-bottom">
            <a href="{{ route('home') }}" class="nav-item" style="color:#EF4444;">
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
                            <div class="section-card-title">Foto Profil</div>
                            <div class="section-card-desc">Foto akan ditampilkan di profil publik kamu</div>
                        </div>
                    </div>
                    <div class="section-card-body" style="padding-top:20px;">
                        <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
                            <div class="photo-circle" onclick="document.getElementById('photoInput').click()">
                                <img id="profileImg" src="" alt="" style="display:none;"/>
                                <svg id="profileDefault" width="30" height="30" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="12" cy="7" r="4" stroke="white" stroke-width="2"/>
                                </svg>
                                <div class="photo-overlay">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" stroke="white" stroke-width="2"/>
                                        <circle cx="12" cy="13" r="4" stroke="white" stroke-width="2"/>
                                    </svg>
                                </div>
                            </div>
                            <input type="file" id="photoInput" accept="image/*" style="display:none;" onchange="previewPhoto(this)"/>
                            <div>
                                <button onclick="document.getElementById('photoInput').click()"
                                    style="font-size:13px;color:#2563a8;font-weight:700;background:#EBF4FC;border:none;cursor:pointer;padding:8px 18px;border-radius:8px;font-family:'Poppins',sans-serif;display:block;margin-bottom:8px;">
                                    Unggah Foto Baru
                                </button>
                                <button onclick="removePhoto()"
                                    style="font-size:12px;color:#EF4444;background:none;border:none;cursor:pointer;font-family:'Poppins',sans-serif;font-weight:600;">
                                    Hapus Foto
                                </button>
                                <p style="font-size:11px;color:#9CA3AF;margin-top:6px;">JPG, PNG — Maks. 2 MB</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                            <input class="field-input" id="inputNama" type="text" placeholder="Nama lengkap" oninput="syncSidebar()" value=""/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">NIM</div>
                            <input class="field-input" id="inputNim" type="text" placeholder="Nomor Induk Mahasiswa" oninput="syncSidebar()" value=""/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Nomor Telepon</div>
                            <input class="field-input" type="tel" placeholder="08xx-xxxx-xxxx" value=""/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Email</div>
                            <input class="field-input" type="email" placeholder="email@mahasiswa.ac.id" value=""/>
                        </div>
                        <div class="field-row">
                            <div class="field-label">LinkedIn</div>
                            <input class="field-input" type="url" placeholder="linkedin.com/in/username" value=""/>
                        </div>
                    </div>
                </div>

                <div class="action-row">
                    <button class="btn-save">Simpan Perubahan</button>
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
                    <button class="btn-save">Simpan Kata Sandi</button>
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
                    <button class="btn-save">Simpan Dokumen</button>
                    <button class="btn-danger" onclick="removeCV()">Hapus CV</button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    const sectionTitles = {
        profil: 'Profil Saya',
        keamanan: 'Keamanan',
        dokumen: 'Dokumen & CV'
    };

    function showSection(name, el) {
        ['profil','keamanan','dokumen'].forEach(s => {
            const sec = document.getElementById('section-' + s);
            if (sec) sec.style.display = 'none';
        });
        const target = document.getElementById('section-' + name);
        if (target) target.style.display = 'block';
        document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('topbarTitle').textContent = sectionTitles[name] || name;
    }

    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebarOverlay').classList.add('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('show');
    }

    function syncSidebar() {
        const nama = document.getElementById('inputNama').value;
        const nim  = document.getElementById('inputNim').value;
        document.getElementById('sidebarName').textContent = nama || 'Nama Mahasiswa';
        document.getElementById('sidebarNim').textContent  = nim  || 'NIM belum diisi';
        if (nama) {
            document.getElementById('sidebarAvatarLetter').textContent = nama.charAt(0).toUpperCase();
        }
    }

    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('profileImg');
                const def = document.getElementById('profileDefault');
                img.src = e.target.result;
                img.style.display = 'block';
                def.style.display = 'none';
                const sbImg = document.getElementById('sidebarAvatarImg');
                const sbLetter = document.getElementById('sidebarAvatarLetter');
                sbImg.src = e.target.result;
                sbImg.style.display = 'block';
                sbLetter.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePhoto() {
        document.getElementById('profileImg').style.display = 'none';
        document.getElementById('profileDefault').style.display = 'block';
        document.getElementById('photoInput').value = '';
        document.getElementById('sidebarAvatarImg').style.display = 'none';
        document.getElementById('sidebarAvatarLetter').style.display = 'block';
    }

    function previewCV(input) {
        if (input.files && input.files[0]) {
            const file   = input.files[0];
            const sizeKB = (file.size / 1024).toFixed(0);
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            document.getElementById('cvFileName').textContent = file.name;
            document.getElementById('cvFileSize').textContent = sizeKB > 1024 ? sizeMB + ' MB' : sizeKB + ' KB';
            document.getElementById('cvUploaded').style.display = 'flex';
            document.getElementById('cvDropzone').style.display = 'none';
        }
    }

    function removeCV() {
        document.getElementById('cvUploaded').style.display = 'none';
        document.getElementById('cvDropzone').style.display = 'flex';
        document.getElementById('cvInput').value = '';
    }

    function togglePwd(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            `;
        } else {
            input.type = 'password';
            icon.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
            `;
        }
    }

    function resetProfil() {
        document.getElementById('inputNama').value = '';
        document.getElementById('inputNim').value  = '';
        syncSidebar();
    }

    function clearPwd() {
        ['pwdOld','pwdNew','pwdConfirm'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
    }
</script>

</body>
</html>