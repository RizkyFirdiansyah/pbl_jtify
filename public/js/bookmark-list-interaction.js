AOS.init({
    duration: 1000,
    once: false,
    mirror: true,
    easing: 'ease-out-cubic'
});

async function toggleBookmark(btn, event) {
    event.preventDefault();
    event.stopPropagation();
    
    const ribbon = btn.querySelector('.bookmark-ribbon');
    const card = btn.closest('.bookmark-card');
    const infoId = card.getAttribute('data-info-id');
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
                showToast(result.message || "Berhasil disimpan kembali!");
            } else {
                ribbon.classList.remove('bg-[#486284]', 'text-white');
                ribbon.classList.add('bg-gray-300', 'text-gray-500');
                card.classList.add('opacity-50', 'grayscale');
                showToast(result.message || "Dihapus dari item tersimpan!");
                
                // Premium micro-animation to remove card from layout
                card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9) translateY(20px)';
                setTimeout(() => {
                    card.remove();
                    
                    // Reload if no items remain on current page to trigger pagination refresh or empty state
                    const remainingCards = document.querySelectorAll('.bookmark-card');
                    if (remainingCards.length === 0) {
                        window.location.reload();
                    }
                }, 500);
            }
        } else {
            showToast(result.message || "Terjadi kesalahan.", "error");
        }
    } catch (err) {
        showToast("Terjadi kesalahan koneksi.", "error");
        console.error(err);
    }
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-8 left-1/2 -translate-x-1/2 bg-white text-[#486284] px-6 py-3 rounded-xl shadow-[0px_4px_16px_rgba(0,0,0,0.1)] font-semibold border border-gray-100 flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 z-[100]';
    toast.innerHTML = `
        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        \${message}
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.remove('translate-y-20', 'opacity-0');
    }, 10);
    
    setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}
