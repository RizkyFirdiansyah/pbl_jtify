AOS.init({
    duration: 1000,
    once: false,
    mirror: true,
    easing: 'ease-out-cubic'
});

async function toggleLike(btn, event) {
    event.preventDefault();
    event.stopPropagation();
    
    const likeBtn = btn.querySelector('.like-btn');
    const heartIcon = likeBtn.querySelector('svg');
    const card = btn.closest('.like-card');
    const infoId = card.getAttribute('data-info-id');
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
                showToast(result.message || "Disukai");
            } else {
                heartIcon.classList.remove('text-red-500', 'fill-current');
                heartIcon.classList.add('text-gray-400', 'fill-none', 'stroke-current', 'stroke-2');
                card.classList.add('opacity-50', 'grayscale');
                showToast(result.message || "Batal disukai");
                
                // Premium micro-animation to remove card from layout
                card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9) translateY(20px)';
                setTimeout(() => {
                    card.remove();
                    
                    // Reload if no items remain on current page to trigger pagination refresh or empty state
                    const remainingCards = document.querySelectorAll('.like-card');
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
        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
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
