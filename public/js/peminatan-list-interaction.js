AOS.init({
    duration: 1000,
    once: false,
    mirror: true,
    easing: 'ease-out-cubic'
});

/* ====================================================
   CLIENT-SIDE CATEGORY FILTER (smooth, no page reload)
   ==================================================== */
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('peminatan-category-filter');
    const grid   = document.getElementById('peminatan-grid');
    if (!select || !grid) return;

    // Restore last selected filter from sessionStorage
    const saved = sessionStorage.getItem('peminatanFilter');
    if (saved) select.value = saved;

    filterCards(select.value);

    select.addEventListener('change', () => {
        sessionStorage.setItem('peminatanFilter', select.value);
        filterCards(select.value);
    });

    function filterCards(category) {
        const cards   = Array.from(grid.querySelectorAll('.like-card'));
        const emptyEl = grid.querySelector('.like-empty-state');

        // First: fade-out everything
        cards.forEach(card => {
            card.style.transition = 'opacity 0.18s ease, transform 0.18s ease';
            card.style.opacity    = '0';
            card.style.transform  = 'scale(0.96)';
        });

        setTimeout(() => {
            let visibleCount = 0;
            cards.forEach((card, i) => {
                const cat  = card.getAttribute('data-category') || '';
                const show = (category === 'Semua Kategori' || cat === category);

                if (show) {
                    card.style.display = '';
                    // Stagger fade-in
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity    = '1';
                        card.style.transform  = 'scale(1)';
                    }, visibleCount * 55);
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Handle empty state
            if (emptyEl) emptyEl.remove();
            if (visibleCount === 0 && cards.length > 0) {
                const empty = document.createElement('div');
                empty.className = 'like-empty-state col-span-4 flex flex-col items-center justify-center py-20 text-[#8FA9C0]';
                empty.innerHTML = `
                    <svg class="w-16 h-16 mb-4 opacity-30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <p class="text-lg font-semibold">Tidak ada item disukai di kategori ini</p>
                    <p class="text-sm mt-1 opacity-70">Coba pilih kategori lain</p>
                `;
                grid.appendChild(empty);
            }
        }, 180);
    }
});

/* ====================================================
   TOGGLE LIKE
   ==================================================== */
async function toggleLike(btn, event) {
    event.preventDefault();
    event.stopPropagation();

    const likeBtn   = btn.querySelector('.like-btn');
    const heartIcon = likeBtn.querySelector('svg');
    const card      = btn.closest('.like-card');
    const infoId    = card.getAttribute('data-info-id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch('/api/likes/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ information_id: infoId })
        });

        const result = await response.json();

        if (response.ok) {
            if (result.is_active) {
                heartIcon.classList.add('text-red-500', 'fill-current');
                heartIcon.classList.remove('text-gray-400', 'fill-none', 'stroke-current', 'stroke-2');
                card.classList.remove('opacity-50', 'grayscale');
                showToast(result.message || 'Disukai');
            } else {
                heartIcon.classList.remove('text-red-500', 'fill-current');
                heartIcon.classList.add('text-gray-400', 'fill-none', 'stroke-current', 'stroke-2');
                showToast(result.message || 'Batal disukai');

                card.style.transition = 'all 0.45s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity    = '0';
                card.style.transform  = 'scale(0.88) translateY(16px)';
                setTimeout(() => {
                    card.remove();
                    const remaining = document.querySelectorAll('.like-card');
                    if (remaining.length === 0) window.location.reload();
                }, 450);
            }
        } else {
            showToast(result.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    }
}

/* ====================================================
   TOAST
   ==================================================== */
function showToast(message) {
    // Remove existing toast to prevent stacking
    document.querySelectorAll('.pm-toast').forEach(t => t.remove());

    const toast = document.createElement('div');
    toast.className = 'pm-toast fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-[#486284] px-6 py-3 rounded-xl shadow-[0px_4px_24px_rgba(0,0,0,0.12)] font-semibold border border-gray-100 flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 z-[100]';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <span>${message}</span>
    `;

    document.body.appendChild(toast);
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-20', 'opacity-0');
    });

    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
        setTimeout(() => toast.remove(), 320);
    }, 2500);
}
