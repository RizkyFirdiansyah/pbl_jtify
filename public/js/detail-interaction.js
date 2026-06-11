AOS.init({
    duration: 900,
    once: false,
    mirror: true,
    easing: 'ease-out-cubic',
});

/* ════════════════════════════════
   MODAL & INTERACTION STATE
════════════════════════════════ */
const isLoggedIn = window.detailConfig ? window.detailConfig.isLoggedIn : false;
const informationId = window.detailConfig ? window.detailConfig.informationId : null;
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

let isBookmarked = false;
let isLiked = false;

function updateBookmarkUI(bookmarked) {
    isBookmarked = bookmarked;
    const btn = document.getElementById('btnBookmark');
    if (btn) {
        const svg = btn.querySelector('svg');
        if (svg) {
            svg.setAttribute('fill', isBookmarked ? 'currentColor' : 'none');
        }
    }
}

function updateLikeUI(liked) {
    isLiked = liked;
    const btn = document.getElementById('btnLike');
    if (btn) {
        const svg = btn.querySelector('svg');
        if (svg) {
            svg.setAttribute('fill', isLiked ? 'currentColor' : 'none');
        }
    }
}

async function checkBookmarkAndLikeStatus() {
    if (!isLoggedIn) return;
    try {
        const resB = await fetch(`/api/bookmarks/check?information_id=${informationId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const dataB = await resB.json();
        updateBookmarkUI(dataB.is_bookmarked);

        const resL = await fetch(`/api/likes/check?information_id=${informationId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const dataL = await resL.json();
        updateLikeUI(dataL.is_active);
    } catch (err) {
        console.error('Error checking bookmark/like status:', err);
    }
}

async function toggleBookmark() {
    if (!isLoggedIn) {
        showToast('Silakan login terlebih dahulu untuk menandai bookmark.', 'error');
        return;
    }
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    try {
        const response = await fetch('/api/bookmarks/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ information_id: informationId })
        });
        const result = await response.json();
        if (response.ok) {
            updateBookmarkUI(result.is_bookmarked);
            showToast(result.message, 'success');
        } else {
            showToast(result.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    }
}

async function toggleLike() {
    if (!isLoggedIn) {
        showToast('Silakan login terlebih dahulu untuk menyukai.', 'error');
        return;
    }
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    try {
        const response = await fetch('/api/likes/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ information_id: informationId })
        });
        const result = await response.json();
        if (response.ok) {
            updateLikeUI(result.is_active);
            showToast(result.message, 'success');
        } else {
            showToast(result.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    }
}

// Show toast notification helper
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
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

    const modal = document.getElementById('modalBackdrop');
    if (modal) {
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    
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
    const modal = document.getElementById('modalBackdrop');
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}

function handleBackdropClick(e) {
    if (e.target === document.getElementById('modalBackdrop')) closeModal();
}

async function confirmDaftar() {
    const consentCheckbox = document.getElementById('consentCheckbox');
    if (!consentCheckbox || !consentCheckbox.checked) return;

    const btnConfirmInterest = document.getElementById('btnConfirmInterest');
    if (!btnConfirmInterest) return;

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
            closeModal();
            // Tampilkan modal sukses dengan link pendaftaran
            const link = result.registration_link || (window.detailConfig ? window.detailConfig.registrationLink : null);
            showSuccessModal(link);
        } else {
            showToast(result.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    } finally {
        btnConfirmInterest.disabled = false;
        btnConfirmInterest.innerText = 'Ya, Saya Berminat';
    }
}

function showSuccessModal(registrationLink) {
    const modal = document.getElementById('successModalBackdrop');
    const linkEl = document.getElementById('successRegistrationLink');
    const openBtn = document.getElementById('btnOpenLink');

    if (!modal) return;

    if (registrationLink && registrationLink.trim() !== '') {
        if (linkEl) {
            linkEl.href = registrationLink;
            linkEl.textContent = registrationLink;
            linkEl.parentElement.style.display = '';
        }
        if (openBtn) {
            openBtn.style.display = '';
            openBtn.onclick = function() {
                window.open(registrationLink, '_blank');
                closeSuccessModal();
            };
        }
    } else {
        // Sembunyikan link dan tombol Open Link jika tidak ada registration_link
        if (linkEl) linkEl.parentElement.style.display = 'none';
        if (openBtn) openBtn.style.display = 'none';
    }

    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeSuccessModal() {
    const modal = document.getElementById('successModalBackdrop');
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}

function handleSuccessBackdropClick(e) {
    if (e.target === document.getElementById('successModalBackdrop')) closeSuccessModal();
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeModal();
        closeSuccessModal();
    }
});

// DOMContentLoaded listeners
document.addEventListener('DOMContentLoaded', () => {
    checkInterestStatus();
    checkBookmarkAndLikeStatus();

    const btnBookmark = document.getElementById('btnBookmark');
    const btnLike = document.getElementById('btnLike');
    if (btnBookmark) btnBookmark.addEventListener('click', toggleBookmark);
    if (btnLike) btnLike.addEventListener('click', toggleLike);

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

    if (!track || !wrapper || !dotsWrapper) return;

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
