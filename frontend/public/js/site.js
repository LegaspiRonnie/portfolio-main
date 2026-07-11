// Static frontend JS — Alpine stores + reveal animations + under-construction modal.
// Loaded before the Alpine CDN script (both deferred) so alpine:init listeners register in time.

// Open the "under construction" modal; usable as onclick="underConstruction(event)"
// or as a form onsubmit handler.
window.underConstruction = function (event) {
    if (event && typeof event.preventDefault === 'function') {
        event.preventDefault();
    }

    window.dispatchEvent(new CustomEvent('open-under-construction'));

    return false;
};

document.addEventListener('alpine:init', () => {
    Alpine.store('toast', {
        items: [],

        push({ message, type = 'info', duration = 4000 }) {
            const id = Date.now() + Math.random();
            this.items.push({ id, message, type });
            setTimeout(() => this.remove(id), duration);
        },

        remove(id) {
            this.items = this.items.filter((item) => item.id !== id);
        },
    });

    Alpine.store('confirm', {
        open: false,
        title: '',
        message: '',
        confirmText: 'Confirm',
        cancelText: 'Cancel',
        _resolve: null,

        ask({ title = 'Are you sure?', message = '', confirmText = 'Confirm', cancelText = 'Cancel' }) {
            this.title = title;
            this.message = message;
            this.confirmText = confirmText;
            this.cancelText = cancelText;
            this.open = true;

            return new Promise((resolve) => {
                this._resolve = resolve;
            });
        },

        confirm() {
            this.open = false;
            if (this._resolve) this._resolve(true);
        },

        cancel() {
            this.open = false;
            if (this._resolve) this._resolve(false);
        },
    });
});

function initRevealObserver() {
    const revealEls = document.querySelectorAll('[data-reveal]:not(.in-view)');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(el => observer.observe(el));
}

function setFooterYear() {
    const el = document.getElementById('footer-year');
    if (el) el.textContent = new Date().getFullYear();
}

document.addEventListener('DOMContentLoaded', initRevealObserver);
document.addEventListener('DOMContentLoaded', setFooterYear);
