/* ==========================================================================
   Mzansi Routes — site JavaScript
   Loaded on every page with "defer", so the HTML is ready when this runs.
   Each feature checks that its elements exist first, so the same file can
   be used on every page.

   CONTENTS
    1. Mobile menu
    2. Wishlist hearts
    3. Destinations: search, filter, sort
    4. Form helpers (shared)
    5. Contact form validation
    6. Newsletter sign-up (footer)
    7. Travel Starter Kit pop-up (Home)
    8. Copy colour codes (Style guide)
   ========================================================================== */

'use strict';

/* Simple email check: something@something.something */
const EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;


/* ==========================================================================
   1. MOBILE MENU
   The hamburger button opens/closes the menu panel on screens under 1200px.
   ========================================================================== */
(function initMobileMenu() {
    const header = document.querySelector('.site-header');
    const toggle = document.querySelector('.menu-toggle');
    if (!header || !toggle) return;

    const icon = toggle.querySelector('.icon');

    function setOpen(open) {
        header.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        // Update the button's label + icon so screen readers know what it does
        toggle.setAttribute('aria-label', open ? toggle.dataset.labelClose : toggle.dataset.labelOpen);
        if (icon) icon.textContent = open ? 'close' : 'menu';
    }

    toggle.addEventListener('click', () => {
        setOpen(!header.classList.contains('is-open'));
    });

    // Close with the Esc key and give focus back to the button
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && header.classList.contains('is-open')) {
            setOpen(false);
            toggle.focus();
        }
    });

    // Close when clicking anywhere outside the header
    document.addEventListener('click', (event) => {
        if (!header.contains(event.target)) setOpen(false);
    });

    // Close if the window is resized to desktop width
    window.matchMedia('(min-width: 1200px)').addEventListener('change', (event) => {
        if (event.matches) setOpen(false);
    });
})();


/* ==========================================================================
   2. WISHLIST HEARTS
   Clicking a heart fills it in. The choice is remembered in this browser
   (localStorage) so it is still there after a reload.
   ========================================================================== */
(function initWishlist() {
    const buttons = document.querySelectorAll('.wishlist-btn');
    if (!buttons.length) return;

    const STORAGE_KEY = 'mzansi-wishlist';

    // localStorage can be blocked (e.g. private browsing) — never let that break the page
    function load() {
        try {
            return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
        } catch (error) {
            return [];
        }
    }

    function save(list) {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
        } catch (error) {
            /* ignore — the heart still works for this visit */
        }
    }

    // Each heart is identified by its card's id, or else its label
    function idFor(button) {
        const card = button.closest('article[id]');
        return card ? card.id : button.getAttribute('aria-label');
    }

    let saved = load();

    buttons.forEach((button) => {
        if (saved.includes(idFor(button))) button.setAttribute('aria-pressed', 'true');

        button.addEventListener('click', () => {
            const id = idFor(button);
            const isSaved = button.getAttribute('aria-pressed') === 'true';
            button.setAttribute('aria-pressed', String(!isSaved));
            saved = isSaved ? saved.filter((item) => item !== id) : [...saved, id];
            save(saved);
        });
    });
})();


/* ==========================================================================
   3. DESTINATIONS — SEARCH, FILTER, SORT
   Works on the cards already on the page; nothing is loaded from a server.
   ========================================================================== */
(function initDestinationFilters() {
    const grid = document.getElementById('destinations-grid');
    if (!grid) return;

    const cards = Array.from(grid.querySelectorAll('.destination-card'));
    const searchInput = document.getElementById('destination-search');
    const chips = document.querySelectorAll('.chip[data-filter]');
    const sortSelect = document.getElementById('sort-select');
    const countEl = document.querySelector('#results-count [data-count]');
    const emptyState = document.getElementById('no-results');
    const resetButton = document.getElementById('reset-filters');

    let activeFilter = 'all';

    function matchesFilter(card) {
        if (activeFilter === 'all') return true;
        if (activeFilter === 'unesco') return card.dataset.unesco === 'true';
        return card.dataset.category.split(' ').includes(activeFilter);
    }

    function matchesSearch(card) {
        const query = searchInput.value.trim().toLowerCase();
        return query === '' || card.textContent.toLowerCase().includes(query);
    }

    // Show/hide cards, update the counter and the "no results" message
    function applyFilters() {
        let visible = 0;

        cards.forEach((card) => {
            const show = matchesFilter(card) && matchesSearch(card);
            if (show && card.hidden) {
                // replay the fade-in animation for cards that come back
                card.classList.remove('is-entering');
                void card.offsetWidth;
                card.classList.add('is-entering');
            }
            card.hidden = !show;
            if (show) visible++;
        });

        if (countEl) countEl.textContent = visible;
        emptyState.hidden = visible > 0;
    }

    function setFilter(value) {
        activeFilter = value;
        chips.forEach((chip) => {
            const isActive = chip.dataset.filter === value;
            chip.classList.toggle('is-active', isActive);
            chip.setAttribute('aria-pressed', String(isActive));
        });
        applyFilters();
    }

    // Re-order the cards in the grid
    function applySort() {
        const by = sortSelect.value;
        const sorted = [...cards].sort((a, b) => {
            if (by === 'rating')   return b.dataset.rating - a.dataset.rating;
            if (by === 'duration') return a.dataset.days - b.dataset.days;
            return a.dataset.popularity - b.dataset.popularity; // popularity = original order
        });
        sorted.forEach((card) => grid.appendChild(card));
    }

    chips.forEach((chip) => {
        chip.addEventListener('click', () => setFilter(chip.dataset.filter));
    });

    searchInput.addEventListener('input', applyFilters);
    sortSelect.addEventListener('change', applySort);

    resetButton.addEventListener('click', () => {
        searchInput.value = '';
        setFilter('all');
        searchInput.focus();
    });

    // Links like destinations.php?filter=wildlife open with that filter on
    const fromUrl = new URLSearchParams(window.location.search).get('filter');
    if (fromUrl && document.querySelector(`.chip[data-filter="${fromUrl}"]`)) {
        setFilter(fromUrl);
    }
})();


/* ==========================================================================
   4. FORM HELPERS (shared by the forms below)
   ========================================================================== */

/* Show an error under a field: red border, message text, and screen-reader
   links (aria-invalid + aria-describedby). Pass '' to clear it. */
function setFieldError(field, message) {
    const errorEl = document.getElementById(`${field.id}-error`);

    if (message) {
        field.setAttribute('aria-invalid', 'true');
        field.setAttribute('aria-describedby', `${field.id}-error`);
    } else {
        field.removeAttribute('aria-invalid');
        field.removeAttribute('aria-describedby');
    }

    if (errorEl) {
        errorEl.querySelector('.field-error-text').textContent = message;
        errorEl.hidden = !message;
    }
}

/* Write a short message into a role="status" element */
function setStatus(statusEl, message, type) {
    statusEl.textContent = message;
    statusEl.classList.toggle('is-error', type === 'error');
    statusEl.classList.toggle('is-success', type === 'success');
}


/* ==========================================================================
   5. CONTACT FORM VALIDATION
   Checks the form before it is sent. If something is wrong, the form is not
   sent, each problem is explained under its field, and focus moves to the
   first problem. contact.php checks everything again on the server.
   The error texts come from data-error-* attributes (already translated).
   ========================================================================== */
(function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;

    const summary = document.getElementById('form-error-summary');

    // Returns an error message for one field, or '' if it is fine
    function check(field) {
        const value = field.type === 'checkbox' ? field.checked : field.value.trim();

        switch (field.id) {
            case 'name':
                return value ? '' : field.dataset.errorRequired;
            case 'email':
                if (!value) return field.dataset.errorRequired;
                return EMAIL_PATTERN.test(value) ? '' : field.dataset.errorInvalid;
            case 'phone':
                // optional — only checked if something was typed
                return !value || /^\+?[0-9\s()-]{7,20}$/.test(value) ? '' : field.dataset.errorInvalid;
            case 'message':
                return value.length >= 10 ? '' : field.dataset.errorRequired;
            case 'consent':
                return value ? '' : field.dataset.errorRequired;
            default:
                return '';
        }
    }

    const fields = ['name', 'email', 'phone', 'message', 'consent']
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    form.addEventListener('submit', (event) => {
        let firstInvalid = null;

        fields.forEach((field) => {
            const message = check(field);
            setFieldError(field, message);
            if (message && !firstInvalid) firstInvalid = field;
        });

        if (firstInvalid) {
            event.preventDefault();  // stop the form from being sent
            summary.hidden = false;
            firstInvalid.focus();
        }
    });

    // Once a field has shown an error, re-check it as the visitor fixes it
    fields.forEach((field) => {
        const eventName = field.type === 'checkbox' ? 'change' : 'input';
        field.addEventListener(eventName, () => {
            if (field.getAttribute('aria-invalid') === 'true') {
                setFieldError(field, check(field));
            }
        });
    });
})();


/* ==========================================================================
   6. NEWSLETTER SIGN-UP (footer)
   Browser-only for now — see the TODO in includes/footer.php.
   ========================================================================== */
(function initNewsletter() {
    const form = document.querySelector('[data-newsletter]');
    if (!form) return;

    const email = form.querySelector('input[type="email"]');
    const consent = form.querySelector('input[name="consent"]');
    const status = form.querySelector('.form-status');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!EMAIL_PATTERN.test(email.value.trim()) || !consent.checked) {
            email.setAttribute('aria-invalid', String(!EMAIL_PATTERN.test(email.value.trim())));
            setStatus(status, status.dataset.error, 'error');
            email.focus();
            return;
        }

        email.removeAttribute('aria-invalid');
        setStatus(status, status.dataset.success, 'success');
        form.reset();
    });
})();


/* ==========================================================================
   7. TRAVEL STARTER KIT POP-UP (Home page)
   Any button with data-open-modal="dialog-id" opens that <dialog>.
   ========================================================================== */
(function initModals() {
    document.querySelectorAll('[data-open-modal]').forEach((opener) => {
        const dialog = document.getElementById(opener.dataset.openModal);
        if (!dialog || typeof dialog.showModal !== 'function') return;

        opener.addEventListener('click', () => dialog.showModal());

        // Close button
        dialog.querySelectorAll('[data-close-modal]').forEach((closer) => {
            closer.addEventListener('click', () => dialog.close());
        });

        // Clicking the dark area outside the box also closes it
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) dialog.close();
        });

        // When closed, put keyboard focus back on the button that opened it
        dialog.addEventListener('close', () => opener.focus());
    });

    // Starter-kit form: check the email + consent, then reveal the download
    const kitForm = document.querySelector('[data-starter-kit]');
    if (!kitForm) return;

    kitForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const email = kitForm.querySelector('input[type="email"]');
        const consent = kitForm.querySelector('input[name="consent"]');
        const status = kitForm.querySelector('.form-status');

        if (!EMAIL_PATTERN.test(email.value.trim()) || !consent.checked) {
            email.setAttribute('aria-invalid', String(!EMAIL_PATTERN.test(email.value.trim())));
            setStatus(status, status.dataset.error, 'error');
            email.focus();
            return;
        }

        kitForm.hidden = true;
        const success = kitForm.parentElement.querySelector('.modal-success');
        success.hidden = false;
        success.querySelector('a').focus();
    });
})();


/* ==========================================================================
   8. COPY COLOUR CODES (Style guide)
   ========================================================================== */
(function initCopyButtons() {
    document.querySelectorAll('[data-copy]').forEach((button) => {
        button.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(button.dataset.copy);
                const icon = button.querySelector('.icon');
                button.classList.add('is-copied');
                if (icon) icon.textContent = 'check';
                setTimeout(() => {
                    button.classList.remove('is-copied');
                    if (icon) icon.textContent = 'content_copy';
                }, 1500);
            } catch (error) {
                /* Clipboard not available (e.g. page not on https/localhost) */
            }
        });
    });
})();
