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
    const select = document.getElementById('bookmark-category-filter');
    const grid   = document.getElementById('bookmark-grid');
    if (!select || !grid) return;

    // Restore last selected filter from sessionStorage
    const saved = sessionStorage.getItem('bookmarkFilter');
    if (saved) select.value = saved;

    filterCards(select.value);

    select.addEventListener('change', () => {
        sessionStorage.setItem('bookmarkFilter', select.value);
        filterCards(select.value);
    });

    function filterCards(category) {
        const cards      = Array.from(grid.querySelectorAll('.bookmark-card'));
        const emptyEl    = grid.querySelector('.bookmark-empty-state');

        // First: fade-out everything
        cards.forEach(card => {
            card.style.transition = 'opacity 0.18s ease, transform 0.18s ease';
            card.style.opacity    = '0';
            card.style.transform  = 'scale(0.96)';
        });

        setTimeout(() => {
            let visibleCount = 0;
            cards.forEach((card, i) => {
                const cat   = card.getAttribute('data-category') || '';
                const show  = (category === 'Semua Kategori' || cat === category);

                if (show) {
                    card.style.display = '';
                    // Stagger fade-in
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity    = '1';
                        card.style.transform  = 'scale(1)';
                    }, visibleCount * 55); // stagger delay per card
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Handle empty state
            if (emptyEl) emptyEl.remove();
            if (visibleCount === 0) {
                const empty = document.createElement('div');
                empty.className = 'bookmark-empty-state col-span-4 flex flex-col items-center justify-center py-20 text-[#8FA9C0]';
                empty.innerHTML = `
                    <svg class="w-16 h-16 mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    <p class="text-lg font-semibold">Tidak ada item di kategori ini</p>
                    <p class="text-sm mt-1 opacity-70">Coba pilih kategori lain</p>
                `;
                grid.appendChild(empty);
            }
        }, 180);
    }
});

/* ====================================================
   TOGGLE BOOKMARK
   ==================================================== */
async function toggleBookmark(btn, event) {
    event.preventDefault();
    event.stopPropagation();

    const ribbon    = btn.querySelector('.bookmark-ribbon');
    const card      = btn.closest('.bookmark-card');
    const infoId    = card.getAttribute('data-info-id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch('/api/bookmarks/toggle', {
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
            if (result.is_bookmarked) {
                ribbon.classList.add('bg-[#486284]', 'text-white');
                ribbon.classList.remove('bg-gray-300', 'text-gray-500');
                card.classList.remove('opacity-50', 'grayscale');
                showToast(result.message || 'Disimpan');
            } else {
                ribbon.classList.remove('bg-[#486284]', 'text-white');
                ribbon.classList.add('bg-gray-300', 'text-gray-500');
                showToast(result.message || 'Batal disimpan');

                card.style.transition = 'all 0.45s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity    = '0';
                card.style.transform  = 'scale(0.88) translateY(16px)';
                setTimeout(() => {
                    card.remove();
                    const remaining = document.querySelectorAll('.bookmark-card');
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
    document.querySelectorAll('.bm-toast').forEach(t => t.remove());

    const toast = document.createElement('div');
    toast.className = 'bm-toast fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-[#486284] px-6 py-3 rounded-xl shadow-[0px_4px_24px_rgba(0,0,0,0.12)] font-semibold border border-gray-100 flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 z-[100]';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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

/* ====================================================
   TOGGLE REMINDER / NOTIFIKASI
   ==================================================== */
async function toggleReminder(btn, event) {
    event.preventDefault();
    event.stopPropagation();

    const card      = btn.closest('.bookmark-card');
    const infoId    = card.getAttribute('data-info-id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const isCurrentlyEnabled = btn.getAttribute('data-reminder-enabled') === 'true';
    const nextState = !isCurrentlyEnabled;

    try {
        const response = await fetch('/api/bookmarks/reminder', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                information_id: infoId,
                reminder_enabled: nextState ? 1 : 0
            })
        });

        const result = await response.json();

        if (response.ok) {
            btn.setAttribute('data-reminder-enabled', nextState ? 'true' : 'false');
            if (nextState) {
                // Change icon to solid yellow bell
                btn.innerHTML = `
                    <svg class="w-4 h-4 text-yellow-300 filter drop-shadow" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                    </svg>
                `;
            } else {
                // Change icon to outline white bell
                btn.innerHTML = `
                    <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                `;
            }
            showToast(result.message || 'Reminder updated');
        } else {
            showToast(result.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (err) {
        showToast('Terjadi kesalahan koneksi.', 'error');
        console.error(err);
    }
}
