// ================================
// SEARCH FORM
// ================================
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const q        = this.querySelector('input[name="q"]').value.trim();
    const category = this.querySelector('select[name="category"]').value;

    const routes = {
        'lomba':    window.homeConfig.routes.lomba,
        'seminar':  window.homeConfig.routes.seminar,
        'beasiswa': window.homeConfig.routes.beasiswa,
        'workshop': window.homeConfig.routes.tips,
    };

    let targetCategory = category;

    // Jika kategori tidak dipilih, deteksi otomatis dari kata kunci atau judul konten
    if (!targetCategory && q) {
        const qLower = q.toLowerCase();

        // 1. Deteksi berdasarkan kata kunci langsung
        if (qLower.includes('lomba') || qLower.includes('competition') || qLower.includes('hackathon') || qLower.includes('contest') || qLower.includes('kontes')) {
            targetCategory = 'lomba';
        } else if (qLower.includes('seminar') || qLower.includes('webinar') || qLower.includes('workshop') || qLower.includes('talkshow') || qLower.includes('talk show') || qLower.includes('kelas') || qLower.includes('wawasan')) {
            targetCategory = 'seminar';
        } else if (qLower.includes('beasiswa') || qLower.includes('scholarship') || qLower.includes('lpdp') || qLower.includes('bantuan') || qLower.includes('prestasi')) {
            targetCategory = 'beasiswa';
        } else if (qLower.includes('tips') || qLower.includes('insight') || qLower.includes('cara') || qLower.includes('strategi') || qLower.includes('cv') || qLower.includes('portofolio') || qLower.includes('speaking') || qLower.includes('artikel')) {
            targetCategory = 'workshop';
        } else {
            // 2. Deteksi berdasarkan kecocokan judul di dataset (cardSets)
            let foundCategory = null;

            const hasMatch = (items) => {
                return items.some(item => item.title.toLowerCase().includes(qLower));
            };

            if (typeof cardSets !== 'undefined') {
                if (cardSets.lomba && hasMatch(cardSets.lomba)) {
                    foundCategory = 'lomba';
                } else if (cardSets.seminar && hasMatch(cardSets.seminar)) {
                    foundCategory = 'seminar';
                } else if (cardSets.beasiswa && hasMatch(cardSets.beasiswa)) {
                    foundCategory = 'beasiswa';
                }
            }


            if (foundCategory) {
                targetCategory = foundCategory;
            }
        }
    }

    // Tentukan URL tujuan: sesuai kategori, default ke lomba jika tidak terpilih/terdeteksi
    const base = routes[targetCategory] || routes['lomba'];
    const url  = q ? base + '?q=' + encodeURIComponent(q) : base;
    window.location.href = url;
});

// ================================
// CATEGORY TABS & CARDS
// ================================
const categoryRoutes = {
    popular:  window.homeConfig.routes.home,
    lomba:    window.homeConfig.routes.lomba,
    seminar:  window.homeConfig.routes.seminar,
    beasiswa: window.homeConfig.routes.beasiswa
};

// Route detail per kategori untuk setiap card (diisi dari API via loadDynamicCardSets)
const detailRoutes = {
    popular:  [],
    lomba:    [],
    seminar:  [],
    beasiswa: []
};

// Data konten card per kategori (diisi dari API via loadDynamicCardSets)
const cardSets = {
    popular:  [],
    lomba:    [],
    seminar:  [],
    beasiswa: [],
};

// Buat satu card HTML dari data
function buildCardHTML(data, href) {
    const posterPath = data.poster_path
        ? (data.poster_path.startsWith('http')
            ? data.poster_path
            : '/' + (data.poster_path.startsWith('storage/')
                ? data.poster_path
                : 'storage/' + data.poster_path))
        : null;

    return `
        <div class="card-item flex-none relative">
            <a href="${href || '#'}" class="card-link block group relative rounded-[10px] overflow-hidden
                shadow-[0_8px_30px_rgba(0,0,0,0.06)] bg-gradient-to-br from-[#E8EEF8] to-[#D0DCEE]
                hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)] hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                style="aspect-ratio:3/4;">

                <img src="${posterPath || ''}" alt="${data.title}"
                    class="card-image absolute inset-0 w-full h-full object-cover ${posterPath ? '' : 'hidden'}
                    group-hover:scale-105 transition-transform duration-500"
                    onerror="this.classList.add('hidden'); this.nextElementSibling.nextElementSibling.classList.remove('hidden');">
                <div class="absolute inset-0 bg-gradient-to-t from-[#1A2E5A]/60 via-transparent to-transparent
                    card-image-overlay ${posterPath ? '' : 'hidden'}"></div>
                <div class="card-placeholder absolute inset-0 flex items-center justify-center transition-colors duration-500
                    ${posterPath ? 'hidden' : ''}">
                    <svg class="w-16 h-16 text-[#486284]/30 group-hover:scale-110 transition-transform duration-500"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 19V5C21 3.9 20.1 3 19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19ZM8.5 13.5L11 16.51L14.5 12L19 18H5L8.5 13.5Z"/>
                    </svg>
                </div>

                <div class="absolute top-3 left-3 z-20">
                    <span class="card-badge text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full shadow-sm"
                        style="background:${data.bg};color:${data.color};">${data.label}</span>
                </div>

                <div class="absolute bottom-0 left-0 right-0 z-10 p-4"
                    style="background:linear-gradient(to top,rgba(26,46,90,0.95) 0%,rgba(26,46,90,0.5) 70%,transparent 100%);">
                    <h3 class="card-title text-white font-bold text-sm leading-snug line-clamp-2 mb-2 drop-shadow-sm">
                        ${data.title}
                    </h3>
                    <div class="flex items-center gap-1.5 mb-3">
                        <svg class="w-3.5 h-3.5 text-white/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="card-deadline text-white/70 text-[11px]">Deadline: ${data.deadline || '-'}</span>
                    </div>
                    <span class="card-detail-btn inline-flex items-center gap-2 w-full justify-center
                        bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30
                        text-white text-xs font-bold py-2 rounded-xl transition-all duration-300
                        group-hover:bg-[#3B4C7E] group-hover:border-[#3B4C7E]">
                        Lihat Detail
                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </div>
            </a>
        </div>
    `;
}

// Render semua card ke slider sesuai kategori aktif
function renderCards(category) {
    const set    = cardSets[category] || [];
    const routes = detailRoutes[category] || [];

    slider.innerHTML = set.map((data, i) => buildCardHTML(data, routes[i] || '#')).join('');

    // Re-attach drag stop listener
    document.querySelectorAll('.card-item').forEach(card => {
        card.addEventListener('click', () => clearInterval(autoSlide));
    });

    updateCardWidth();
}

const totalCards   = 8;
let currentCard    = 0;
let activeCategory = 'popular';

const tabs       = document.querySelectorAll('.tab-link');
const indicator  = document.getElementById('tabIndicator');
const tabsWrapper = document.getElementById('tabsWrapper');
const lihatSemua = document.getElementById('lihatSemua');
const slider     = document.getElementById('cardsSlider');
const dots       = document.querySelectorAll('.dot');

function updateIndicator(tab) {
    indicator.style.width = tab.offsetWidth + 'px';
    indicator.style.left  = tab.offsetLeft + 'px';
}

function updateCardWidth() {
    const visible = getVisibleCards();
    const w = (slider.parentElement.offsetWidth - 16 * (visible - 1)) / visible;
    document.querySelectorAll('.card-item').forEach(c => c.style.width = w + 'px');
}

function getVisibleCards() {
    if (window.innerWidth <= 480)  return 2;
    if (window.innerWidth <= 768)  return 2;
    if (window.innerWidth <= 1024) return 3;
    return 4;
}

function goToCard(index) {
    const visible = getVisibleCards();
    const cards   = document.querySelectorAll('.card-item');
    if (cards.length === 0) return;

    const max = cards.length - visible;
    if (index > max) index = 0;
    if (index < 0)   index = 0;
    currentCard = index;

    updateCardWidth();
    const cardWidth = cards[0].offsetWidth + 16;
    slider.style.transform = `translateX(-${currentCard * cardWidth}px)`;

    const activeDot = currentCard < cards.length / 2 ? 0 : 1;
    dots.forEach((dot, i) => {
        if (i === activeDot) {
            dot.classList.remove('w-2', 'bg-gray-200');
            dot.classList.add('w-8', 'bg-[#1A2E5A]');
        } else {
            dot.classList.remove('w-8', 'bg-[#1A2E5A]');
            dot.classList.add('w-2', 'bg-gray-200');
        }
    });
}

function startAutoSlide() {
    return setInterval(() => {
        const cards   = document.querySelectorAll('.card-item');
        const visible = getVisibleCards();
        let next = currentCard + 1;
        if (next > Math.max(0, cards.length - visible)) next = 0;
        goToCard(next);
    }, 2500);
}

const loadedCategories = new Set();

async function loadDynamicCardSets(category) {
    // Return early if already loaded
    if (loadedCategories.has(category)) {
        renderCards(category);
        goToCard(0);
        return;
    }

    const mapItem = (item) => {
        let label = 'Lomba';
        let bg = '#FFB8B8';
        let color = '#EE2828';
        const catSlug = item.category ? item.category.slug : 'lomba';
        const catName = item.category ? item.category.name : 'Lomba';

        if (catSlug === 'seminar') {
            label = 'Seminar';
            bg = '#B8D4FF';
            color = '#1A56DB';
        } else if (catSlug === 'beasiswa') {
            label = 'Beasiswa';
            bg = '#B8F5D4';
            color = '#0D7A4E';
        }

        let dateStr = '';
        if (item.deadline) {
            const dateObj = new Date(item.deadline);
            const indonesianMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            dateStr = `${dateObj.getDate()} ${indonesianMonths[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
        }

        return {
            id: item.id,
            label: catName,
            bg: bg,
            color: color,
            title: item.title,
            deadline: dateStr,
            poster_path: item.poster_path || null
        };
    };

    const getDetailRoute = (item) => {
        const catSlug = item.category ? item.category.slug : 'lomba';
        if (catSlug === 'seminar') return window.homeConfig.routes.seminarDetail + '/' + item.id;
        if (catSlug === 'beasiswa') return window.homeConfig.routes.beasiswaDetail + '/' + item.id;
        return window.homeConfig.routes.lombaDetail + '/' + item.id;
    };

    let url = '/api/informations';
    if (category === 'popular') {
        url += '?sort=popular';
    } else if (category) {
        url += '?category=' + category;
    }
    
    try {
        const res = await fetch(url);
        const json = await res.json();
        if (json.success && json.data && json.data.data && json.data.data.length > 0) {
            const items = json.data.data;
            const mapped = items.slice(0, 8).map(mapItem);
            const routes = items.slice(0, 8).map(getDetailRoute);
            
            cardSets[category] = mapped;
            detailRoutes[category] = routes;
            loadedCategories.add(category);
        }
    } catch (e) {
        console.error('Error fetching dynamic cards for ' + category, e);
    }

    if (category === activeCategory) {
        renderCards(activeCategory);
        goToCard(0);
    }
}

// ================================
// FEEDBACK (AJAX)
// ================================
async function loadFeedbacks() {
    const feedbackSlider = document.getElementById('feedbackSlider');
    if (!feedbackSlider) return;

    try {
        const res  = await fetch('/api/feedbacks/public');
        const json = await res.json();

        if (!json.success || !json.data || json.data.length === 0) {
            feedbackSlider.innerHTML = '';
            return;
        }

        feedbackSlider.innerHTML = json.data.map(fb => {
            const initial = (fb.name || 'M')[0].toUpperCase();
            return `
                <div class="flex-none w-[calc(100%-32px)] sm:w-[calc((100%-24px)/2)] lg:w-[calc((100%-48px)/3)]">
                    <div class="bg-white border border-gray-100 rounded-[28px] p-4 sm:p-6 lg:p-8 h-full
                        shadow-[0_8px_30px_rgba(0,0,0,0.06)] hover:shadow-[0_18px_45px_rgba(0,0,0,0.12)]
                        hover:-translate-y-2 transition-all duration-500">
                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full
                                bg-gradient-to-br from-[#1A2E5A] to-[#5D8EFF]
                                flex-shrink-0 flex items-center justify-center
                                font-bold text-white text-base">${initial}</div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-[#1A2E5A] text-xs sm:text-sm truncate">${fb.name}</h4>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm leading-relaxed text-gray-500">"${fb.message}"</p>
                    </div>
                </div>
            `;
        }).join('');

        // Re-init feedback slider controls
        const feedbackNext = document.getElementById('feedbackNext');
        const feedbackPrev = document.getElementById('feedbackPrev');
        if (feedbackNext && feedbackPrev) {
            adjustFeedbackButtons();
            updateFeedbackSlider();
        }
    } catch (e) {
        console.error('Error fetching feedbacks', e);
    }
}

updateCardWidth();
lihatSemua.href = categoryRoutes['popular'];
lihatSemua.classList.add('hidden');
lihatSemua.classList.remove('flex');
let autoSlide = startAutoSlide();
loadDynamicCardSets('popular');
loadFeedbacks();

// Pause saat hover di atas slider
slider.addEventListener('mouseenter', () => {
    clearInterval(autoSlide);
});

// Resume saat mouse keluar
slider.addEventListener('mouseleave', () => {
    autoSlide = startAutoSlide();
});

// Stop auto slide saat card diklik
document.querySelectorAll('.card-item').forEach(card => {
    card.addEventListener('click', () => {
        clearInterval(autoSlide);
    });
});

window.addEventListener('load', () => {
    setTimeout(() => {
        updateIndicator(tabs[0]);
        goToCard(0);
    }, 100);
});

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        activeCategory = this.dataset.category;

        tabs.forEach(t => {
            t.classList.remove('text-[#1A2E5A]', 'font-bold');
            t.classList.add('text-gray-400', 'font-medium');
        });
        this.classList.remove('text-gray-400', 'font-medium');
        this.classList.add('text-[#1A2E5A]', 'font-bold');

        updateIndicator(this);

        // Scroll tab ke tengah di mobile
        const tabCenter     = this.offsetLeft + this.offsetWidth / 2;
        const wrapperCenter = tabsWrapper.offsetWidth / 2;
        tabsWrapper.scrollLeft = tabCenter - wrapperCenter;

        // Update lihat semua
        lihatSemua.href = categoryRoutes[activeCategory] || '/';
        if (activeCategory === 'popular') {
            lihatSemua.classList.add('hidden');
            lihatSemua.classList.remove('flex');
        } else {
            lihatSemua.classList.remove('hidden');
            lihatSemua.classList.add('flex');
        }

        // Update card sesuai kategori dengan lazy loading
        if (loadedCategories.has(activeCategory)) {
            renderCards(activeCategory);
            clearInterval(autoSlide);
            goToCard(0);
            autoSlide = startAutoSlide();
        } else {
            // Placeholder loading state could be added here
            loadDynamicCardSets(activeCategory).then(() => {
                clearInterval(autoSlide);
                autoSlide = startAutoSlide();
            });
        }
    });
});

dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
        clearInterval(autoSlide);
        goToCard(i === 0 ? 0 : Math.floor(totalCards / 2));
        autoSlide = startAutoSlide();
    });
});

window.addEventListener('resize', () => {
    clearInterval(autoSlide);
    updateCardWidth();
    updateIndicator(document.querySelector('.tab-link.font-bold') || tabs[0]);
    goToCard(0);
    autoSlide = startAutoSlide();
});

// ================================
// DRAG / SWIPE CARDS
// ================================
let isDragging   = false;
let startX       = 0;
let dragDistance = 0;

// Mouse drag (desktop) — cegah navigasi card saat dragging
slider.addEventListener('mousedown', (e) => {
    isDragging   = true;
    startX       = e.clientX;
    dragDistance = 0;
    slider.style.transition = 'none';
    clearInterval(autoSlide);
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    dragDistance = e.clientX - startX;
    const cardWidth  = slider.querySelector('.card-item').offsetWidth + 16;
    const baseOffset = currentCard * cardWidth;
    slider.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
});

document.addEventListener('mouseup', () => {
    if (!isDragging) return;
    isDragging = false;
    slider.style.transition = 'transform 700ms ease-in-out';
    if (dragDistance < -60)      goToCard(currentCard + 1);
    else if (dragDistance > 60)  goToCard(currentCard - 1);
    else                         goToCard(currentCard);
    autoSlide = startAutoSlide();
});

// Cegah klik pada card-link jika baru saja drag
slider.addEventListener('click', (e) => {
    if (Math.abs(dragDistance) > 10) e.preventDefault();
}, true);

// Touch swipe (mobile)
slider.addEventListener('touchstart', (e) => {
    startX       = e.touches[0].clientX;
    dragDistance = 0;
    slider.style.transition = 'none';
    clearInterval(autoSlide);
}, { passive: true });

slider.addEventListener('touchmove', (e) => {
    dragDistance = e.touches[0].clientX - startX;
    const cardWidth  = slider.querySelector('.card-item').offsetWidth + 16;
    const baseOffset = currentCard * cardWidth;
    slider.style.transform = `translateX(${-baseOffset + dragDistance}px)`;
}, { passive: true });

slider.addEventListener('touchend', () => {
    slider.style.transition = 'transform 700ms ease-in-out';
    if (dragDistance < -60)      goToCard(currentCard + 1);
    else if (dragDistance > 60)  goToCard(currentCard - 1);
    else                         goToCard(currentCard);
    autoSlide = startAutoSlide();
});

// ================================
// JOIN SECTION SCROLL ANIMATION
// ================================
const joinSection = document.getElementById('joinSection');
if (joinSection) {
    window.addEventListener('scroll', () => {
        const top = joinSection.getBoundingClientRect().top;
        if (top < window.innerHeight * 0.8) {
            joinSection.classList.add('show');
            joinSection.classList.remove('opacity-0', 'translate-y-16');
        } else {
            joinSection.classList.remove('show');
            joinSection.classList.add('opacity-0', 'translate-y-16');
        }
    });
}

// ================================
// FEEDBACK SLIDER
// ================================
const feedbackSlider = document.getElementById('feedbackSlider');
const feedbackNext   = document.getElementById('feedbackNext');
const feedbackPrev   = document.getElementById('feedbackPrev');

let feedbackIndex = 0;
let feedbackAuto;

function visibleFeedback() {
    if (window.innerWidth <= 640)  return 1;
    if (window.innerWidth <= 1024) return 2;
    return 3;
}

function updateFeedbackSlider() {
    const feedbackCards = document.querySelectorAll('#feedbackSlider > div');
    if (feedbackCards.length === 0) return;
    const cardWidth = feedbackCards[0].offsetWidth + 16;
    feedbackSlider.style.transform = `translateX(-${feedbackIndex * cardWidth}px)`;
}

function nextFeedback() {
    const feedbackCards = document.querySelectorAll('#feedbackSlider > div');
    const max = feedbackCards.length - visibleFeedback();
    if (max <= 0) return;
    feedbackIndex = feedbackIndex >= max ? 0 : feedbackIndex + 1;
    updateFeedbackSlider();
}

function prevFeedback() {
    const feedbackCards = document.querySelectorAll('#feedbackSlider > div');
    const max = feedbackCards.length - visibleFeedback();
    if (max <= 0) return;
    feedbackIndex = feedbackIndex <= 0 ? max : feedbackIndex - 1;
    updateFeedbackSlider();
}

function adjustFeedbackButtons() {
    if (!feedbackNext || !feedbackPrev) return;
    const feedbackCards = document.querySelectorAll('#feedbackSlider > div');
    feedbackNext.style.display = '';
    feedbackPrev.style.display = '';
    const max = feedbackCards.length - visibleFeedback();
    if (max > 0) {
        if (!feedbackAuto) {
            feedbackAuto = setInterval(nextFeedback, 3000);
        }
    } else {
        if (feedbackAuto) {
            clearInterval(feedbackAuto);
            feedbackAuto = null;
        }
    }
}

function initFeedbackSlider() {
    if (!feedbackSlider || !feedbackNext || !feedbackPrev) return;

    feedbackNext.addEventListener('click', () => {
        if (feedbackAuto) clearInterval(feedbackAuto);
        nextFeedback();
        const max = document.querySelectorAll('#feedbackSlider > div').length - visibleFeedback();
        if (max > 0) feedbackAuto = setInterval(nextFeedback, 3000);
    });

    feedbackPrev.addEventListener('click', () => {
        if (feedbackAuto) clearInterval(feedbackAuto);
        prevFeedback();
        const max = document.querySelectorAll('#feedbackSlider > div').length - visibleFeedback();
        if (max > 0) feedbackAuto = setInterval(nextFeedback, 3000);
    });

    feedbackSlider.addEventListener('mouseenter', () => {
        if (feedbackAuto) {
            clearInterval(feedbackAuto);
            feedbackAuto = null;
        }
    });

    feedbackSlider.addEventListener('mouseleave', () => {
        const max = document.querySelectorAll('#feedbackSlider > div').length - visibleFeedback();
        if (max > 0 && !feedbackAuto) {
            feedbackAuto = setInterval(nextFeedback, 3000);
        }
    });

    window.addEventListener('resize', () => {
        feedbackIndex = 0;
        updateFeedbackSlider();
        adjustFeedbackButtons();
    });
}

// Init feedback slider event listeners
initFeedbackSlider();
