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
    document.getElementById('sidebarName').textContent = nama || 'Nama Mahasiswa';
    if (nama) {
        document.getElementById('sidebarAvatarLetter').textContent = nama.charAt(0).toUpperCase();
    }
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

async function removeCV() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Disable buttons during action
    const btnSaveDocument = document.getElementById('btnSaveDocument');
    if (btnSaveDocument) btnSaveDocument.disabled = true;

    try {
        const response = await fetch('/api/profile/cv', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (response.ok) {
            document.getElementById('cvUploaded').style.display = 'none';
            document.getElementById('cvDropzone').style.display = 'flex';
            document.getElementById('cvInput').value = '';
            window.profileConfig.userData.cvPath = '';
            showToast(result.message || 'CV berhasil dihapus!', 'success');
        } else {
            showToast(result.message || 'Gagal menghapus CV.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    } finally {
        if (btnSaveDocument) btnSaveDocument.disabled = false;
    }
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
    document.getElementById('inputNama').value = window.profileConfig.userData.name;
    document.getElementById('inputPhone').value = window.profileConfig.userData.phone;
    document.getElementById('inputEmail').value = window.profileConfig.userData.email;
    document.getElementById('inputLinkedin').value = window.profileConfig.userData.linkedin;
    syncSidebar();
}

function clearPwd() {
    ['pwdOld','pwdNew','pwdConfirm'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
}

// Show toast notification helper
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = 'toast-notification pointer-events-auto bg-white border border-gray-150 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-2xl p-4 flex items-center gap-3.5 max-w-sm';
    toast.style.transform = 'translateX(120%)';
    toast.style.transition = 'transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease';
    toast.style.position = 'relative';
    toast.style.zIndex = '99999';
    
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

// AJAX: Save Profile
async function saveProfile() {
    const btn = document.getElementById('btnSaveProfile');
    btn.disabled = true;
    btn.textContent = 'Menyimpan...';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const name = document.getElementById('inputNama').value.trim();
    const phone = document.getElementById('inputPhone').value.trim();
    const email = document.getElementById('inputEmail').value.trim();
    const linkedin = document.getElementById('inputLinkedin').value.trim();

    if (!name || !email) {
        showToast('Nama Lengkap dan Email wajib diisi.', 'error');
        btn.disabled = false;
        btn.textContent = 'Simpan Perubahan';
        return;
    }

    // Prepare FormData
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('linkedin_url', linkedin);

    try {
        const response = await fetch('/api/profile', {
            method: 'POST', // Laravel requires POST with _method=PUT to handle multipart forms / fields correctly
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            // Update configuration
            window.profileConfig.userData.name = name;
            window.profileConfig.userData.phone = phone;
            window.profileConfig.userData.email = email;
            window.profileConfig.userData.linkedin = linkedin;
            
            syncSidebar();
            showToast(result.message || 'Profil berhasil diperbarui!', 'success');
        } else {
            const errorMsg = result.errors ? Object.values(result.errors)[0][0] : (result.message || 'Gagal memperbarui profil.');
            showToast(errorMsg, 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Simpan Perubahan';
    }
}

// AJAX: Save CV
async function saveDocument() {
    const btn = document.getElementById('btnSaveDocument');
    const cvInput = document.getElementById('cvInput');
    
    if (!cvInput.files || cvInput.files.length === 0) {
        showToast('Pilih file CV terlebih dahulu.', 'warning');
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Mengunggah...';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('cv_path', cvInput.files[0]);
    // Send other fields so they aren't reset by validation if required
    formData.append('name', window.profileConfig.userData.name);
    formData.append('email', window.profileConfig.userData.email);
    formData.append('phone', window.profileConfig.userData.phone);
    formData.append('linkedin_url', window.profileConfig.userData.linkedin);

    try {
        const response = await fetch('/api/profile', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            window.profileConfig.userData.cvPath = result.data.cv_path;
            showToast(result.message || 'CV berhasil disimpan!', 'success');
        } else {
            const errorMsg = result.errors ? Object.values(result.errors)[0][0] : (result.message || 'Gagal menyimpan CV.');
            showToast(errorMsg, 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Simpan Dokumen';
    }
}

// AJAX: Save Password
async function savePassword() {
    const btn = document.getElementById('btnSavePassword');
    const currentPwd = document.getElementById('pwdOld').value;
    const newPwd = document.getElementById('pwdNew').value;
    const confirmPwd = document.getElementById('pwdConfirm').value;

    if (!currentPwd || !newPwd || !confirmPwd) {
        showToast('Semua kolom kata sandi wajib diisi.', 'error');
        return;
    }

    if (newPwd.length < 8) {
        showToast('Kata sandi baru minimal 8 karakter.', 'warning');
        return;
    }

    if (newPwd !== confirmPwd) {
        showToast('Konfirmasi kata sandi baru tidak cocok.', 'warning');
        return;
    }

    btn.disabled = true;
    btn.textContent = 'Menyimpan...';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch('/api/profile/password', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                current_password: currentPwd,
                password: newPwd,
                password_confirmation: confirmPwd
            })
        });

        const result = await response.json();

        if (response.ok) {
            clearPwd();
            showToast(result.message || 'Kata sandi berhasil diperbarui!', 'success');
        } else {
            const errorMsg = result.errors ? Object.values(result.errors)[0][0] : (result.message || 'Gagal memperbarui kata sandi.');
            showToast(errorMsg, 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Simpan Kata Sandi';
    }
}

// Initialise page logic on load
document.addEventListener('DOMContentLoaded', () => {
    // Initial UI state setup for CV
    const cvPath = window.profileConfig.userData.cvPath;
    if (cvPath) {
        const fileName = cvPath.split('/').pop();
        document.getElementById('cvFileName').textContent = fileName;
        document.getElementById('cvFileSize').textContent = 'Terunduh dari server';
        document.getElementById('cvUploaded').style.display = 'flex';
        document.getElementById('cvDropzone').style.display = 'none';
    } else {
        document.getElementById('cvUploaded').style.display = 'none';
        document.getElementById('cvDropzone').style.display = 'flex';
    }

    // Attach listeners
    const btnSaveProfile = document.getElementById('btnSaveProfile');
    if (btnSaveProfile) btnSaveProfile.addEventListener('click', saveProfile);

    const btnSavePassword = document.getElementById('btnSavePassword');
    if (btnSavePassword) btnSavePassword.addEventListener('click', savePassword);

    const btnSaveDocument = document.getElementById('btnSaveDocument');
    if (btnSaveDocument) btnSaveDocument.addEventListener('click', saveDocument);
});
