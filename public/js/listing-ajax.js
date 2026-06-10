document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('headerSearchForm');
    const cardGrid = document.getElementById('cardGrid');
    const paginationContainer = document.getElementById('paginationContainer');

    if (!cardGrid || !paginationContainer) return;

    // Helper to transition and replace content
    async function fetchPage(url) {
        // Fade out
        cardGrid.classList.add('opacity-0');
        
        try {
            const res = await fetch(url);
            if (!res.ok) throw new Error('Network response was not ok');
            const htmlText = await res.text();
            
            // Parse HTML response
            const parser = new DOMParser();
            const doc = parser.parseFromString(htmlText, 'text/html');
            
            const newCardGrid = doc.getElementById('cardGrid');
            const newPagination = doc.getElementById('paginationContainer');
            
            if (newCardGrid) {
                cardGrid.innerHTML = newCardGrid.innerHTML;
            }
            if (newPagination) {
                paginationContainer.innerHTML = newPagination.innerHTML;
            } else {
                paginationContainer.innerHTML = '';
            }

            // Update browser URL
            window.history.pushState({ path: url }, '', url);

            // Re-bind pagination clicks since container contents changed
            bindPaginationClicks();

            // Refresh AOS animations
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }

            // Scroll to grid top smoothly
            const gridRect = cardGrid.getBoundingClientRect();
            const absoluteGridTop = gridRect.top + window.pageYOffset - 120; // 120px offset for header/nav
            window.scrollTo({ top: absoluteGridTop, behavior: 'smooth' });

        } catch (error) {
            console.error('AJAX load error:', error);
            // Fallback: reload page
            window.location.href = url;
        } finally {
            // Fade in back
            setTimeout(() => {
                cardGrid.classList.remove('opacity-0');
            }, 100);
        }
    }

    // Bind event listeners to pagination links dynamically
    function bindPaginationClicks() {
        const links = paginationContainer.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');
                if (url && url !== '#') {
                    fetchPage(url);
                }
            });
        });
    }

    // Intercept search form submission
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            // Check if user is searching within the same page context
            const q = this.querySelector('input[name="q"]').value.trim();
            const categorySelect = document.getElementById('headerCategorySelect');
            const selectedCategoryUrl = categorySelect ? categorySelect.value : '';

            let base = selectedCategoryUrl;

            // Auto detect category from query keyword
            if (!base && q) {
                const qLower = q.toLowerCase();
                const origins = {
                    lomba: '/lomba',
                    seminar: '/seminar',
                    beasiswa: '/beasiswa',
                    tips: '/tips'
                };
                let detectedKey = null;
                if (qLower.includes('lomba') || qLower.includes('competition') || qLower.includes('hackathon') || qLower.includes('contest') || qLower.includes('kontes')) {
                    detectedKey = 'lomba';
                } else if (qLower.includes('seminar') || qLower.includes('webinar') || qLower.includes('workshop') || qLower.includes('talkshow') || qLower.includes('talk show') || qLower.includes('kelas') || qLower.includes('wawasan')) {
                    detectedKey = 'seminar';
                } else if (qLower.includes('beasiswa') || qLower.includes('scholarship') || qLower.includes('lpdp') || qLower.includes('bantuan') || qLower.includes('prestasi')) {
                    detectedKey = 'beasiswa';
                } else if (qLower.includes('tips') || qLower.includes('insight') || qLower.includes('cara') || qLower.includes('strategi') || qLower.includes('cv') || qLower.includes('portofolio') || qLower.includes('speaking') || qLower.includes('artikel')) {
                    detectedKey = 'tips';
                }

                if (detectedKey) {
                    base = window.location.origin + origins[detectedKey];
                }
            }

            // If not detected/selected, use current path (if on category pages)
            if (!base) {
                const path = window.location.pathname;
                if (path.includes('/lomba') || path.includes('/seminar') || path.includes('/beasiswa') || path.includes('/tips')) {
                    base = window.location.origin + path;
                } else {
                    base = window.location.origin + '/lomba';
                }
            }

            const currentBase = window.location.origin + window.location.pathname;
            
            // Check if base matches current page path
            const baseClean = base.replace(/\/$/, "");
            const currentBaseClean = currentBase.replace(/\/$/, "");

            if (baseClean === currentBaseClean) {
                // Same page context: do AJAX search!
                e.preventDefault();
                e.stopPropagation();
                const url = q ? baseClean + '?q=' + encodeURIComponent(q) : baseClean;
                fetchPage(url);
            } else {
                // Different page context: let the default header-konten inline script redirect normally
                // do nothing, let inline script execute
            }
        });
    }

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        fetchPage(window.location.href);
    });

    // Initial binding
    bindPaginationClicks();
});
