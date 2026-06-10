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

            // Cek di judul tips manual
            if (!foundCategory) {
                const tipsTitles = [
                    'cara meningkatkan peluang lolos seleksi kompetisi',
                    'kesalahan umum yang sering dilakukan peserta kompetisi',
                    'strategi menyusun tim yang solid dan efektif',
                    'tips mengatur waktu antara kuliah dan organisasi',
                    'cara membangun portofolio yang menarik',
                    'meningkatkan kemampuan public speaking mahasiswa',
                    'tips menulis cv yang ats friendly',
                    'rahasia produktif saat deadline menumpuk'
                ];
                const matchTips = tipsTitles.some(title => title.includes(qLower));
                if (matchTips) {
                    foundCategory = 'workshop';
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

// Route detail per kategori untuk setiap card
const detailRoutes = {
    popular:  [
        window.homeConfig.routes.lombaDetail, window.homeConfig.routes.seminarDetail, window.homeConfig.routes.beasiswaDetail,
        window.homeConfig.routes.lombaDetail, window.homeConfig.routes.seminarDetail, window.homeConfig.routes.beasiswaDetail,
        window.homeConfig.routes.lombaDetail, window.homeConfig.routes.seminarDetail
    ],
    lomba:    Array(8).fill(window.homeConfig.routes.lombaDetail),
    seminar:  Array(8).fill(window.homeConfig.routes.seminarDetail),
    beasiswa: Array(8).fill(window.homeConfig.routes.beasiswaDetail)
};

// Data konten card per kategori
const cardSets = {
    popular: [
        { label: 'Lomba',    bg: '#FFB8B8', color: '#EE2828', title: 'UI/UX Design Competition 2025',          deadline: '10 Jun 2025' },
        { label: 'Seminar',  bg: '#B8D4FF', color: '#1A56DB', title: 'Seminar Inovasi Teknologi Nasional',     deadline: '15 Jun 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Prestasi Mahasiswa Unggulan',   deadline: '20 Jun 2025' },
        { label: 'Lomba',    bg: '#FFB8B8', color: '#EE2828', title: 'Hackathon Data Science Challenge',       deadline: '25 Jun 2025' },
        { label: 'Seminar',  bg: '#B8D4FF', color: '#1A56DB', title: 'Workshop Kecerdasan Buatan & ML',       deadline: '30 Jun 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Polinema Unggulan 2025',       deadline: '05 Jul 2025' },
        { label: 'Lomba',    bg: '#FFB8B8', color: '#EE2828', title: 'National Coding Competition 2025',      deadline: '10 Jul 2025' },
        { label: 'Seminar',  bg: '#B8D4FF', color: '#1A56DB', title: 'Seminar Kewirausahaan Digital',         deadline: '15 Jul 2025' },
    ],
    lomba: [
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'UI/UX Design Competition 2025',            deadline: '10 Jun 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Hackathon Data Science Challenge',          deadline: '18 Jun 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'National Coding Competition 2025',          deadline: '25 Jun 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Business Plan Competition Nasional',        deadline: '02 Jul 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Robotics Engineering Challenge 2025',       deadline: '09 Jul 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Essay & Karya Tulis Ilmiah Nasional',       deadline: '16 Jul 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Mobile App Innovation Contest 2025',        deadline: '23 Jul 2025' },
        { label: 'Lomba', bg: '#FFB8B8', color: '#EE2828', title: 'Video Kreatif & Sinematografi Mahasiswa',   deadline: '30 Jul 2025' },
    ],
    seminar: [
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Seminar Inovasi Teknologi Nasional',      deadline: '12 Jun 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Workshop Kecerdasan Buatan & ML',        deadline: '19 Jun 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Seminar Kewirausahaan Digital 2025',      deadline: '26 Jun 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Webinar Pengembangan Karier Mahasiswa',   deadline: '03 Jul 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Talk Show Startup & Inovasi Muda',        deadline: '10 Jul 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Seminar Nasional Pendidikan 4.0',         deadline: '17 Jul 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Workshop Desain Grafis Profesional',      deadline: '24 Jul 2025' },
        { label: 'Seminar', bg: '#B8D4FF', color: '#1A56DB', title: 'Webinar Cloud Computing & DevOps',        deadline: '31 Jul 2025' },
    ],
    beasiswa: [
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Prestasi Mahasiswa Unggulan',  deadline: '14 Jun 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Polinema Unggulan 2025',       deadline: '21 Jun 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Kemendikbud Ristek 2025',      deadline: '28 Jun 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa BCA Finance Peduli Negeri',    deadline: '05 Jul 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Djarum Plus 2025',             deadline: '12 Jul 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa LPDP Program S1 2025',         deadline: '19 Jul 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa Bank Indonesia Mahasiswa',     deadline: '26 Jul 2025' },
        { label: 'Beasiswa', bg: '#B8F5D4', color: '#0D7A4E', title: 'Beasiswa XL Future Leaders 2025',       deadline: '02 Agu 2025' },
    ],
};

function updateCardLinks(category) {
    document.querySelectorAll('.card-item').forEach((card, i) => {
        const link = card.querySelector('.card-link');
        if (link) link.href = (detailRoutes[category] || detailRoutes['popular'])[i];
    });
}

function updateCardContent(category) {
    const set = cardSets[category] || cardSets['popular'];
    document.querySelectorAll('.card-item').forEach((card, i) => {
        const data   = set[i];
        const badge  = card.querySelector('.card-badge');
        const title  = card.querySelector('.card-title');
        const dl     = card.querySelector('.card-deadline');

        if (badge) {
            badge.textContent       = data.label;
            badge.style.background  = data.bg;
            badge.style.color       = data.color;
        }
        if (title)  title.textContent  = data.title;
        if (dl)     dl.textContent     = 'Deadline: ' + data.deadline;
    });
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
    const max = totalCards - visible;
    if (index > max) index = 0;
    if (index < 0)   index = 0;
    currentCard = index;

    updateCardWidth();
    const cardWidth = slider.querySelector('.card-item').offsetWidth + 16;
    slider.style.transform = `translateX(-${currentCard * cardWidth}px)`;

    const activeDot = currentCard < totalCards / 2 ? 0 : 1;
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
        const visible = getVisibleCards();
        let next = currentCard + 1;
        if (next > totalCards - visible) next = 0;
        goToCard(next);
    }, 2500);
}

async function loadDynamicCardSets() {
    const categories = ['popular', 'lomba', 'seminar', 'beasiswa'];
    
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
            deadline: dateStr
        };
    };

    const getDetailRoute = (item) => {
        const catSlug = item.category ? item.category.slug : 'lomba';
        if (catSlug === 'seminar') return window.homeConfig.routes.seminarDetail + '/' + item.id;
        if (catSlug === 'beasiswa') return window.homeConfig.routes.beasiswaDetail + '/' + item.id;
        return window.homeConfig.routes.lombaDetail + '/' + item.id;
    };

    for (const cat of categories) {
        let url = '/api/informations';
        if (cat !== 'popular') {
            url += '?category=' + cat;
        }
        try {
            const res = await fetch(url);
            const json = await res.json();
            if (json.success && json.data && json.data.data && json.data.data.length > 0) {
                const items = json.data.data;
                const mapped = items.slice(0, 8).map(mapItem);
                const routes = items.slice(0, 8).map(getDetailRoute);
                
                while (mapped.length < 8) {
                    mapped.push(mapped[mapped.length - 1] || cardSets[cat][mapped.length]);
                    routes.push(routes[routes.length - 1] || detailRoutes[cat][routes.length]);
                }
                
                cardSets[cat] = mapped;
                detailRoutes[cat] = routes;
            }
        } catch (e) {
            console.error('Error fetching dynamic cards for ' + cat, e);
        }
    }

    updateCardLinks(activeCategory);
    updateCardContent(activeCategory);
    goToCard(0);
}

// Init
updateCardWidth();
updateCardLinks('popular');
updateCardContent('popular');
lihatSemua.href = categoryRoutes['popular'];
lihatSemua.classList.add('hidden');
lihatSemua.classList.remove('flex');
let autoSlide = startAutoSlide();
loadDynamicCardSets();

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

        // Update href dan konten tiap card sesuai kategori
        updateCardLinks(activeCategory);
        updateCardContent(activeCategory);

        clearInterval(autoSlide);
        goToCard(0);
        autoSlide = startAutoSlide();
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
document.addEventListener('DOMContentLoaded', () => {
    const feedbackSlider = document.getElementById('feedbackSlider');
    const feedbackNext   = document.getElementById('feedbackNext');
    const feedbackPrev   = document.getElementById('feedbackPrev');

    if (feedbackSlider && feedbackNext && feedbackPrev) {
        let feedbackCards = document.querySelectorAll('#feedbackSlider > div');
        let feedbackIndex = 0;
        let feedbackAuto;

        function visibleFeedback() {
            if (window.innerWidth <= 640)  return 1;
            if (window.innerWidth <= 1024) return 2;
            return 3;
        }

        function updateFeedbackSlider() {
            feedbackCards = document.querySelectorAll('#feedbackSlider > div');
            if (feedbackCards.length === 0) return;
            const cardWidth = feedbackCards[0].offsetWidth + 16;
            feedbackSlider.style.transform = `translateX(-${feedbackIndex * cardWidth}px)`;
        }

        function nextFeedback() {
            feedbackCards = document.querySelectorAll('#feedbackSlider > div');
            const max = feedbackCards.length - visibleFeedback();
            if (max <= 0) return;
            feedbackIndex = feedbackIndex >= max ? 0 : feedbackIndex + 1;
            updateFeedbackSlider();
        }

        function prevFeedback() {
            feedbackCards = document.querySelectorAll('#feedbackSlider > div');
            const max = feedbackCards.length - visibleFeedback();
            if (max <= 0) return;
            feedbackIndex = feedbackIndex <= 0 ? max : feedbackIndex - 1;
            updateFeedbackSlider();
        }

        function adjustFeedbackButtons() {
            feedbackCards = document.querySelectorAll('#feedbackSlider > div');
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

        feedbackNext.addEventListener('click', () => {
            if (feedbackAuto) clearInterval(feedbackAuto);
            nextFeedback();
            const max = feedbackCards.length - visibleFeedback();
            if (max > 0) feedbackAuto = setInterval(nextFeedback, 3000);
        });

        feedbackPrev.addEventListener('click', () => {
            if (feedbackAuto) clearInterval(feedbackAuto);
            prevFeedback();
            const max = feedbackCards.length - visibleFeedback();
            if (max > 0) feedbackAuto = setInterval(nextFeedback, 3000);
        });

        feedbackSlider.addEventListener('mouseenter', () => {
            if (feedbackAuto) {
                clearInterval(feedbackAuto);
                feedbackAuto = null;
            }
        });
        
        feedbackSlider.addEventListener('mouseleave', () => {
            const max = feedbackCards.length - visibleFeedback();
            if (max > 0 && !feedbackAuto) {
                feedbackAuto = setInterval(nextFeedback, 3000);
            }
        });

        window.addEventListener('resize', () => {
            feedbackIndex = 0;
            updateFeedbackSlider();
            adjustFeedbackButtons();
        });

        // Run initial adjustments after layout is fully rendered
        setTimeout(() => {
            adjustFeedbackButtons();
            updateFeedbackSlider();
        }, 150);
    }
});
